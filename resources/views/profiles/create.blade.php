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
                                                <option value="provider">Provider</option>
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
