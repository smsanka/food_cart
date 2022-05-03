<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Parent_controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);

        // $this->middleware( [
        //     'auth:sanctum',
        //     config('jetstream.auth_session'),
        //     'verified'
        // ]);
    }
}
