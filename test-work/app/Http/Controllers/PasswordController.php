<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordController extends Controller
{
    public function show()
    {
        return view('password');
    }

    public function listPassword()
    {
        $passwords = Password::all();
        return new Response(json_encode($passwords));
    }

    public function addPassword(Request $request): object
    {
        $title = $request->get('title');
        $value = $request->get('password');
        $group = $request->get('group.id');
        $user = $request->get('user.id');
        $access = $request->get('access');

        $password = new Password();
        $password->title = $title;
        $password->password = $value;
        $password->group_id = $group;
        $password->user_id = $user;
        $password->access = $access;

        $password->save();
        return redirect()->route('password.list')->with('success', 'Пользователь успешно добавлен.');
    }

    public function updateUser(Request $request, $id)
    {
        $title = $request->get('title');
        $value = $request->get('password');
        $group = $request->get('group.id');
        $access = $request->get('access');
        //$id = $request->get('id');

        $password = Password::find($id)->update(['title' => $title, 'password' => $value, 'group_id' => $group, 'access' => $access]);
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
