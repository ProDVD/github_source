<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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


