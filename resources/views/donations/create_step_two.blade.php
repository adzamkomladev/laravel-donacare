@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Step 2</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('donations.store.step-two') }}">
                        @csrf

                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <div class="input-group @error('description') has-danger @enderror">
                                        <textarea id="description" rows="4" cols="80" name="description"
                                            class="form-control @error('description') form-control-danger @enderror"
                                            placeholder="Your request description" required autofocus></textarea>

                                    </div>
                                    @error('description')
                                    <small class="form-text text-muted text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="cost">Cost (GHC)</label>
                                    <div class="input-group @error('cost') has-danger @enderror">
                                        <input id="cost" type="text"
                                            class="form-control @error('cost') form-control-danger @enderror" name="cost"
                                            value="{{ $step_one['service_price'] }}" autofocus
                                            placeholder="Enter the cost of request">
                                    </div>
                                    @error('cost')
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
                                    <label for="doctor-name">Doctor name</label>
                                    <div class="input-group @error('doctor_name') has-danger @enderror">
                                        <input id="doctor-name" type="text"
                                            class="form-control @error('doctor_name') form-control-danger @enderror"
                                            name="doctor_name" value="{{ old('doctor_name') }}" autofocus
                                            placeholder="Your doctor name">
                                    </div>
                                    @error('doctor_name')
                                    <small class="form-text text-muted text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="doctor-contact">Doctor contact</label>
                                    <div class="input-group @error('doctor_contact') has-danger @enderror">
                                        <input id="doctor-contact" type="text"
                                            class="form-control @error('doctor_contact') form-control-danger @enderror"
                                            name="doctor_contact" value="{{ old('doctor_contact') }}" autofocus
                                            placeholder="Your doctor's contact">
                                    </div>
                                    @error('doctor_contact')
                                    <small class="form-text text-muted text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-round mb-3">
                            Save and continue
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
