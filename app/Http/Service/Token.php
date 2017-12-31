<?php

namespace App\Http\Service;

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;


class Token
{
    public function getTokensFromClient()
    {
        return [
          'idToken' => session('idToken'),
            'accessToken' => session('accessToken'),
        ];
    }

    /**
     * トークンをセッションに保存
     *
     * @param $tokens
     */
    public function setTokensToClient($tokens)
    {
        session([
            'accessToken' => $tokens->access_token,
            'idToken' => $tokens->id_token,
        ]);
    }

    /**
     * トークンをセッションから消去
     */
    public function destroyTokensFromClient()
    {
        session()->forget('accessToken');
        session()->forget('idToken');
    }

    /**
     * トークンの有効時間内である
     *
     * @param $idToken
     * @return bool
     */
    public function isExpireTime(string $idToken): bool
    {
        $parser = new Parser();
        $token = $parser->parse($idToken);

        $validationData = new ValidationData();
        $validationData->setCurrentTime(time() + 60);

        if ($token->validate($validationData) === true) {
            return false;
        }

        return true;
    }


}
