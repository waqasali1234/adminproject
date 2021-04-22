<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function toResponse ($request)
	{
		if ($request->wantsJson()) {
			return response()->json(['two_factor' => false]);
		}

		switch (Auth::user()->role) {
			case 'admin':
				return redirect()->intended(config('fortify.home_admin'));

			default:
				return redirect()->intended(config('fortify.home'));
		}
	}
}
