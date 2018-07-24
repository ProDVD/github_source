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
            redirect('pages.docmode');
        } elseif($user instanceof Patient) {
            redirect('pages.docmode');
        } else {
            dd('null');
        }

        dd($user->patient_id);
        $var = Switcher::getSessByPatId($user->patient_id);
        if($isDoctor) {
            redirect('/docmode');
        } else {
            redirect('/user');
        }


    }

}
