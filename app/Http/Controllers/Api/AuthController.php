<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
	use ApiResponse;
	public function login( Request $request ) {
		$request->validate( [ 
			'email' => 'required|email',
			'password' => 'required',
		] );

		$user = User::where( 'email', $request->email )->first();

		if ( ! $user || ! Hash::check( $request->password, $user->password ) ) {
			throw ValidationException::withMessages( [ 
				'email' => [ 'The provided credentials are incorrect.' ],
			] );
		}

		$token = $user->createToken( $request->device_name )->plainTextToken;
		return $this->success( [], message: 'Login Successful' );
	}
	public function register( Request $request ) {
	}
	public function forgetPassword( Request $request ) {
	}
}
