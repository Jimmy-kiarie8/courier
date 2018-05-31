<?php

namespace App\Http\Controllers;

use App\Shipment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShipments()
    {
        $results = Shipment::all();
        return json_decode(json_encode($results),true);
    }


    public function csv()
    {
        return view('csv.csv');
    }

    public function barcodeUpdate(Request $request, Shipment $shipment, $bar_code = null)
    {
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
    public function search(Request $request)
    {
        // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            // Using the Laravel Scout syntax to search the products table.
            $posts = Shipment::search($request->get('q'))->get();

            // If there are results return them, if none, return the error message.
            return $posts->count() ? $posts : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }



    public function barcodeIn(Request $request, Shipment $shipment, $bar_code_in = null)
    {
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
      if($results) {
        $barcode->derivery_status = 'Stored';
      }elseif($results2){
        $barcode->derivery_status = 'Return 1';
      }else{
        $derivery_arr = explode(' ', $derivery_status);
        $ret = $derivery_arr[0];
        $num = $derivery_arr[1];
        // var_dump($num);
        // var_dump($ret); die;
        $new_num = $num+1;
        $barcode->derivery_status = 'Return'.' '.$new_num;
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
    public function import(Request $request)
    {
        if($request->file('shipment')){
            var_dump('woooooooo');
            $path = $request->file('shipment')->getRealPath();
            $data = Excel::load($path, function($reader){

            })->get();

            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $row){
                  if(!empty($row)){
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
                      // 'created_at' => $row['created_at'],
                    ];
                  }
                }
                // var_dump($dataArray); die;
                if(!empty($dataArray)){
                 Shipment::insert($dataArray);
                 // return back();
                }else{
                    // var_dump('failed'); die;
                }
            }
            // return redirect('/')->with('success', 'Import success');
            // var_dump('success'); die;
        }/*else{
            echo "fffffffffffffffaid";
        }*/
    }

    public function export()
    {
        $model = Shipment::all();
        $results = Excel::create('Shipment', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {

                $sheet->fromModel(Shipment::all());

            });

        })->export('csv');

        if ($results) {
            echo "suceceeecec";
        }else{
            echo 'faileddddddd';
        }
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
        $shipment->insuarance_status = $request->insuarance_status;
        $shipment->booking_date = $request->booking_date;
        $shipment->derivery_date = $request->derivery_date;
        $shipment->derivery_time = $request->derivery_time;
        $shipment->bar_code = $request->bar_code;
        $shipment->sender_name = Auth::user()->name;
        $shipment->sender_email = Auth::user()->email;
        $shipment->sender_phone = Auth::user()->phone;
        $shipment->sender_address = Auth::user()->address;
        $shipment->sender_city = Auth::user()->city;
        $shipment->user_id = Auth::id();
        $shipment->shipment_id = random_int(1000000, 9999999);
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
    public function update(Request $request, Shipment $shipment)
    {
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
        $shipment->payment = $request->payment;
        $shipment->total_freight = $request->total_freight;
        $shipment->insuarance_status = $request->insuarance_status;
        $shipment->booking_date = $request->booking_date;
        $shipment->derivery_date = $request->derivery_date;
        $shipment->derivery_time = $request->derivery_time;
        $shipment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        Shipment::find($shipment->id)->delete();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Shipment $shipment, $id)
    {
        $coordinates = serialize($request->address);
        $latitude = $request->address['latitude'];
        $longitude = $request->address['longitude'];
        // var_dump($coordinates); 
        // var_dump($request->address['longitude']); 
        // var_dump($coordinates->latitude); 
        // var_dump($coordinates['longitude']); 
        // var_dump($coordinates['longitude']); 
        $coords = array('lat' => $latitude, 'lng' => $longitude);

        $shipment = Shipment::find($id);
        $shipment->status = $request->status;
        $shipment->coordinates = $coordinates;
        $shipment->remark = $request->remark;
        $shipment->save();
        return $coords;
    }


    public function getcoordinatesArray($id)
    {
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
    public function delayedShipment()
    {
      return Shipment::where('status', 'delayed')->get();
    }

    public function approvedShipment()
    {
      return Shipment::where('status', 'approved')->get();
    }

    public function waitingShipment()
    {
      return Shipment::where('status', 'waiting approval')->get();
    }

    public function deriveredShipment()
    {
      return Shipment::where('status', 'derivered')->get();
    }

    // Chart
    public function getChartData()
    {
      /*$shipment = Shipment::select('booking_date', 'id')->get();
      return json_decode(json_encode($shipment), true);
      // $flatten = array_flatten($shipmentArray);
      $retrive = array_except($shipmentArray, [
        'airway_bill_no', 'amount_ordered', 'assign_staff', 'bar_code',
        'booking_date', 'client_address', 'client_city', 'client_email',
        'client_name', 'client_phone', 'client_postal_code', 'client_region',
        'container', 'coordinates',
        'sender_name',
        'sender_phone',
        'sender_email',
        'sender_address',
        'sender_city',
        'shipment_type',
        'payment',
        'total_freight',
        'insuarance_status',
        'derivery_date',
        'derivery_time',
      ]);*/
      // var_dump($flatten);
     /* foreach ($shipmentArray as $value) {
        $slice = array_only($value, ['created_at', 'id']);
      var_dump($slice);

      // var_dump($slice); 
        $sliceArray = array('date' => $slice['created_at'], 'id' => $slice['id']);
      }
      return $sliceArray;*/
      $shipments = DB::table('shipments')
                     ->select(DB::raw('count(id) as count, booking_date as date'))
                     ->orderBy('created_at', 'desc')
                     ->groupBy('date')
                     ->get();
    
    // $lables = [];
    $rows = [];
    foreach ($shipments as $shipment) {
      $rows[] = [$shipment->date .': '. $shipment->count];
      // $lables[] = $shipment->count;
    }
    return json_decode(json_encode($rows), false);
    // $data = [
    //   'lables' => $lables, 
    //   'rows' => $rows, 
    // ];
    // return $rows;
    // var_dump($rows); die;
}

}
