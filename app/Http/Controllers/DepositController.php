<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DepositController extends Controller
{
    public function depositList(){
        $data = transaction::where('transaction_type', 'deposit')->where('user_id', Auth::user()->id)
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->get([
            'transactions.*',
            'users.name as user_name',
            'users.email as user_email'
        ]);
        $user = User::where('id', Auth::user()->id)->get();
        return view('depositList',compact('data','user'));
    }

    public function deposit(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=>'required|integer',
            'amount' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors());
        }

        transaction::create([
            'user_id' => $request->user_id,
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'date' => Carbon::now()->toDateString()
        ]);

        $data = User::find($request->user_id);
        $old_balance = $data->balance;
        $new_balance = $old_balance + $request->amount;
        $data->balance = $new_balance;
        $data->save();

        return redirect()->route('depositList')->with('success','Deposit Done');


    }
}
