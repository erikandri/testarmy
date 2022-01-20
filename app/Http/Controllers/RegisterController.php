<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
			'name' => ['required', 'unique:users,name'],
			'email' => ['required', 'unique:users,email', 'email'],
			'password' => ['required', 'confirmed']
		]);
		
		$register = User::create([
			'name' => $credentials['name'],
			'email' => $credentials['email'],
			'password' => Hash::make($credentials['password'])
		]);
		
		return redirect()->route('login.index')->with(['email' => $credentials['email'], 'password' => $credentials['password']]);
    }
}
