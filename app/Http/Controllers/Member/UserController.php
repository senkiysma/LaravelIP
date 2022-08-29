<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->has("from"))
            $from = Carbon::parse($request->from)->toDateString();
        else
            $from = Carbon::now()->startOfMonth()->toDateString();

        if($request->has("to"))
            $to = Carbon::parse($request->to)->toDateString();
        else
            $to = Carbon::now()->endOfMonth()->toDateString();

        $items = Account::where("user_id",Auth::user()->id)
            ->where("checked_out",">=",$from)
            ->where("checked_out","<=",$to)
            ->select(DB::raw('DATE(checked_out) as date'),DB::raw('count(*) as gets'))
            ->groupBy("date")
            ->orderBy("date","desc")
            ->get();

        return view("member.user.index", compact('items','from','to'));
    }
}
