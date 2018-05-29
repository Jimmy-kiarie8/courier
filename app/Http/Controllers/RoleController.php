<?php

namespace App\Http\Controllers;

use App\Role_user;
use App\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getUsersRole()
    {
        $user_arr = json_decode(json_encode( User::all()), true);
        return $user_arr;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role_user $role_user, $id)
    {
        // return $request->all();
        $user_id = $id;
        $role_id = $request->role;
        // var_dump($id); die;
        // var_dump($role_id); die;
        /*$role = Role_user::updateOrCreate(
            ['role_id' => $role_id],
            ['user_id' => $id]
        );*/
        $role = Role_user::updateOrCreate(
                ['user_id' => $user_id],
                ['user_id' => $user_id, 'role_id' => $role_id]
            );
        // $role = Role_user::firstOrCreate(['user_id' => $user_id, 'role_id' => $role_id]);
        // var_dump($id); die;
        return $role;
        /*$role = Role::find($request->id);
        $role->user_id = $request->id;
        $role->role_id = $request->role;
        $role->save();
        return $role;*/
    }
}
