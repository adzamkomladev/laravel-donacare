@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Start request process</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('service-requests.store.step-one') }}">
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
                                    <label for="service">Service</label>
                                    <div class="input-group @error('service_id') has-danger @enderror">
                                        <select id="service"
                                            class="form-control @error('service_id') form-control-danger @enderror"
                                            name="service_id" required>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">
                                                    {{ $service->name . ' - GH₵ ' . $service->price }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('service_id')
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
                                    <label for="hospital-name">Hospital name</label>
                                    <div class="input-group @error('hospital_name') has-danger @enderror">
                                        <input id="hospital-name" type="text"
                                            class="form-control @error('hospital_name') form-control-danger @enderror"
                                            name="hospital_name" value="{{ old('hospital_name') }}" autofocus
                                            placeholder="The hospital's name">
                                    </div>
                                    @error('hospital_name')
                                    <small class="form-text text-muted text-danger">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="hospital-contact">Hospital contact</label>
                                    <div class="input-group @error('hospital_contact') has-danger @enderror">
                                        <input id="hospital-contact" type="text"
                                            class="form-control @error('hospital_contact') form-control-danger @enderror"
                                            name="hospital_contact" value="{{ old('hospital_contact') }}" autofocus
                                            placeholder="The hospital's contact">
                                    </div>
                                    @error('hospital_contact')
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
                                    <label for="hospital-location">Hospital address/location</label>
                                    <div class="input-group @error('hospital_location') has-danger @enderror">
                                        <input id="hospital-location" type="text"
                                            class="form-control @error('hospital_location') form-control-danger @enderror"
                                            name="hospital_location" value="{{ old('hospital_location') }}" autofocus
                                            placeholder="The hospital's location">
                                    </div>
                                    @error('hospital_location')
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
