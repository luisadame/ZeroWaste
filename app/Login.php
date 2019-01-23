<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Events\Login as LoginEvent;
use Illuminate\Auth\Events\Failed as FailedLoginEvent;

class Login extends Model
{
    public $timestamps = false;

    public static function successful(LoginEvent $event)
    {
        $login = new Login;
        $login->user_id = $event->user->id;
        $login->ip = request()->ip();
        $login->successful = true;
        $login->save();
    }

    public static function failed(FailedLoginEvent $event)
    {
        $login = new Login;
        $login->user_id = User::where('email', $event->credentials['email'])->first()->id ?? null;
        $login->ip = request()->ip();
        $login->successful = false;
        $login->save();
    }
}
