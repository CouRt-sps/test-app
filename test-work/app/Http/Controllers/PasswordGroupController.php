<?php

namespace App\Http\Controllers;

use App\Models\PasswordGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordGroupController extends Controller
{
    public function addGroup(Request $request)
    {
        $group = $request->get('name');

        $passwordGroup = new PasswordGroup();
        $passwordGroup->name = $group;
        $passwordGroup->save();
    }

    public function listGroup()
    {
        $groups = PasswordGroup::all();
        //return view('password.list', ['groups' => $groups]);
        return new Response(json_encode($groups));
    }
}
