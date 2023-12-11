<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Logic\Notification;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\Apps\Manager;

class AuthController extends Controller
{
    function __construct()
    {
        if (Auth::check()) {
            redirect()->route('home')->send();
        }
    }

    public function login()
    {
//        Notification::setNotification("Login Page", " Is Not Available", 'danger', 'top');
        return view('Website.Login');
    }

    public function signup()
    {
//        Notification::setNotification("Signup Page", " Is Not Available", 'success', 'bottom');
        return view('Website.Register');
    }

    public function fastLogin(Request $request)
    {
        Auth::login(User::find($request->id), true);
        return redirect(route('home'));
    }

    public function loginAction(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ], true)) {
            return redirect(route('home'));
        } else {
            Notification::setNotification("Login Failed", "Credential Mismatch", 'danger', 'bottom');
            return back();
        }
    }

    public function signupAction(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $first_name = $request->first_name;
        $last_name = $request->last_name;

        $user = new User;
        $user->email = $email;
        $user->plan_id = 1;
        $user->password = Hash::make($password);
        $user->name = $first_name . " " . $last_name;
        if ($user->save()) {
			$user_id = $user->id;
			 $plan = Plan::where("id",1)->first();
			
			$manager = new Manager;
			 $manager->updateZaps($user_id,$plan->maxConnections,$plan->taskPerMonth);
			 
            Notification::setNotification("Signup Success", "Please login to continue", 'success', 'bottom');
            return redirect(route('login'));
        } else {
            Notification::setNotification("Signup Failed", "Please try again", 'danger', 'bottom');
            return back();
        }
    }
}
