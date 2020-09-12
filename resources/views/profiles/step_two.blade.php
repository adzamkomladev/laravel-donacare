@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body px-4">
                        <h4 class="card-title mb-5">Medical profile</h4>
                        <form method="POST" action="{{ route('profiles.store_step_two') }}">
                            @csrf
                            @if ($stepOne['role'] === 'donor')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <div class="input-group @error('email') has-danger @enderror">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') form-control-danger @enderror"
                                                    name="email" value="{{ old('email') }}" autofocus
                                                    placeholder="Your email address">
                                            </div>
                                            @error('email')
                                            <small class="form-text text-muted text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="home-address">Home address</label>
                                            <div class="input-group @error('home_address') has-danger @enderror">
                                                <input id="home-address" type="home_address"
                                                    class="form-control @error('home_address') form-control-danger @enderror"
                                                    name="home_address" value="{{ old('home_address') }}" autofocus
                                                    placeholder="Your home address">
                                            </div>
                                            @error('home_address')
                                            <small class="form-text text-muted text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="mobile-money_name">Mobile number name</label>
                                            <div class="input-group @error('mobile_money_name') has-danger @enderror">
                                                <input id="mobile-money_name" type="text"
                                                    class="form-control @error('mobile_money_name') form-control-danger @enderror"
                                                    name="mobile_money_name" value="{{ old('mobile_money_name') }}" required
                                                    autofocus placeholder="Your mobile money name">
                                            </div>
                                            @error('mobile_money_name')
                                            <small class="form-text text-muted text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="mobile-money-number">Mobile money number</label>
                                            <div class="input-group @error('mobile_money_number') has-danger @enderror">
                                                <input id="mobile-money-number" type="text"
                                                    class="form-control @error('mobile_money_number') form-control-danger @enderror"
                                                    name="mobile_money_number" value="{{ old('mobile_money_number') }}"
                                                    required autofocus placeholder="Eg. +233553884561">
                                            </div>
                                            @error('mobile_money_number')
                                            <small class="form-text text-muted text-danger">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="medical-details">Meical details</label>
                                        <div class="input-group @error('medical_details') has-danger @enderror">
                                            <textarea rows="4" cols="80" id="medical-details"
                                                class="form-control @error('medical_details') form-control-danger @enderror"
                                                name="medical_details" value="{{ old('medical_details') }}" autofocus
                                                placeholder="Your medical details"></textarea>
                                        </div>

                                        @error('medical_details')
                                        <small class="form-text text-muted text-danger">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-round mb-3">
                                Create profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
