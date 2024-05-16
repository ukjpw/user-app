<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        return view('users.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create'); //->with('endpointUrl', $endpointURL);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.edit')->with('userId', $id);
    }
}
