<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthenticationController extends Controller
{
    // Login View
    public function login_view() {
        return view('login');
    }

    // Login Process
    public function login_authenticate(Request $request) {
        // Get the username and password form
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Attempt to check if the user does exist, and username and password is correct
        if(Auth::attempt($credentials)) {
            // Generate session
            $request->session()->regenerate();

            // Check user role and redirect to the appropriate page
            if(Auth::user()->role == 0) {
                return redirect()->intended('/superadmin');
            } else if(Auth::user()->role == 1) {
                return redirect()->intended('/admission');
            } else if(Auth::user()->role == 2) {
                return redirect()->intended('/chairperson');
            }
        }

        // If the credentials is not correct, return error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our existing records.',
        ])->onlyInput('username');
    }

    // Logout process
    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        return redirect()->intended(route('login.view'));
    }

    // Change password
    public function change_password() {
        return view('change-password');
    }

    // Process change password
    public function save_change_password(Request $request) {
        $credentials = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password'      => 'required_with:new_password|same:new_password'
        ]);

        // Retrieve authenticated user
        $user = Auth::user();

        if($credentials === []) {
            return back()->withErrors($credentials);
        } else {
            if(!Hash::check($credentials['old_password'], $user->password)) {
                return back()->with('errMessage', 'The current password provided doesn\'t matched with the existing password.');
            }
            
            $user_credentials = User::findOrFail($user->id);

            $user_credentials->password = Hash::make($credentials['new_password']);
            $user_credentials->save();

            return back()->with('successMessage', 'Password change successfully.');
        }
    }
}
