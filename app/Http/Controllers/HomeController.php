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
        dd(Switcher::defaultFunc(10));
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

}
