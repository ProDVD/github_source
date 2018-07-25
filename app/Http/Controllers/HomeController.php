<?php
//patient test
namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\Switcher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $sessionList;
    public function test()
    {
        dd(Switcher::getFilesById(10));
        //$var = Switcher::userAuth('patient_1@mail.ru', 'fesgxh');
//        $var = Switcher::getSessByPatId(2437);
//        dd($var);
    }

    public function patient()
    {
        $sessionList;
        $res = Switcher::getSessByPatId(session('user'));
        $browserAnalyzer = Switcher::browserAnalyzer();

        return view('pages.patient', [
            'sessionList' => Switcher::getSessByPatId(session('user')),
            'browserAnalyzer' => $browserAnalyzer
        ]);
    }

    public function docmode()
    {
        return view('pages.docmode', [
            'sessionList' => ''
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
        } elseif($user instanceof Patient) {
            session(['user' => $user->patient_id]);
            $to = '/patient';
        } else {
            $to = '/';
        }
        return redirect($to);
    }

    public function ajax($id)
    {
        $fileList = Switcher::getFilesById($id);
        return view('ajax', compact('fileList'));
    }
}
