<?php
//patient test
namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\Switcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $sessionList;
    public function test()
    {
        dd($this->defaultFunc());
        //$var = Switcher::userAuth('patient_1@mail.ru', 'fesgxh');
//        $var = Switcher::getSessByPatId(2437);
//        dd($var);
    }

    public function patient()
    {
        $res = Switcher::getSessByPatId(session('user'));
        $browserAnalyzer = Switcher::browserAnalyzer();
        if(!$res){
            return redirect('/');
        }
        return view('pages.patient', [
            'sessionList' => Switcher::getSessByPatId(session('user')),
            'browserAnalyzer' => $browserAnalyzer
        ]);
    }

    public function docmode()
    {
        $browserAnalyzer = Switcher::browserAnalyzer();
        return view('pages.docmode', [
            'sessionList' => Switcher::getSessByDocId(session('doc')),
            'browserAnalyzer' => $browserAnalyzer,
        ]);
    }

    public function forgot()
    {

    }

    public function switcher(Request $request)
    {
        $user = Switcher::userAuth($request->get('email'), $request->get('password'));
        if($user instanceof Doctor) {
             $to = '/docmode';
            session(['doc' => $user->doctor_id]);
        } elseif($user instanceof Patient) {
            session(['user' => $user->patient_id]);
            $to = '/patient';
        } else {
            $to = '/';
        }
        return redirect($to);
    }

    public function getFiles($id)
    {
        $results = Switcher::getFilesById($id);
        foreach ($results as $res){
            $fileList[] = [
                'directLink' => $res->directLink,
                'downloadLink' => $res->downloadLink,
                'thumbnailSource' => $res->thumbnailSource,
                'type' => $res->type,
                'time' => $res->time,
                'name' => $res->name
            ];
        }
        return response()->json($fileList);
    }

    public function search($text)
    {
        $res = Switcher::mainSearchEngine($text);
        return response()->json($res);
    }

    public function defaultFunc()
    {
//        $doctor_id = session('doc');
        $doctor_id = 1024;
//        return  DB::table('tbl_session_protocol')->select(['session_id', 'creation_time', 'device_id', 'patient_id', 'doctor_id'])->where('doctor_id', $doctor_id)->addSelect(DB::raw('cast(creation_time as date) = cast(max(creation_time) as date)'))->get();
//        return DB::table('tbl_session_protocol')->select(['session_id', 'creation_time', 'device_id', 'patient_id', 'doctor_id'])->where('doctor_id', $doctor_id)->where(DB::raw('cast(creation_time as date) = cast(max(creation_time) as date)'))->get();
//        return 545;
//        return $res->where('creation_time', '<=', Carbon::now()->subDay())->get();


        $pdo = new \PDO("sqlsrv:server = tcp:ssmserver2.database.windows.net,1433; Database = db_ssm", "prodvdadmin", "AdminQwerty123");


        $row = $pdo->query("SELECT session_id, creation_time, device_id, patient_id, doctor_id FROM tbl_session_protocol t WHERE t.doctor_id='$doctor_id' AND  CAST(t.creation_time AS DATE) = (SELECT CAST(MAX(s.creation_time) AS DATE) FROM tbl_session_protocol s WHERE s.doctor_id='$doctor_id')");

        return response()->json($row->fetchAll(2));
    }
}
