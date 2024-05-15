<?php

namespace App\Http\Controllers;
use App\Models\transaction;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function withdrawalList(){
        $data = transaction::where('transaction_type', 'withdrawal')->where('user_id', Auth::user()->id)
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->get([
            'transactions.*',
            'users.name as user_name',
            'users.email as user_email'
        ]);
        $user = User::where('id', Auth::user()->id)->get();
        return view('withdrwalList',compact('data','user'));
    }

    public function withdrawal(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id'=>'required|integer',
            'amount' => 'required|numeric'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors());
        }

        $data = User::find($request->user_id);
        $account_type = $data->account_type;
        if($request->amount > $data->balance){
            return redirect()->back()
                ->with('error', 'Insufficient Balance');
        }

        if($account_type == "Individual"){
            $total_withdraw_this_month = transaction::whereMonth('date', Carbon::now()->month)
            ->whereYear('date', Carbon::now()->year)
            ->where('user_id',$request->user_id)
            ->where('transaction_type','withdrawal')
            ->sum('amount');

            $total_withdraw_this_month = $total_withdraw_this_month + $request->amount;

            if($request->amount > 1000){
                $today = date('N');
                if($today == 5 && $total_withdraw_this_month <= 5000){
                    $fee = 0.00;
                }else{
                    $remaining_amount = $request->amount - 1000;
                    $fee = $remaining_amount * 0.015/100;
                }
            }else{
                $fee = 0.00;
            }

            if($total_withdraw_this_month <= 5000){
                $fee = 0.00;
            }else{
                $fee = $request->amount * 0.015/100;
            }
        }else{
            $total_withdraw = transaction::where('user_id',$request->user_id)
                                            ->where('transaction_type','withdrawal')
                                            ->sum('amount');
            if($total_withdraw >50000){
                $withdrawal_rate = 0.015;
                $fee = $request->amount * $withdrawal_rate/100;
            }else{
                if($total_withdraw == 0){
                    $withdrawal_rate = 0.025;
                    $fee = $request->amount * $withdrawal_rate/100;
                }else{
                    $rem = abs($request->amount - abs(50000 - $total_withdraw));
                    $withdrawal_rate = 0.015;
                    $fee = $rem * $withdrawal_rate/100;
                    $fee = $fee + (($request->amount - $rem)* 0.025/100);
                }
                
            }
        }
        transaction::create([
            'user_id' => $request->user_id,
            'transaction_type' => 'withdrawal',
            'amount' => $request->amount,
            'fee' => $fee,
            'date' => Carbon::now()->toDateString()
        ]);
        
        $old_balance = $data->balance;
        $new_balance = $old_balance - $request->amount - $fee;
        $data->balance = $new_balance;
        $data->save();

        return redirect()->route('withdrawalList')->with('success','Withdrawal Done');
    }
}
