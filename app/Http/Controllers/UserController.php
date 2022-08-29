<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::get();
        return view("admin.user.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "test";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword (Request $request)
    {
        $user = Auth::user();
        $data['old_pass'] = $request->old_pass;
        $data['new_pass'] = $request->new_pass;
        $data['new_pass2'] = $request->new_pass2;

        if($data["new_pass"]!=$data["new_pass2"]) die(" not same pass - click back to update");

        //if(Hash::check($data['old_pass'],$user->password)) die("old pass not correct");

        $user->password = Hash::make($data['new_pass']);
        $user->save();
        Session::flush();
        Auth::logout();
        die("update successed, please relog");
    }

    public function changePassword(Request $request)
    {
        return view("auth.passwords.change");
    }

    public function delete(Request $request)
    {
        User::destroy($request->id);

        return redirect()->back();
    }
}
