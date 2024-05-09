<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\TransactionRepository;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Exception;
class TransactionController extends Controller
{
    private $transactionRepository;


    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;

    }

    public function index(){
        $totalWithdrawal=Transaction::where('transaction_type','withdrawal')->sum('amount');
        $totalWithdrawalFee=Transaction::where('transaction_type','withdrawal')->sum('fee');
        $totalDeposit=Transaction::where('transaction_type','deposit')->sum('amount');
        $transaction=$deposit=$this->transactionRepository->getTransaction();
        $balance=$totalDeposit-($totalWithdrawal+$totalWithdrawalFee);
        return view('transaction.index',compact('transaction','balance'));
    }

    public function deposit(){

        $deposit=$this->transactionRepository->getDeposit();
        return view('transaction.deposit',compact('deposit'));
    }
    public function depositStore(Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric|gt:0',
        ]);
        $amount= $request->amount;

         try {
             $this->transactionRepository->deposit($request);
             return redirect()->route('deposit')->with('success', 'deposit successfully');
         } catch (Exception $e) {

              return redirect()->back()->with('error', 'deposit not successfully')->with('amount',$amount);
         }

    }
    public function withdrawal(){
        $withdrawal=$this->transactionRepository->getWithdrawal();
        return view('transaction.withdrawal',compact('withdrawal'));
    }
    public function withdrawalStore(Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric|gt:0',
        ]);
        $totalWithdrawal=Transaction::where('transaction_type','withdrawal')->sum('amount');
        $totalDeposit=Transaction::where('transaction_type','deposit')->sum('amount');
        $prevTransaction=Transaction::whereMonth('date',date('m'))->where('transaction_type','withdrawal')->sum('amount');
        $fee=0;
        if(($totalWithdrawal+$request->amount)<$totalDeposit){
            if(date('l')=="Friday" ){
                $fee=0;
            }else if($prevTransaction<=5000 && $request->amount<=1000){
                $fee=0;
            }else if(Auth::user()->account_type=='Individual'){
                $fee=($request->amount*15)/100;
            }else if(Auth::user()->account_type=='Business'){
                if($request->amount >= 50000){
                    $fee=($request->amount*15)/100;
                }else{
                    $fee=($request->amount*25)/100;
                }
            }
            try {
                $this->transactionRepository->withdrawal($request,$fee);
                return redirect()->route('withdrawal')->with('success', 'withdrawal successfully');
            } catch (Exception $e) {

                 return redirect()->back()->with('error', 'withdrawal not successfully')->with('amount',$amount);
            }
        }else{
            return redirect()->back()->with('error', 'withdrawal amount is over limit');
        }

    }

}
