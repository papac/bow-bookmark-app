<?php

namespace App\Controller;

use App\Controller\Controller;
use Bow\Http\Request;

class UserController extends Controller
{
    /**
     * Create the new user
     * 
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $user = $this->make($request);

        if ($user->exists('email', $user->email)) {
            return json([
                'status' => ['code' => 403, 'message' => 'Email is not available', 'success' => true],
                'data' => []
            ]);
        }

        // Create user and generate authentification token
        $user->save();
        $token = $user->generateToken();

        // Send response to user
        return json([
            'status' => ['code' => 200, 'message' => 'Ok', 'success' => true],
            'data' => [
                'access_token' => $token->getToken(),
                'expirate_at' => $token->expireIn(),
                'user' => $user
            ]
        ]);
    }

    public function current()
    {

    }

    /**
     * Make the user instance
     * 
     * @param Request $request
     * @return User
     */
    private function make(Request $request)
    {
        return new User([
            'id' => null,
            'name' => $request->name,
            'description' => $request->text,
            'email' => $request->email,
            'password' => bhash($request->password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Make validation
     * 
     * @param Request $request
     * @return mixed
     */
    private function validation(Request $request)
    {
        $validation = validator($request->all(), [
            'name' => 'required|max:200',
            'description' => 'required',
            'email' => 'required|email|not_exists:users,email',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            throw (new \App\Exception\UserValidationException('Error occured in data validation'))
                ->setValidation($validation);
        }
    }
}
