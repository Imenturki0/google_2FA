<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        // Perform your authentication logic here (e.g., check user credentials)
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)
        ->where('password', $password)
        ->first();

        if ($user) {
            // User exists
           
            return redirect()->route('dashboard');
        } else {
            // User doesn't exist
            return "User with username $email does not exist!";
        }
        // For demonstration purposes, let's assume the user is authenticated if the username and password match
        if ($email === 'imenturki99@gmail.com' && $password === '111') {
            // Set a session variable to indicate the user is logged in
            $request->session()->put('is_logged_in', true);

            // Redirect the user to the dashboard or any other authenticated page
            return redirect()->route('dashboard');
        }

        // If authentication fails, redirect back to the login form with an error message
        //return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
    echo 'wrong';
    }

    public function logout(Request $request)
    {
        // Clear the session variable to indicate the user is logged out
        $request->session()->forget('is_logged_in');

        // Redirect the user to the login form
        return redirect()->route('login');
    }
}
