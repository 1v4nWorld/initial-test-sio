<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
	* Handle an authentication attempt.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/

	public function authenticate(Request $request) {
        $credentials = $request->validate([
			'username' => 'required',
			'password' => 'required',
		]);

		if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
			return $this->respSuccess(Auth::user());
		} else {
			return $this->respError("user", "Unauthenticated.");
		}
    }

	public function list(Request $request) {
		return $this->respSuccess(Auth::user());
    }
}
