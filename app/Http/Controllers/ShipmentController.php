<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequest;
use App\Shipment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getShipments() {
		$results = Shipment::where('company_id', Auth::user()->company_id)->get();
		return json_decode(json_encode($results), true);
	}

	public function csv() {
		return view('csv.csv');
	}

	public function barcodeUpdate(Request $request, Shipment $shipment, $bar_code = null) {
		// return $request->all();
		$barcode = Shipment::find($request->bar_code);
		$barcode->derivery_status = 'dispatched';
		$barcode->payment = 'yes';
		$barcode->save();
	}

	/**
	 * Search the products table.
	 *
	 * @param  Request $request
	 * @return mixed
	 */
	public function search(Request $request) {
		// First we define the error message we are going to show if no keywords
		// existed or if no results found.
		$error = ['error' => 'No results found, please try with different keywords.'];

		// Making sure the user entered a keyword.
		if ($request->has('q')) {

			// Using the Laravel Scout syntax to search the products table.
			$posts = Shipment::search($request->get('q'))->get();

			// If there are results return them, if none, return the error message.
			return $posts->count() ? $posts : $error;

		}

		// Return the error message if no keywords existed
		return $error;
	}

	public function barcodeIn(Request $request, Shipment $shipment, $bar_code_in = null) {
		$results = Shipment::whereNull('derivery_status')
			->where('derivery_status', '!=', 'derivered')
			->where('bar_code', $request->bar_code)->get();
		$results2 = Shipment::where('derivery_status', 'store')
			->where('derivery_status', '!=', 'derivered')
			->where('bar_code', $request->bar_code)->get();
		$derivery_status = Shipment::where('derivery_status', '==', 'dispatched')
			->where('bar_code', $request->bar_code)->get();

		// var_dump($results);
		// var_dump($results2); die;
		$barcode = Shipment::find($request->bar_code_in);
		if ($results) {
			$barcode->derivery_status = 'Stored';
		} elseif ($results2) {
			$barcode->derivery_status = 'Return 1';
		} else {
			$derivery_arr = explode(' ', $derivery_status);
			$ret = $derivery_arr[0];
			$num = $derivery_arr[1];
			$new_num = $num + 1;
			$barcode->derivery_status = 'Return' . ' ' . $new_num;
		}
		// return $request->all();
		$barcode->save();
	}

	/**
	 * import a file in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function import(Request $request) {
		if ($request->file('shipment')) {
			// var_dump('woooooooo');
			$path = $request->file('shipment')->getRealPath();
			$data = Excel::load($path, function ($reader) {

			})->get();

			if (!empty($data) && $data->count()) {
				foreach ($data->toArray() as $row) {
					if (!empty($row)) {
						$dataArray[] =
							[
							'client_name' => $row['name'],
							'client_email' => $row['email'],
							'client_phone' => $row['phone'],
							'client_address' => $row['address'],
							'client_city' => $row['city'],
							'amount_ordered' => $row['quantity'],
							'client_postal_code' => $row['postal_code'],
							'client_region' => $row['region'],
							'booking_date' => $row['booking_date'],
							'user_id' => Auth::id(),
							'created_at' => new DateTime(),
							'updated_at' => new DateTime(),
							'shipment_id' => random_int(1000000, 9999999),
							'sender_name' => Auth::user()->name,
							'sender_email' => Auth::user()->email,
							'sender_phone' => Auth::user()->phone,
							'sender_address' => Auth::user()->address,
							'sender_city' => Auth::user()->city,
							'user_id' => Auth::id(),
						];
					}
				}
				if (!empty($dataArray)) {
					Shipment::insert($dataArray);
				}
			}
		}
	}

	public function export() {
		$model = Shipment::where('company_id', Auth::user()->company_id)->get();
		$results = Excel::create('Shipment', function ($excel) {

			$excel->sheet('Sheetname', function ($sheet) {

				$sheet->fromModel(Shipment::all());

			});

		})->export('csv');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ShipmentRequest $request) {
		// return $request->all();
		$shipment = new Shipment;
		$shipment->client_name = $request->client_name;
		$shipment->client_phone = $request->client_phone;
		$shipment->client_email = $request->client_email;
		$shipment->client_address = $request->client_address;
		$shipment->client_city = $request->client_city;
		$shipment->assign_staff = $request->assign_staff;
		$shipment->airway_bill_no = $request->airway_bill_no;
		$shipment->shipment_type = $request->shipment_type;
		$shipment->payment = $request->payment;
		$shipment->total_freight = $request->total_freight;
		// $shipment->total = $request->total;
		$shipment->insuarance_status = $request->insuarance_status;
		$shipment->booking_date = $request->booking_date;
		$shipment->derivery_date = $request->derivery_date;
		$shipment->derivery_time = $request->derivery_time;
		$shipment->bar_code = $request->bar_code;
		$shipment->customer_id = $request->customer_id;
		// return $request->customer_id;
		$shipment->sender_name = Auth::user()->name;
		$shipment->sender_email = Auth::user()->email;
		$shipment->sender_phone = Auth::user()->phone;
		$shipment->sender_address = Auth::user()->address;
		$shipment->sender_city = Auth::user()->city;
		$shipment->user_id = Auth::id();
		$shipment->shipment_id = random_int(1000000, 9999999);
		$shipment->company_id = Auth::user()->company_id;
		$shipment->save();
		return $shipment;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Shipment  $shipment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Shipment $shipment) {
		// return $request->all();
		$shipment = Shipment::find($request->id);
		$shipment->client_name = $request->client_name;
		$shipment->client_phone = $request->client_phone;
		$shipment->client_email = $request->client_email;
		$shipment->client_address = $request->client_address;
		$shipment->client_city = $request->client_city;
		$shipment->assign_staff = $request->assign_staff;
		$shipment->airway_bill_no = $request->airway_bill_no;
		$shipment->shipment_type = $request->shipment_type;
		$shipment->customer_id = $request->customer_id;
		$shipment->payment = $request->payment;
		
		$shipment->total_freight = $request->total_freight;
		$shipment->insuarance_status = $request->insuarance_status;
		$shipment->booking_date = $request->booking_date;
		$shipment->derivery_date = $request->derivery_date;
		$shipment->derivery_time = $request->derivery_time;
		$shipment->save();
		return $shipment;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Shipment  $shipment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Shipment $shipment) {
		Shipment::find($shipment->id)->delete();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Shipment  $shipment
	 * @return \Illuminate\Http\Response
	 */
	public function updateStatus(Request $request, Shipment $shipment, $id) {
		$shipment = Shipment::find($request->id);
		if ($request->address) {
			$coordinates = serialize($request->address);
			$latitude = $request->address['latitude'];
			$longitude = $request->address['longitude'];
			$coords = array('lat' => $latitude, 'lng' => $longitude);
			$shipment->coordinates = $coordinates;
			$shipment->longitude = $longitude;
			$shipment->latitude = $latitude;
		}
		$shipment->status = $request->formobg['status'];
		// var_dump($request->formobg['status']); die;
		$shipment->remark = $request->formobg['remark'];
		$shipment->save();
		return $shipment;
	}

	public function getcoordinatesArray($id) {
		$record = Shipment::find($id);
		if ($record) {
			// var_dump('pass');
			$coordinates = unserialize($record->coordinates);
			$arraySt = json_decode(json_encode($coordinates), true);
			$latitude = $arraySt['latitude'];
			$longitude = $arraySt['longitude'];
			return array('lat' => $latitude, 'lng' => $longitude);
		} else {
			// var_dump('fail');
			// $latitude = '-1.2808685';
			// $longitude = '36.73657560000004';
			return array('lat' => '-1.2808685', 'lng' => '36.73657560000004');
		}

	}

	// Dashboard
	public function delayedShipment() {
		return Shipment::where('status', 'delayed')->where('company_id', Auth::user()->company_id)->get();
	}

	public function approvedShipment() {
		return Shipment::where('status', 'approved')->where('company_id', Auth::user()->company_id)->get();
	}

	public function waitingShipment() {
		return Shipment::where('status', 'waiting approval')->where('company_id', Auth::user()->company_id)->get();
	}

	public function deriveredShipment() {
		return Shipment::where('status', 'derivered')->where('company_id', Auth::user()->company_id)->get();
	}

	// Chart
	public function getChartData() {
		$shipments = DB::table('products')
			->select(DB::raw('count(id) as count, date_format(created_at, "%M %d") as date'))
			->orderBy('created_at', 'desc')
			->groupBy('date')
			->where('company_id', Auth::user()->company_id)
			->get();

		$lables = [];
		$rows = [];
		foreach ($shipments as $shipment) {
			$lables[] = $shipment->date;
			$rows[] = $shipment->count;
		}
		$data = [
			'lables' => $lables,
			'rows' => $rows,
		];
		return $data;
	}

}
