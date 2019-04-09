<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Token;
use App\Pegawai;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\InvalidTokenException;
use App\Transformers\TokenTransformers;
use App\Transformers\UserTransformer;
use App\Exceptions\InvalidCredentialException;
use Hash;
use App\Events\TokenRefresh;

class TokenController extends RestController
{
    protected $transformer = TokenTransformers::class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            $user = $this->validateUser($request->get('username'), $request->get('password'));
            $now = Carbon::now();
            $token = new Token;
            $token->Id_Pegawai=$user->Id_Pegawai;
            $token->Token_Username=str_random(32);
            $token->Token_Password=str_random(32);
            $token->save();
            $response = $this->generateItem($token);
            return $this->sendResponse($response, 201);
        } catch (InvalidCredentialExcpetion $e) {
            return $this->sendNotAuthorizeResponse($e->getMessage());
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    public function validateUser($username,$password)
    {
        try{
            $user = Pegawai::where('Username',$username)->firstOrFail();
            
            if (!password_verify($password, $user->Password)) {
                throw new InvalidCredentialException();
            }

            return $user;
        } catch(ModelNotFoundException $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function validateToken(Request $request)
    {
        try {
            $header = $request->header('Authorization');
            list($type, $payload) = explode(" ", $header);
            list($username, $password) = explode(":", base64_decode($payload));
            $token = Token::where('Token_Username', $username)->first();
            $pegawai = Pegawai::find($token->Id_Pegawai);
            event(new TokenRefresh($token));
            $item = $this->generateItem($pegawai,'App\Transformers\PegawaiTransformers');
            return $this->sendResponse($item);
        } catch (\Exception $e) {
            return $this->sendNotAuthorizeResponse($e->getMessage());
        } catch (InvalidTokenException $e) {
            throw $e;
        }
    }
    public function index()
    {
        $tokens = Token::all();
        $response = $this->generateCollection($tokens);
        return $this->sendResponse($response);
    }
}