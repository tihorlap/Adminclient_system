<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session; // Add this import
use Illuminate\Support\Facades\Auth;    // Add this import to log in user
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        // Validate form input
        $this->validator($request->all())->validate();

        // Generate OTP
        $otp = rand(100000, 999999);

        // Temporarily store user details and OTP in session
        Session::put('user_data', $request->all());
        Session::put('otp', $otp);

        // Send OTP to user's email
        Mail::to($request->email)->send(new OTPMail($otp));

        // Redirect to OTP verification form
        return redirect()->route('otp.verify')->with('success', 'An OTP has been sent to your email.');
    }

    // Show OTP verification form
    public function showOtpVerificationForm()
    {
        return view('auth.otp-verification');
    }

    // Handle OTP verification
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Check if the entered OTP matches the stored OTP
        if ($request->otp == Session::get('otp')) {
            // OTP is correct, proceed with creating the user
            $userData = Session::get('user_data');

            // Create user and save to database
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => 'client', // Default role
            ]);

            // Clear OTP and user data from session
            Session::forget(['otp', 'user_data']);

            // Log the user in
            Auth::login($user);

            return redirect($this->redirectTo)->with('success', 'Your account has been successfully created.');
        }

        // If OTP is incorrect
        return back()->withErrors(['otp' => 'Invalid OTP, please try again.']);
    }
}
