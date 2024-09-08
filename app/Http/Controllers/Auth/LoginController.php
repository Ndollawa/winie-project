<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerAction(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash the password before saving
            'address' => $validatedData['address'],
            'date_of_birth' => $validatedData['date_of_birth'],
        ]);

        // Return a view indicating the user was created successfully
        return back()->withSuccess("Patient register successfully");
    }
    public function loginAction(Request $request)
    {
        //Confirm hSHING algorithm if there is an issue
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            if (Auth::user()->status == 'blocked') {
                return redirect("/")->withErrors('User Account has been suspended');
            }

            return redirect()->intended('dashboard')
                ->withSuccess('Welcome ' . Auth::user()->name);
        }

        #use the route url and not name
        return redirect("/")->withErrors('Login details are not valid');
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/')
            ->withSuccess('Session Expired and User logged Out');
    }
}
