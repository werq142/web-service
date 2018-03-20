<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function store()
    {
        $rules = array(
            'name'  => 'required',
            'email' => 'required|email',
            'password' => 'required',
        );
        $email = request('email');
        if (User::where('email', '=', request('email'))->count() > 0)
        {
            return response()->json(array(
                'response' => '403'
            ));
        }
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        return response()->json(array(
            'response' => '200'
        ));
    }
}
