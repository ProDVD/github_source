<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Switcher extends Model
{
    public static function userAuth($mail, $pass)
    {
        $res = Doctor::where('email', $mail)->where('password', $pass)->first();
        if($res!=null) {
            return $res;
        }
        else if(($res = Patient::where('email', $mail)->where('password', $pass)->first())!=null) {
            return $res;
        } else
            return null;
    }

    public  static function getSessByPatId($sess_id)
    {
        $res = Session::where('patient_id', $sess_id)->get()->sortByDesc('creation_time');
        foreach($res as $k)
        {
            $sessionList[] = $k->toArray();
        }
        return $sessionList;
    }
}
