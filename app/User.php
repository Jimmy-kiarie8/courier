<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/*public function roles() {
		// return $this->belongsToMany('App\Role');
		return $this->belongsToMany(App\Role::class, 'role_users');
	}*/

	/**
	 * The roles that belong to the user.
	 */
	public function roles() {
		return $this->belongsToMany('App\Role');
	}

}
