<?php

namespace App\Http\Controllers;

use App\Models\PasswordGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordGroupController extends Controller
{
    public function addGroup(Request $request): void
    {
        $group = $request->get('name');

        $passwordGroup = new PasswordGroup();
        $passwordGroup->name = $group;
        $passwordGroup->save();
    }

    public function listGroup(): Response
    {
        $groups = PasswordGroup::all();
        return new Response(json_encode($groups));
    }
}
