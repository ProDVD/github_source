<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Switcher extends Model
{
    public static function userAuth($mail, $pass)
    {
        $res = Doctor::where('email', $mail)->where('password', $pass)->first();
        if($res != null) {
            session(['docEmail' => $mail]);
            return $res;
        } else if(($res = Patient::where('email', $mail)->where('password', $pass)->first()) != null) {
            return $res;
        } else
            return null;
    }

    public static function getSessByPatId($sess_id)
    {
        $res = Session::where('patient_id', $sess_id)->get()->sortByDesc('creation_time');
        if(!empty($res->toArray())) {
            foreach ($res as $k) {
                $sessionList[] = $k->toArray();
            }
            return $sessionList;
        }
        return false;
    }
    public static function getSessByDocId($sess_id)
    {
        $res = Session::where('doctor_id', $sess_id)->get()->sortByDesc('creation_time');
        if(!empty($res->toArray())) {
            foreach ($res as $k) {
                $sessionList[] = $k->toArray();
            }
            return $sessionList;
        }
        return false;
    }

    public static function getFilesById($id)
    {
        $rows = DB::table('tbl_files')
            ->rightJoin('tbl_cloud_drives', 'tbl_cloud_drives.cloud_drive_id', '=', 'tbl_files.cloud_drive_id')
            ->select('tbl_files.name', 'tbl_files.crtDateTime', 'tbl_files.duration', 'tbl_files.path', 'tbl_cloud_drives.Browse_key')
            ->where('tbl_files.session_id', $id)
            ->get();

        foreach ($rows as $row) {
            $fileList[] = new Files($row->name, $row->duration, $row->path, $row->Browse_key);
        }
        return $fileList;
    }

    public static function browserAnalyzer()
    {
        $serverVar = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match("/\bTrident\b/i", $serverVar) == 0) {
            if(preg_match("/\biPhone\b/i", $serverVar) != 0 || preg_match("/\biPad\b/i", $serverVar) != 0)
                return 1;
            else
                return 0;
        } else
            return 2;
    }

    public static function mainSearchEngine($p_name, $p_dt_start = '', $p_dt_end = '')
    {
        if($p_name != '') {
            $res = DB::table('v_session_search')
                ->where('patient_email', 'like', '%' . str_replace(' ', '', $p_name) . '%')
                ->orWhere('patient_name', 'like', "%{$p_name}%")
                ->get();
        }
        return $res;
//        $doc_email = session('docEmail');
        $doc_email = 'operator@mail.org';
        dd($res);
        if($p_dt_start != '' and $p_dt_end != '')
        $sql .= " and t.creation_time between convert(datetime, '$p_dt_start' , 110) and convert(datetime, '$p_dt_end' , 110)";
    else if($p_dt_start != '')
        $sql .= " and t.creation_time >= convert(datetime, '$p_dt_start' , 110)";

    else if($p_dt_end != '')
        $sql .= " and t.creation_time <= convert(datetime, '$p_dt_end' , 110)";

        $sql .= " and upper (t.doctor_email ) like upper('%$doc_email%') order by session_id desc";

        if($doc_email != null and $p_name == null and $p_dt_start == null and $p_dt_end == null) {
            $sql = "select top 3 session_id, creation_time, patient_name, patient_email from v_session_search t  where 1=1  and upper (t.doctor_email )= '$doc_email' order by session_id desc";
        }

//        $res = $sql;
        if($res == null)
            echo('No result. Try again');
        else
            return $res;
    }

    public static function DoctorSearchEngine($p_name, $p_dt_start, $p_dt_end)
    {
        global $sessionList;
        $doc_email = session('docEmail');
        $sql = "SELECT session_id, creation_time, patient_name, patient_email FROM v_session_search t  WHERE 1=1";

        if($p_name != '') {
            if(strpos($p_name, '@') != false)
                $sql .= " and upper(t.patient_name) like upper ('%$p_name%' )";
            else
                $sql .= " and upper(t.patient_email) like upper ('%$p_name%' )";
        }

        if($p_dt_start != '' and $p_dt_end != '')
            $sql .= " and t.creation_time between convert(datetime, '$p_dt_start' , 110) and convert(datetime, '$p_dt_end' , 110)";

        else if($p_dt_start != '')
            $sql .= " and t.creation_time >= convert(datetime, '$p_dt_start' , 110)";

        else if($p_dt_end != '')
            $sql .= " and t.creation_time <= convert(datetime, '$p_dt_end' , 110)";

        $sql .= " and upper (t.doctor_email )= '$doc_email' order by session_id desc";

        if($doc_email != null and $p_name == null and $p_dt_start == null and $p_dt_end == null) {
            $sql = "select top 3 session_id, creation_time, patient_name, patient_email from v_session_search t  where 1=1  and upper (t.doctor_email )= '$doc_email' order by session_id desc";
        }
        $stmt = Initializer()->query($sql);
        $sessionList = null;
        while ($row = $stmt->fetch(2)) {
            $session = new oneSession($row['session_id'], $row['creation_time'], $row['patient_name'], $row['patient_email']);
            $sessionList[] = $session;
        }
        if($sessionList == '')
            echo('No result. Try again');
    }

    public static function defaultFunc($doctor_id)
    {
//        SELECT [session_id]
//      ,[creation_time]
//      ,[device_id]
//      ,[isEmailSent]
//      ,[comment]
//      ,[patient_id]
//      ,[doctor_id]
//  FROM [dbo].[tbl_session_protocol] t
//  where t.doctor_id=10
//    and  cast(t.creation_time as date) = (select cast(max(s.creation_time) as date) from tbl_session_protocol s where s.doctor_id=10);
        return  DB::table('tbl_session_protocol')->select(['session_id', 'creation_time', 'device_id', 'patient_id', 'doctor_id'])->where('doctor_id', $doctor_id)->orderBy('creation_time', 'desc')->get();
//        return $res;
//        return $res->where('creation_time', '<=', Carbon::now()->subDay())->get();
    }
}
