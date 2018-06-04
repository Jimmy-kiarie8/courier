<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// return $request->all();
		$company = new Company;
		if ($request->location) {
			$location = serialize($request->location);
			// Location
			$loc = $request->location;
			$longitude = $loc['longitude'];
			$latitude = $loc['latitude'];
			$country = $loc['country'];

			if (in_array('administrative_area_level_1', $loc)) {
				$locality = $loc['administrative_area_level_1'];
			} elseif (in_array('locality', $loc)) {
				$locality = $loc['locality'];
			} else {
				$locality = '';
			}

			// $locality = $loc['administrative_area_level_1'];
			// return $locality;
			// $route = $loc['route'];
			// $street_number = $loc['street_number'];

			$company->longitude = $longitude;
			$company->latitude = $latitude;
			$company->country = $country;
			$company->locality = $locality;
			$company->location = $location;
		}
		// $company->route = $route;
		// $company->street_number = $street_number;
		// Location
		$company->company_name = $request->data['company_name'];
		$company->email = $request->data['email'];
		$company->phone = $request->data['phone'];
		$company->address = $request->data['address'];
		// return $request->data['admin'];

		// foreach ($admin as $value) {
		// 	$admin_id = $value['id'];
		// }
		// return $admin_id;

		$company->user_id = Auth::id();
		// $company->admin = $request->data['admin'];
		$company->save();
		return $company;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Company $company) {
		// return $request->all();
		$company = Company::find($request->id);
		// return $company;
		// return $request->data['company_name'];
		// Location
		if ($request->location) {
			$location = serialize($request->location);
			$loc = $request->location;
			$longitude = $loc['longitude'];
			$latitude = $loc['latitude'];
			$country = $loc['country'];

			if (in_array('administrative_area_level_1', $loc)) {
				$locality = $loc['administrative_area_level_1'];
			} elseif (in_array('locality', $loc)) {
				$locality = $loc['locality'];
			} else {
				$locality = '';
			}
			$company->longitude = $longitude;
			$company->latitude = $latitude;
			$company->country = $country;
			$company->locality = $locality;
			$company->location = $location;
		}
		// Location
		$company->company_name = $request->data['company_name'];
		$company->email = $request->data['email'];
		$company->phone = $request->data['phone'];
		$company->admin = $request->data['admin'];
		// return $request->data['admin'];
		$company->address = $request->data['address'];
		// $company->admin = $request->data['admin'];
		// $company->save();
		return $company;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Company  $company
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Company $company) {
		//
	}

	public function getCompanies() {
		return json_decode(json_encode(Company::all()), true);
	}
	public function getCompanyAdmin() {
		$userRoles = User::with(['roles'])->get();
		$user = [];
		$IdArr = [];
		foreach ($userRoles as $value) {
			foreach ($value->roles as $element) {
				$role_name = $element->name;
				$role_id = $element->id;
				if ($role_name == 'companyAdmin') {
					$user[] = $value;
				}
			}
		}
		return $user;
	}
}
