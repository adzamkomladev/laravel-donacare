@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center"  >
                <div class="card-body">
                  <h4 class="card-title mb-5">Verify One-Time Pin</h4>
                   <form method="POST" action="{{ route('verify-otp') }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <div class="input-group mb-4 @error('otp') has-danger @enderror">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                              </div>
                              <input type="text" class="form-control @error('otp') form-control-danger @enderror" name="otp" required autocomplete="one-time-code" placeholder="Enter your verification code">
                            </div>
                            @error('otp')
                                <small class="form-text text-muted text-danger">
                                   <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-round btn-block mb-4">
                            Verify
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
