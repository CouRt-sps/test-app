<?php

namespace App\Http\Controllers;

use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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

    public function addPassword(Request $request)
    {
        $title = $request->get('title');
        $value = $request->get('password');
        $group = $request->get('selectedGroup');
        $user = $request->get('userId');
        $access = $request->get('access');

        $password = new Password();
        $password->title = $title;
        $password->password = Hash::make($value);
        $password->group_id = $group;
        $password->user_id = $user;
        $password->access = $access;

        $password->save();
        //return redirect()->route('show')->with('success', 'Пользователь успешно добавлен.');
    }

    public function updatePassword(Request $request, $id)
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
