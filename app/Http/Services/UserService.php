<?php

namespace App\Http\Services;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
	public function register($request)
	{
		$user = new User();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);

		$user->save();
	}
}
