<?
require_once( 'PHPMailer/PHPMailerAutoload.php');
global $user, $UID, $isDoctor,$sessionList;
class oneSession
{
    public $sessionId;
    public $sessDate;
    public $patient_name;
    public $patient_email;

    function __construct($a, $b, $c, $d)
    {
        $this ->sessionId = $a;
        $this ->sessDate = explode(' ', $b)[0];
        $this ->patient_name = $c;
        $this ->patient_email = $d;
    }
}
class oneFile
{
    public $name;
    public $fileId;
    public $driveKey;
    public $type;
    public $thumbnailSource;
    public $directLink;
    public $downloadLink;
    function __construct( $createDate, $duration, $fileId, $driveKey)
    {

        // $trimmedName = explode('.', explode(' ', $createDate)[1]);
        $this ->name = $createDate;
        $this ->duration = $duration;
        $this ->fileId = $fileId;
        $this ->driveKey = $driveKey;
        $this->downloadLink = 'https://drive.google.com/uc?id='.$fileId.'&export=download';



        $this->thumbnailSource =  'https://drive.google.com/thumbnail?authuser=0&sz=w150&id='. $this ->fileId;
        if($this->duration==0)
        {
            $this->type = 'photo';
            $this->directLink ='https://drive.google.com/uc?id=' . $this ->fileId . '&export=download';
        }
        else
        {
            $this->type = 'video';
            $this->directLink = "https://www.googleapis.com/drive/v3/files/" . $this ->fileId . '?key=' . $this ->driveKey . '&alt=media';
        }
    }
    function time($time) {
        $time = (int)$this->duration;
// var_dump($time %1000);
// print date("H:i:s", mktime(0, 0, 13600));
// var_dump(intdiv($time, 1000));
// var_dump(strtotime($time) / 1000);

        print gmdate("H:i:s\\", $time/1000);
// print date("H:i:s", mktime(0, 0, ($time /1000)));


// return $time;
    }

}
class OneUser
{
    public $UID;
    public $email;
    public $isDoctor;
    function __construct($a, $b, $c)
    {
        $this ->UID = $a;
        $this ->email = $b;
        $this ->isDoctor = $c;
    }
}
//====================================================================================
//инициализатор ПДО с установленными параметрами
function Initializer()
{
    $obj =  new PDO("sqlsrv:server = tcp:ssmserver2.database.windows.net,1433; Database = db_ssm", "prodvdadmin", "AdminQwerty123");
    if($obj==null)
    {
        //send email to support
    }
    return $obj;
}
//==================================================================готовые методы=====================================
function getSessionsForUser($user_ID)
{

    global $sessionList;
    $sql = "SELECT session_id, creation_time  FROM tbl_session_protocol WHERE patient_id = '$user_ID' order by creation_time desc";
    $stmt = Initializer()->query($sql);
    while($row = $stmt->fetch(2))
    {
        $session = new oneSession($row['session_id'],  $row['creation_time'], 0,0);
        $sessionList[]= $session;
    }
}
//=====================================================================================================================
function validator($email, $pass)
{
    global $isDoctor;
    $sql = "SELECT doctor_ID FROM tbl_doctors WHERE email = '$email' AND password = '$pass' ";
    $stmt = Initializer()->query($sql);
    $res =  $stmt->fetch(2)['doctor_ID'];
    if($res!=null)
    {
        $isDoctor=true;
        return $res;
    }

    else
    {
        $sql = "SELECT patient_ID FROM tbl_patients WHERE email = '$email' AND password = '$pass' ";

        $stmt = Initializer()->query($sql);
        $res =  $stmt->fetch(2)['patient_ID'];
        if($res!=null)
        {
            $isDoctor=false;
            return $res;
        }

        else
            redirectSwitcher('./error.php');
    }
    $stmt->closeCursor();
}
//=====================================================================================================================
function getFilesById($ID)
{
    global $fileList;
    $sql = "SELECT tbl_files.name, tbl_files.crtDateTime, tbl_files.duration, tbl_files.path, tbl_cloud_drives.Browse_key 
FROM tbl_files right join tbl_cloud_drives on tbl_cloud_drives.cloud_drive_id=tbl_files.cloud_drive_id  
WHERE tbl_files.session_id=$ID";
    $stmt = Initializer()->query($sql);
    while( $row = $stmt->fetch(2))
    {
        $file = new oneFile( $row['name'], $row['duration'], $row['path'], $row['Browse_key']);
        $fileList[] = $file;
    }
}
//=====================================================================================================================
function getSessionByDocEmail($doc_email, $p_name, $p_dt_start, $p_dt_end)
{
    global $sessionList;
    $sql="select session_id, creation_time, patient_name, patient_email from v_session_search t  where 1=1";

    if($p_name!='')
    {
        if (strpos($p_name, '@') != false)
            $sql.=" and upper(t.patient_name) like upper ('%$p_name%' )";

        else
            $sql.=" and upper(t.patient_email) like upper ('%$p_name%' )";
    }

    if($p_dt_start!='' and $p_dt_end!='' )
        $sql.= " and t.creation_time between convert(datetime, '$p_dt_start' , 110) and convert(datetime, '$p_dt_end' , 110)";

    else if($p_dt_start!='')
        $sql.= " and t.creation_time >= convert(datetime, '$p_dt_start' , 110)";

    else if($p_dt_end!='')
        $sql.= " and t.creation_time <= convert(datetime, '$p_dt_end' , 110)";

    $sql.= " and upper (t.doctor_email )= '$doc_email' order by session_id desc";

    if($doc_email!=null and $p_name==null  and $p_dt_start==null and $p_dt_end==null)
    {
        $sql="select top 3 session_id, creation_time, patient_name, patient_email from v_session_search t  where 1=1  and upper (t.doctor_email )= '$doc_email' order by session_id desc";
    }
    $stmt = Initializer()->query($sql);
    $sessionList=null;
    while ( $row = $stmt->fetch(2))
    {
        $session = new oneSession($row['session_id'],  $row['creation_time'], $row['patient_name'],$row['patient_email']);
        $sessionList[]= $session;
    }
    if($sessionList=='')
        echo('No result. Try again');
}
//=====================================================================================================================
function redirectSwitcher($a)
{
    //если что то пошло не так, передаем переменную и делаем редирект на страницу ошибки
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$a.'";';
    echo '</script>';
}

function browserAnalyzer () {
    $serverVar = $_SERVER['HTTP_USER_AGENT'];
    if(preg_match("/\bTrident\b/i",$serverVar) == 0 )
    {
        if (preg_match("/\biPhone\b/i",$serverVar) !=0 || preg_match("/\biPad\b/i", $serverVar) !=0)
            return 1;
        else
            return 0;
    }
    else
        return 2;
}


function getPassForRemind ($mail) {
    $sql = "SELECT password  FROM tbl_patients WHERE email = '$mail'";
    $stmt = Initializer()->query($sql);
    $res = $stmt->fetch(2);
    if ($res != false) {
        return ($res['password']) ;
    }
    else {
        return false;
    }
}
function sendMail($patEmail, $pass)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtpout.secureserver.net';
    $mail->Port = 465;
    $mail->isHTML();
    $mail->Username = 'support@medical-stream.com';
    $mail->Password = 'support1319';
    $mail->SetFrom('support@medical-stream.com');
    $mail->Subject = 'Password remind';
    $mail->Body    = 'Hello! Here is your current password from medical-stream1.com <br> Password:'. $pass;
    $mail->addAddress($patEmail, 'Dear Patient');
    $mail->send();
}

