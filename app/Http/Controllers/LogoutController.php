<?php

namespace App\Http\Controllers;

use App\Http\Service\Token;

class LogoutController extends Controller
{
    /**
     * googleに認可リクエストをリダイレクトする
     *
     * @return mixed
     */
    public function logout()
    {
        $token = new Token();
        $token->destroyTokensFromClient();

        return view('logout/complete');
    }

}
