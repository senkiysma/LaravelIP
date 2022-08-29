<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $items = Account::with("user");
        $items->where(function($q){
            $q->where("user_id",null)
            ->orWhere("user_id",auth()->user()->id);
        });

        if($request->get("state")){
            $items->where("state","LIKE","%".$request->get("state")."%");
        }

        if($request->get("no")){
            $items->where("no_order_6months",1);
        }else{
            $items->where("no_order_6months",0);
        }

        $items = $items->paginate(50);
        return view("member.account.index",compact("items"));
    }

    public function checkout(Request $request)
    {
        if($this->isValidCheckout()){
            $account = Account::where("id",$request->id)->first();
            $account->user_id = auth()->user()->id;
            $account->checked_out = Carbon::now();
            $account->save();
            return redirect()->to(url()->previous() . '#acc'.$account->id);
        }else{
            dd("Limited ".config("app.checkout_limit")." per day");
        }

    }

    private function isValidCheckout()
    {

        $totalToday = Account::where("user_id",auth()->user()->id)
            ->whereDate("checked_out",Carbon::today())
            ->count();
        if($totalToday>=config("app.checkout_limit")) return false;

        return true;
    }
}
