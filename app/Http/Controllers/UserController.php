<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\TelkomselNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('edit_profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric', Rule::unique('users', 'phone')->ignore($user->id), TelkomselNumber::class],
        ]);


        $user->name = ucwords($request->name);
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('profile');
    }

    public function edit_password(User $user)
    {
        return view('edit_password', compact('user'));
    }

    public function update_password(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile');
    }
}
