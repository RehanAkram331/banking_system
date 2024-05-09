<?php

namespace App\Repositories\Backend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionInterface
{
    public function deposit(Request $request)
    {
        $deposit = new Transaction();
        $deposit->user_id=Auth::id();
        $deposit->transaction_type="deposit";
        $deposit->amount =(Double)$request->amount;
        $deposit->fee=0;
        $deposit->date=date('Y-m-d');
        $deposit->save();
        return $deposit;
    }

    public function withdrawal($request,$fee)
    {
        $withdrawal = new Transaction();
        $withdrawal->user_id=Auth::id();
        $withdrawal->transaction_type="withdrawal";
        $withdrawal->amount =(Double)$request->amount;
        $withdrawal->fee=$fee;
        $withdrawal->date=date('Y-m-d');
        $withdrawal->save();

        return $withdrawal;
    }


    public function getDeposit(){

         return Transaction::where('user_id',Auth::id())->where('transaction_type','deposit')->get(['amount','date']);
    }

    public function getWithdrawal(){

        return Transaction::where('user_id',Auth::id())->where('transaction_type','withdrawal')->get(['amount','fee','date']);
    }

    public function getTransaction(){

        return Transaction::where('user_id',Auth::id())->get(['transaction_type','amount','fee','date']);
    }



}
