@extends('layouts.app')

@section('title')
Courier
@endsection

@section('content')
{{-- <transition name="fade"> --}}
<my-header></my-header>
{{-- <router-view :user="{{ Auth::user() }}"}}"></router-view> --}}
{{-- <router-view :user="{{ Auth::user() }}" :rolename="{{ json_encode($rolename) }}"></router-view> --}}
<router-view :user="{{ Auth::user() }}"></router-view>
{{-- </transition> --}}
@endsection