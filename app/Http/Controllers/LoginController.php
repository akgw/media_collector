<?php

namespace App\Http\Controllers;

use App\Http\Service\Token;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /**
     * googleに認可リクエストをリダイレクトする
     *
     * @return mixed
     */
    public function redirectGoogleAuthorization()
    {
        $queries = [
            'client_id' => \Config::get('auth.googleClientId'),
            'redirect_uri' => \Config::get('app.url') . '/oauth/response',
            'scope' => 'https://www.googleapis.com/auth/userinfo.profile',
            'response_type' => 'code',
        ];

        $uri = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($queries);

        return redirect($uri);
    }

    /**
     * ログイン処理
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $code = $request->input('code');

        $params = [
          'code' => $code,
          'client_id' => \Config::get('auth.googleClientId'),
          'client_secret' => \Config::get('auth.googleClientSecret'),
          'redirect_uri' => \Config::get('app.url') . '/oauth/response',
          'grant_type'    => 'authorization_code',
        ];

        $url = 'https://accounts.google.com/o/oauth2/token';

        $client = new Client();

        $response = $client->post($url, [
            'form_params' => $params,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        if (empty($response)) {
            // ログインエラー
            return;
        }
        $tokens = json_decode((string)$response->getBody());

        $token = new Token();

        $token->setTokensToClient($tokens);

        // ログインOKなのでリダイレクト
        return redirect('/twitter');
    }
}
