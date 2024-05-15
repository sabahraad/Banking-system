<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\User;
use App\Models\transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userCreateForm(){
        return view('registration');
    }

    public function createUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email'=>'required|email|unique:users,email',
            'account_type' => 'required|in:Individual,Business',
            'password'=> 'required|string',
            'password_confirmation'=>'required|string'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors());
        }

        if($request->password != $request->password_confirmation){
            return redirect()->back()
                ->with('error', 'password does not match');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'account_type' => $request->account_type
        ]);

        return redirect()->route('loginForm')->with('success','Registration Done');

    }

    public function loginForm(){
        return view('login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=> 'required|string'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors());
        }
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials, false)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()
                ->with('error', __('You have entered an invalid credentials.'))
                ->withInput($request->input());
        }
    }

    public function dashboard(){
        $data = transaction::where('user_id', Auth::user()->id)
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->get([
            'transactions.*',
            'users.name as user_name',
            'users.email as user_email'
        ]);
        return view('showAllTransaction',compact('data'));
    }

    public function logout(){
        try {
            Auth::logout();
            return redirect()->route('loginForm')->with('success', __('You have been logged out successfully.'));
        } catch (Exception $e) {
            return redirect()->route('loginForm')->with('error', $e->getMessage());
        }
    }
}
