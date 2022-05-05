<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'new_password' => 'same:confirm_new_password',
            'confirm_new_password' => 'same:new_password',
        ]);

        $input = $request->all();

        if ($request->has('new_password')) {
            $input['password'] = bcrypt($input['new_password']);
        } else {
            unset($input['password']);
        }
        $user->update($input);

        return redirect('/profile')->with('message', 'Data updated successfully');
    }
}
