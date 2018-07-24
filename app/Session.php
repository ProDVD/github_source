<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'tbl_session_protocol';
    public $sessionId;
    public $sessDate;
    public $patient_name;
    public $patient_email;

//    function __construct($a, $b, $c, $d)
//    {
//        $this ->sessionId = $a;
//        $this ->sessDate = explode(' ', $b)[0];
//        $this ->patient_name = $c;
//        $this ->patient_email = $d;
//    }
}
