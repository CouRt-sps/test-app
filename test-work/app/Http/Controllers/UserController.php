<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function listUser()
    {
        $users = User::all();
        return view('user.list', ['users' => $users]);
    }

    public function addUser(Request $request)
    {
        $role = $request->get('role');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User();
        $user->role = $role;
        $user->email = $email;
        $user->password = $password;
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);

        $user->save();
        return redirect()->route('user-list')->with('success', 'Пользователь успешно добавлен.');
    }

    public function updateUser(Request $request, $id)
    {
        $role = $request->get('role');
        $email = $request->get('email');
        $password = $request->get('password');
        //$id = $request->get('id');

        $user = User::find($id)->update(['role' => $role, 'email' => $email, 'password' => $password]);
    }

    public function deleteUser($id)
    {
        $user = User::where('id', '=', $id)->delete();
        return redirect()->route('user-list')->with('success', 'Пользователь успешно удален.');
    }
}
