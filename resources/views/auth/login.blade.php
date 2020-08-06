@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center"  >
                <div class="card-body">
                  <h4 class="card-title mb-5">Login</h4>
                   <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-4 @error('email') has-danger @enderror">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="now-ui-icons users_single-02"></i>
                            </div>
                          </div>
                          <input type="email" class="form-control @error('email') form-control-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                           @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-4 @error('password') has-danger @enderror">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                          </div>
                          <input type="password" class="form-control @error('password') form-control-danger @enderror" name="password" required autocomplete="current-password" placeholder="Your password">
                           @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-4">
                           <label class="form-check-label">
                               <input class="form-check-input" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
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
