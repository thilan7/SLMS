<?php
/**
 * Created by PhpStorm.
 * User: Thilan K Bandara
 * Date: 3/28/2017
 * Time: 12:58 AM
 */

namespace App\Http\Controllers;


use App\Mail\MailContent;
use App\Mail\WelcomeMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function postSignUp(Request $request)
    {
        $email = $request['email'];
        $first_name = $request['first_name'];
        $password = bcrypt($request['password']);
        $telephone = $request['telephone'];
        $addmission_no = $request['admission_number'];
        $lastname = $request['last_name'];
        $birth_day = $request['birth_day'];
        $user_level = $request['user_level'];

        $this->validate($request, [
            'email' => 'required|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required',
            'telephone' => 'required|regex:/(0)[0-9]{9}/',
            'admission_number' => 'required|unique:users,admission_number',
            'birth_day' => 'required|date',
            'password' => 'required',
            'user_level' => 'required'
        ]);

        $user = new User();
        $user->email = $email;
        $user->first_name = $first_name;
        $user->last_name = $lastname;
        $user->telephone = $telephone;
        $user->admission_number = $addmission_no;
        $user->birth_day = $birth_day;
        $user->user_level = $user_level;
        $user->password = $password;
        $data=['admissionNo'=>$addmission_no,'password'=>$request['password'],'email'=>$email,'name'=>$first_name];
        Mail::send('loginEmail',$data,function ($message) use ($data){
            $message->to($data['email'],$data['name'])->subject("Welcome to Library!!!");
        });
//        dd($user);
        $user->save();

        $message="Student successfully added!";
        return redirect()->route('addStudents')->with(['message'=>$message]);
    }

    public function postSignIn(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return Redirect::route('dashboard');
        }
        return Redirect::back();
    }

    public function homeButtionPress()
    {
        if (Auth::check()) {
            return Redirect::route('dashboard');
        } else {
            return Redirect::route('homepage');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('homepage');
    }

}