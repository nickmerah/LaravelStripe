<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller

{


    public function index()

    {

        return view('auth.login');

    }




    public function registration()

    {

        return view('auth.registration');

    }



    public function postLogin(Request $request)

    {

        $request->validate([

            'email' => 'required',

            'password' => 'required',

        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
        $checkActive = User::select('isActive')->where('email', $request->email)->first(); //check if user is enabled
        if ($checkActive->isActive) {
           // return response($checkActive, Response::HTTP_ACCEPTED);
           return redirect()->intended('dashboard')->withSuccess('You have Successfully loggedin');
        }

          return back()->withInput()->withErrors([
            'Error: Your Account in not Active, Contact the Admin',
        ]);
        }

        return back()->withInput()->withErrors([
            'Error: You have entered invalid credentials',
        ]);


    }

    public function dashboard()

    {

        return view('dashboard', ['user' => Auth::user(), 'isAdmin' => Auth::user()->isAdmin]);



    }



    public function create(RegisterRequest $request)

    {
        //check if a strong password was inputted

        $request->validate([
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $user = User::create(
            $request->only('fullnames', 'phoneno', 'email')
            + [
                'password' => \Hash::make($request->input('password'))
            ]
        );

       return redirect("login")->withSuccess('Account Successfully Created, But will require activation before you can login');

    }



    public function logout() {

        Session::flush();

        Auth::logout();



        return Redirect('login')->withSuccess('You have successfully logged out');;

    }



}

