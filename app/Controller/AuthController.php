<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\User;
use Bow\Http\Request;

class HomeController extends Controller
{
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
        if (!bhash($request->get('password'), $user->password)) {
            return json([
                'status' => [
                    'code' => 404,
                    'message' => 'Your credentials is invalid.',
                    'success' => false
                ],
                'data' => []
            ]);
        }

        // Generate the token
        $token = $user->generateToken();

        // Send response to user
        return json([
            'status' => [
                'code' => 200,
                'message' => 'Ok',
                'success' => true
            ],
            'data' => [
                'access_token' => $token->getToken(),
                'expirate_at' => $token->expireIn(),
                'user' => $user
            ]
        ]);
    }
}
