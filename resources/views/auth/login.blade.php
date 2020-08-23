@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Login</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group mb-4">
                                <div class="input-group @error('telephone') has-danger @enderror">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="tel" class="form-control @error('telephone') form-control-danger @enderror"
                                        name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone"
                                        autofocus placeholder="Eg. +233553884561">
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
                                        name="password" required autocomplete="current-password"
                                        placeholder="Your password">
                                </div>
                                @error('password')
                                <small class="form-text text-muted text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    Remember Me
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-round btn-block mb-4">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link mb-4" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
