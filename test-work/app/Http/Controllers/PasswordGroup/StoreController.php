<?php

namespace App\Http\Controllers\PasswordGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordGroup\StoreRequest;
use App\Models\PasswordGroup;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        return $data;
        //$group = PasswordGroup::create($data);
        return $group;
    }
}
