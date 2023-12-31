<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordGroup\StoreRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(): \Illuminate\View\View
    {
        return view('user');
    }

    public function listUser(): Response
    {
        $users = User::all();
        return new Response(json_encode($users));
    }

    /**
     * Добавить нового пользователя.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addUser(Request $request): void
    {
        $role = $request->get('role');
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User();
        $user->role = $role;
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);

        $user->save();
    }

    public function updateUser(StoreRequest $request, User $user): User
    {
        $data = $request->validated();
        $user->update($data);
        return $user;
    }

    public function deleteUser(User $user): Response
    {
        $user->delete();
        return response([]);
    }
}
