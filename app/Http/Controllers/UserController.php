<?php
/**
 * Created by PhpStorm.
 * User: Thilan K Bandara
 * Date: 3/28/2017
 * Time: 12:58 AM
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{



    public function postSignUp(Request $request){

        $email=$request['email'];
        $first_name=$request['first_name'];
        $password= bcrypt( $request['password']);

        $this->validate($request,[
            'email'=>'required|email',
            'first_name'=>'required',
            'password'=>'required'
        ]);

        $user=new User();
        $user->email = $email;
        $user->first_name=$first_name;
        $user->password=$password;
        $user->save();

        Auth::login($user);
        return Redirect::route('dashboard');




    }
    public function postSignIn(Request $request){

        if(Auth::attempt(['email'=>$request['email'],'password'=> $request['password']])){
            return Redirect::route('dashboard');
        }
        return Redirect::back();
    }
    public function getLogout(){
        Auth::logout();
        return Redirect::route('home');
    }

}