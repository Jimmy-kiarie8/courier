@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{route("import")}}" method="post" enctype="multipart/form-data">
                       {{csrf_field()}}
                      <div class="form-group">
                          <input type="file" name="shipment" class="btn btn-default"/>
                      </div><br>
                      <div class="form-group">
                          <button class="btn btn-primary" type="submit">Import</button>
                          {{-- or <a class="btn btn-default" href="http://manage.dev/manage#/admin/">Enter member details</a> --}}
                      </div>
                    </form>
                    <form action="{{ route('export') }}" method="post">
                        {{csrf_field()}}
                        {{-- <input type="file" name="shipment" id=""> --}}
                        <input type="submit" value="Export" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
