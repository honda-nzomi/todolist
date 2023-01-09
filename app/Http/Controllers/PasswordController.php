<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PasswordController extends Controller
{
    /**
    * パスワード再設定メール送信フォームページ
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function emailFormResetPassword()
    {
        return view('user.reset_password.email_form');
    }
}