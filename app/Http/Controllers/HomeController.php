<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use App\Switcher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function test()
    {
        //$var = Switcher::userAuth('patient_1@mail.ru', 'fesgxh');
//        $var = Switcher::getSessByPatId(2437);
//        dd($var);
        return view('pages.index');
    }

    public function patient()
    {
        return view('pages.patient');
    }

    public function docmode()
    {
        return view('pages.docmode');
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
            $to = '/patient';
            $var = Switcher::getSessByPatId($user->patient_id);
        } else {
            $to = '/';
        }
        return redirect($to);
    }
}
