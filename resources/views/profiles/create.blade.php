@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body px-4">
                        <h4 class="card-title mb-5">Create profile</h4>
                        <form method="POST" action="{{ route('profiles.store') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="first-name">First name</label>
                                        <div class="input-group @error('first_name') has-danger @enderror">
                                            <input id="first-name" type="text"
                                                class="form-control @error('first_name') form-control-danger @enderror"
                                                name="first_name" value="{{ old('first_name') }}" required
                                                autocomplete="given-name" autofocus placeholder="Your first name">
                                        </div>
                                        @error('first_name')
                                        <small class="form-text text-muted text-danger">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="last-name">Last name</label>
                                        <div class="input-group @error('last_name') has-danger @enderror">
                                            <input id="last-name" type="text"
                                                class="form-control @error('last_name') form-control-danger @enderror"
                                                name="last_name" value="{{ old('last_name') }}" required
                                                autocomplete="family-name" autofocus placeholder="Your last name">
                                        </div>
                                        @error('last_name')
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
                                        <label for="other-names">Other names</label>
                                        <div class="input-group @error('other_names') has-danger @enderror">
                                            <input id="other-names" type="text"
                                                class="form-control @error('other_names') form-control-danger @enderror"
                                                name="other_names" value="{{ old('other_names') }}"
                                                autocomplete="additional-name" autofocus placeholder="Your other names">
                                        </div>
                                        @error('other_names')
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
                                        <label for="role">Purpose</label>
                                        <div class="input-group @error('role') has-danger @enderror">
                                            <select id="role"
                                                class="form-control @error('role') form-control-danger @enderror"
                                                name="role" required>
                                                <option value="patient">Patient</option>
                                                <option value="provider">Donor</option>
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
                                        <label>Gender</label>
                                        <br>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" checked> Male
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="female"> Female
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
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
                                                autofocus placeholder="Your mobile money number">
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
                                                autofocus placeholder="Mobile money number">
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
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Emai address</label>
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
                                        <label for="blood-group">Blood group</label>
                                        <div class="input-group @error('blood_group') has-danger @enderror">
                                            <input id="blood-group" type="text"
                                                class="form-control @error('blood_group') form-control-danger @enderror"
                                                name="blood_group" value="{{ old('blood_group') }}" required autofocus
                                                placeholder="Your blood group">
                                        </div>
                                        @error('blood_group')
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
