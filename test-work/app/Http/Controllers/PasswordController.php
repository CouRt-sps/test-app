<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordGroup\PasswordRequest;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordController extends Controller
{
    public function show(): \Illuminate\View\View
    {
        return view('password');
    }

    public function listPassword(): Response
    {
        $passwords = Password::all();
        return new Response(json_encode($passwords));
    }

    public function addPassword(Request $request): void
    {
        $title = $request->get('title');
        $value = $request->get('password');
        $group = $request->get('selectedGroup');
        $user = $request->get('userId');
        $access = $request->get('access');

        $password = new Password();
        $password->title = $title;
        $password->password = $value;
        $password->group_id = $group;
        $password->user_id = $user;
        $password->access = $access;

        $password->save();
    }

    public function updatePassword(PasswordRequest $request, Password $password): Password
    {
        $data = $request->validated();
        $password->update($data);
        return $password;
    }

    public function generationPassword(): string
    {
        $password = null;

        $symbols = 'qwertyuiopasdfghjklzxcvbnm,.!/#?_$%^:;&*QWERTYUIOPASDFGHJKLZXCVBNM1234567890';

        for ($i=0; $i<20; $i++) {
            $randomIndex = rand(0, strlen($symbols) - 1);
            $randomSymbol = $symbols[$randomIndex];

            $password = $password . $randomSymbol;
        }

        return $password;
    }
}
