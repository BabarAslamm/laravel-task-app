<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The credentials you entered are incorrect.'
            ]);
        }

        return response()->json(['message' => 'Login successful'], 200);
    }
}
