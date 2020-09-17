@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Register</h4>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row form-group mb-4">
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option value="+233" selected>+233</option>
                                    </select>
                                </div>
                                <div class="col-md-8 input-group @error('telephone') has-danger @enderror">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="tel" class="form-control @error('telephone') form-control-danger @enderror"
                                        name="telephone" value="{{ old('telephone') }}" required autocomplete="tel"
                                        autofocus placeholder="Eg. 553884561" maxlength="9">
                                </div>
                                @error('telephone')
                                <small class="form-text text-muted text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-4 @error('password') has-danger @enderror">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="password"
                                        class="form-control @error('password') form-control-danger @enderror"
                                        name="password" required autocomplete="new-password" placeholder="Your password">
                                </div>
                                @error('password')
                                <small class="form-text text-muted text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-round btn-block mb-4">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
