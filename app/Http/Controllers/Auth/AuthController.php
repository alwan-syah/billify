<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function login(Request $request)
	{
		$credentials = $request->validate(
			[
				'email' => 'required|email',
				'password' => 'required',
			],
			[
				'email.required' => 'Email-nya belum di-input nih.',
				'password.required' => 'Password-nya belum di-input nih.',
			]
		);

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return to_route('dashboard');
		}

		return to_route('login')->with('danger', 'Yah, informasi akunnya salah nih.');
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return to_route('home');
	}
}
