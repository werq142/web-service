<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'name'  => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'response' => 'bad request'
            ]);
        }
        if (User::where('email', request('email'))->first())
        {
            return response()->json([
                'response' => 'User already exists'
            ], 403);
        }
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        return response()->json([
            'response' => '200'
        ]);
    }
}
