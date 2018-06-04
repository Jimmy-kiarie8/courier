<?php

namespace App\Http\Controllers;

use App\Shipment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller {
	public function index() {
		$clients = shipment::where('company_id', Auth::user()->company_id)->get();
		return view('reports.index')->with('clients', $clients);
	}

	public function userDateExpo(Request $request) {
		$date_array = array(
			'start_date' => $request->start_date,
			'end_date' => $request->end_date,
		);
		$client_id = $request->name;
		$results = Excel::create('Shipment', function ($excel) use ($date_array, $client_id) {
			// var_dump($date_array); die;
			// var_dump($client_id); die;

			$excel->sheet('Sheetname', function ($sheet) use ($date_array, $client_id) {
				$sheet->fromModel(Shipment::whereBetween('created_at', [$date_array])->where('id', $client_id)->get());
			});

		})->download('xls');

		if ($results) {
			echo "success";
		} else {
			echo 'failed';
		}
		// return;
		die;
	}
	public function shipmentExpo(Request $request) {
		// var_dump($request->id); die;
		$results = Excel::create('Shipment', function ($excel) {

			$excel->sheet('Sheetname', function ($sheet) {
				// $model =
				$sheet->fromModel(Shipment::where('id', '1')->get());

			});

		})->download('xls');

		if ($results) {
			echo "success";
		} else {
			echo 'failed';
		}
		// return;
		die;
	}
	public function userExpo() {
		$results = Excel::create('Users', function ($excel) {

			$excel->sheet('Sheetname', function ($sheet) {

				$sheet->fromModel(User::all());

			});

		})->export('xls');

		if ($results) {
			echo "success";
		} else {
			echo 'Failed';
		}
		// return;
	}
	public function ratesExpo() {
		/*$results = Excel::create('Users', function($excel) {

			        $excel->sheet('Sheetname', function($sheet) {

			            $sheet->fromModel(User::all());

			        });

			    })->export('xls');

			    if ($results) {
			        echo "success";
			    }else{
			        echo 'Failed';
			    }
		*/
	}
	public function customersExpo() {
		$results = Excel::create('Users', function ($excel) {

			$excel->sheet('Sheetname', function ($sheet) {

				$sheet->fromModel(User::where('type', 'customer')->get());

			});

		})->export('xls');

		if ($results) {
			echo "success";
		} else {
			echo 'Failed';
		}
	}
	public function branchesExpo() {

	}
	public function agentsExpo() {

	}
	public function cancledExpo() {

	}
	public function pendingExpo() {
		$results = Excel::create('Users', function ($excel) {

			$excel->sheet('Sheetname', function ($sheet) {

				$sheet->fromModel(Shipment::where('status', 'pending')->get());

			});

		})->export('xls');

		if ($results) {
			echo "success";
		} else {
			echo 'Failed';
		}
	}
	public function bookingExpo() {

	}
	public function approvedExpo() {
		$results = Excel::create('Approved Shipments', function ($excel) {

			$excel->sheet('Sheetname', function ($sheet) {

				$sheet->fromModel(Shipment::where('status', 'approved')->get());

			});

		})->export('xls');

		/*if ($results) {
				echo "success";
			} else {
				echo 'Failed';
		*/
	}
}
