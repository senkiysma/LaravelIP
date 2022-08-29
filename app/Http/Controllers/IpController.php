<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ip;

class IpController extends Controller
{

    public function index(Request $request){
        $items = Ip::get();
        view()->share('items', $items);
        return view('admin.settings.ip.index');
    }

    public function store(Request $request)
    {
        $ip = Ip::where('ip', $request->id)->first();
        if($ip)
            return back()->with('error', 'Ip already exists!');
            else{
                Ip::create($request->all());
                return back()->with('succeess', 'OK!');
            }
    }

    public function destroy(Ip $ip)
    {
        $ip->delete();
        return back()->with('success', "OK!");
    }
}
