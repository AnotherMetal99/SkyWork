<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function GetSignUp(){
      return view('auth.signup');
    }

    public function PostSignUp(Request $request){
      $valid = $request->validate([
          'email' => 'required|min:4|max:50',
          'username' => 'required|alpha_dash|max:20',
          'password' => 'required|min:6',
      ]);

      User::create([
        'email' => $request -> input('email'),
        'first_name' => $request -> input('first_name'),
        'last_name' => $request -> input('last_name'),
        'username' => $request -> input('username'),
        'password' => bcrypt($request -> input('password')), 
      ]);

      return redirect()
           ->route('home')
           ->with('info','Succesful regisrtation');

    }

    public function GetSignIn(){
      return view('auth.signin');
    }

    public function PostSignIn(Request $request){
      $valid = $request->validate([
        'email' => 'required|min:4|max:50',
        'password' => 'required|min:6',
      ]);

      if (!Auth::attempt( $request->only(['email','password']),$request->has('remember'))){
         return redirect()->back()->with('info','Неправильный логин или пароль!');
      }
      return view('home')->with('info','Succesful in!');
    }

    public function GetSignOut(){
      Auth::logout();
      return redirect()->route('home');
    }
}
