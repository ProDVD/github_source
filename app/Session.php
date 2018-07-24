<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'tbl_session_protocol';
    public $session_id;
    public $sessDate;
    public $patient_name;
    public $patient_email;

//    public function __construct($a)
//    {
//        dd($a);
//        $this ->sessionId = $a;
//        $this ->sessDate = explode(' ', $b)[0];
//        $this ->patient_name = $c;
//        $this ->patient_email = $d;
//    }
}
