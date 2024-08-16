<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;

class NewPasswordController extends Controller
{
    public function store(Request $request){
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        auth()->user()->update([
            'password' => bcrypt($validated['password'])
        ]);

        return response()->json(['message' => 'Password updated successfully']);
    }
}
