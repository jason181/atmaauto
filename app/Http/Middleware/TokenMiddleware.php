<?php

namespace App\Http\Middleware;

use App\Token;
use App\Pegawai;
use Closure;

class TokenMiddleware
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
        if ($request->header()['token-username'][0] && $request->header()['token-password'][0]) {
            $token = Token::where([
                'Token_Username' => $request->header()['token-username'][0],
                'Token_Password' => $request->header()['token-password'][0],
            ])->first();

            if ($token) {
                $pegawai = Pegawai::find($token->Id_Pegawai);
            }

            $request->pegawai = $pegawai;
        }

        return $next($request);
    }
}
