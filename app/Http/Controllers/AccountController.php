<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $items = Account::with("user");
        if($request->get("state")){
            $items->where("state","LIKE","%".$request->get("state")."%");
        }

        if($request->get("no")){
            $items->where("no_order_6months",1);
        }else{
            $items->where("no_order_6months",0);
        }

        $items = $items->paginate(50);
        return view("admin.account.index",compact("items"));
    }

    public function listByUser(Request $request)
    {
        $items = Account::where("user_id",$request->user_id)->orderBy("checked_out","desc")->paginate(50);
        return view("admin.account.user",compact("items"));
    }
}
