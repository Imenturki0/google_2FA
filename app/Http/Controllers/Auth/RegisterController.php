<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    // Method to display the registration form
    public function showRegistrationForm()
    {
        return view('auth.register'); // Create a corresponding view for the registration form
    }

    // Method to handle the registration form submission
    public function processRegistration(Request $request)
    {
        
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Store the user data in the session (You can also save this data to the database)
        $request->session()->put('user', [
            'name' => $request->name,
            'email' => $request->email,
            // You may hash the password before saving it in the session
             'password' => bcrypt($request->password),
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        
        $user->save();

        // Redirect the user after successful registration
        return redirect()->route('home')->with('success', 'Registration successful!');
    
    }
    public function register(Request $request)
    {
        //Validate the incoming request using the already included validator method
        ///$this->validator($request->all())->validate();

        // Initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // Save the registration data in an array
        $registration_data = $request->all();

        // Add the secret key to the registration data
        $registration_data["google2fa_secret"] = $google2fa->generateSecretKey();

        // Save the registration data to the user session for just the next request
        $request->session()->flash('registration_data', $registration_data);
        $userData = $request->session()->get('user');
        $name = $userData['name'];   // 'John Doe'
        $email = $userData['email']; // '
       
        // Generate the QR image. This is the image the user will scan with their app
     // to set up two factor authentication
     
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
           $email,
            $registration_data['google2fa_secret']
        );

        // Pass the QR barcode image to our view
        return view('google2fa.register', ['QR_Image' => $QR_Image, 'secret' => $registration_data['google2fa_secret']]);
    
   
    }

}