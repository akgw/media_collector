<?php

namespace App\Http\Middleware;

use App\Http\Service\Token;
use Closure;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->isLoggedIn()) {
            return redirect('oauth/request');
        }
        return $next($request);
    }

    /**
     * ログイン状態かどうか
     *
     * @return bool
     */
    private function isLoggedIn(): bool
    {
        $token = new Token();
        $tokens = $token->getTokensFromClient();
        if (empty($tokens['idToken'])) {
            return false;
        }

        if ($token->isExpireTime($tokens['idToken'])) {
            return false;
        }

        return true;
    }
}
