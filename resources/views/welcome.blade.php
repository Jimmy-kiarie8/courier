@extends('layouts.app')

@section('title')
Courier
@endsection

@section('content')
<my-header :user="{{ Auth::user() }}" :role="{{ json_encode($rolename) }}" :logo="{{ json_encode($company_logo)}}"></my-header>
<transition name="fade">
<router-view :user="{{ Auth::user() }}" :role="{{ json_encode($rolename) }}"></router-view>
</transition>
@endsection