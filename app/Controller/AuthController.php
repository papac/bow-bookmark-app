<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\User;
use Bow\Http\Request;
use App\Traits\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * Show index
     *
     * @param Request $request
     * @return string
     */
    public function make(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        // Check user password
        if (is_null($user) || !bhash($request->get('password'), $user->password)) {
            return $this->makeResponse('Your credentials is invalid.', false);
        }

        // Generate the token
        $token = $user->generateToken();

        return $this->makeResponse('Ok', [
            'access_token' => $token->getToken(),
            'expirate_at' => $token->expireIn(),
            'user' => $user
        ]);
    }
}
