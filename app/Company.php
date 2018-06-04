<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
	protected $fillable = [
		'location', 'company_name', 'email', 'address',
		'phone', 'branches', 'admin', 'user_id',
	];
}
