@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="socialite">
                    <v-card flat tile class="flex">
                        <v-card-title class="grey lighten-2">
                           <strong class="subheading">Login with!</strong>
                           <v-spacer></v-spacer>
                           <a href="/login/facebook">
                            <v-btn
                            icon
                            dark
                            class="mx-3"
                            >
                            <v-icon size="24px">fa fa-facebook</v-icon>
                            </v-btn>
                            </a>
                            <a href="/login/google">
                                <v-btn
                                    icon
                                    dark
                                    class="mx-3"
                                    >
                                <v-icon size="24px">fa fa-google</v-icon>
                                </v-btn>
                            </a>
                        </v-card-title>
                    </v-card>
                </div>
                {{-- <div class="card-header" id="socialite">
                    {{ __('Login') }}
                    <div class="text-right">
                        <a href="/login/facebook">Login with: <v-icon size="18px" class="mr-3">fab fa-facebook</v-icon></a>
                    </div>
                </div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select" name="company_id">
                                  <option value="0" selected>Select Company</option>
                                  @foreach ($company as $element)
                                      <option data-subtext="" value="{{ $element->id }}">{{$element->company_name}}</option>
                                  @endforeach
                                </select>

                                @if ($errors->has('company'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
