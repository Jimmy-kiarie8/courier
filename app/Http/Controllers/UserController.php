<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        return User::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // var_dump($request->form); die;
        $user = new User;
        $password = Hash::make($request->password);
        $user->name = $request->name;
        $user->password = $password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->zipcode= $request->zipcode;
        $user->branch = $request->branch;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->save();
        return $user;;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // return $request->all();
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->zipcode= $request->zipcode;
        $user->branch = $request->branch;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::find($user->id)->delete();
    }

    public function getLogedinUsers()
    {
        return Auth::user();
    }

    public function profile(Request $request, User $user, $id)
    {
        // return $request->all;
        $upload = User::find($request->id);
        if ($request->hasFile('image')) {
            $imagename = time().$request->image->getClientOriginalName();
            $request->image->storeAs('public/profile', $imagename);
            // return response();
        }
        $image_name = '/storage/profile/'.$imagename;
        $upload->profile = $image_name;
        $upload->save();
    }
}
