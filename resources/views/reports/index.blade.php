@extends('layouts.app')

@section('content')
<my-header></my-header>
<v-content>
 <v-container fluid fill-height>
  <v-layout justify-center align-center>
   <v-layout row wrap>
    <v-flex xs12 sm8>
       <v-layout row wrap>
           <v-flex xs4 sm3>
            <v-card>
              <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
              <v-card-title primary-title>
                  <div>
                   <p>Shipments.xls</p>                     
                   <small></small>                     
               </div>
           </v-card-title>
           <v-card-actions>
            <form action="{{ route("shipmentExpo") }}" method="post">
                {{csrf_field()}}
                <v-btn flat type="submit" color="blue">Export</v-btn>
            </form>
        </v-card-actions>
    </v-card>
</v-flex>


<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Bookings.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("bookingExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>


<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Approved.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("approvedExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>


<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Pending.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("pendingExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>

<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Cancelled.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("cancledExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>

<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Customers.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("customersExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>

<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Global Rates.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("ratesExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>

<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Users.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("userExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>

<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Branches.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("branchesExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>

<v-flex xs4 sm3>
    <v-card>
      <img id="doc" src="/storage/profile/doc.png" alt="Docs" class="img-responsive text-center" style="width: 100%; height:150px;">               
      <v-card-title primary-title>
          <div>
           <p>Agents.xls</p>                     
           <small></small>                     
       </div>
   </v-card-title>
   <v-card-actions>
    <form action="{{ route("agentsExpo") }}" method="post">
        {{csrf_field()}}
        <v-btn flat type="submit" color="blue">Export</v-btn>
    </form>
</v-card-actions>
</v-card>
</v-flex>
</v-layout>
</v-flex>
<v-flex xs12 sm3 offset-sm1>
<v-card>
<form action="{{ route("userDateExpo") }}" method="post">
    {{ csrf_field() }}
    <select class="custom-select custom-select-sm col-md-12 col-md-12" name="name">
        @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->client_name}}</option>
        @endforeach
    </select>
    Between <hr>
    <v-flex xs10 sm9  offset-sm1>
        <v-text-field
        name="start_date"
        type="date"
        color="blue darken-2"
        required
        ></v-text-field>
      </v-flex>
    <v-flex xs10 sm9  offset-sm1>
        <v-text-field
        name="end_date"
        type="date"
        color="blue darken-2"
        required
        ></v-text-field>
      </v-flex>
    <v-btn flat type="submit" success color="black">Download</v-btn>
    {{-- <div class="input-group col-md-12">
        <label for="">Start Date:</label>
        <input type="date" name="start_date" class="input-control">
    </div>
    <div class="input-group col-md-12">
        <label for="">End Date:</label>
        <input type="date" name="end_date" class="input-control">
    </div> --}}
</form>
</v-card>
</v-flex>
</v-layout>
</v-layout>
</v-container>
</v-content>
@endsection
