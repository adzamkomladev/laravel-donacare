@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body px-4">
                        <h4 class="card-title mb-5">Medical profile</h4>
                        <form method="POST" action="{{ route('profiles.store-step-two') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="role">Purpose</label>
                                        <div class="input-group @error('role') has-danger @enderror">
                                            <select id="role"
                                                class="form-control @error('role') form-control-danger @enderror"
                                                name="role" required>
                                                <option value="patient">Patient</option>
                                                <option value="donor">Donor</option>
                                            </select>
                                        </div>
                                        @error('role')
                                        <small class="form-text text-muted text-danger">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="blood_group">Blood group</label>
                                        <div class="input-group @error('blood_group') has-danger @enderror">
                                            <select id="blood_group"
                                                class="form-control @error('blood_group') form-control-danger @enderror"
                                                name="blood_group" required>
                                                <option value="O+" selected>O positive</option>
                                                <option value="O-">O negative</option>
                                                <option value="A+">A positive</option>
                                                <option value="A-">A negative</option>
                                                <option value="B+">B positive</option>
                                                <option value="B-">B negative</option>
                                                <option value="AB+">AB positive</option>
                                                <option value="AB-">AB negative</option>
                                            </select>
                                        </div>
                                        @error('blood_group')
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
                                                name="mobile_money_number" value="{{ old('mobile_money_number') }}" required
                                                autofocus placeholder="Eg. +233553884561">
                                        </div>
                                        @error('mobile_money_number')
                                        <small class="form-text text-muted text-danger">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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
