@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card card-upgrade">
                <div class="card-header text-center">
                    <h4 class="card-title">Request details</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="font-weight-bold">
                            {{ $serviceRequest->service->name }} - {{ 'GHC ' . $serviceRequest->service->price }}
                        </h4>
                        <p>{{ $serviceRequest->description }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="item">
                                <label for="hospital-name">
                                    <i class="fas fa-hospital"></i> Hospital name
                                </label>
                                <p id="hospital-name">{{ $serviceRequest->hospital_name ?? 'N/A' }}</p>
                            </div>
                            <div class="item">
                                <label for="hospital-contact">
                                    <i class="fas fa-phone"></i> Hospital contact
                                </label>
                                <p id="hospital-contact">{{ $serviceRequest->hospital_contact ?? 'N/A' }}</p>
                            </div>
                            <div class="item">
                                <label for="hospital-location">
                                    <i class="fas fa-location-arrow"></i> Hospital location
                                </label>
                                <p id="hospital-location">{{ $serviceRequest->hospital_location ?? 'N/A' }}</p>
                            </div>
                            <div class="donor">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="item">
                                <label for="doctor-name">
                                    <i class="fas fa-user-md"></i> Doctor name
                                </label>
                                <p id="doctor-name">{{ $serviceRequest->doctor_name ?? 'N/A' }}</p>
                            </div>
                            <div class="item">
                                <label for="doctor-contact">
                                    <i class="fas fa-phone"></i> Doctor contact
                                </label>
                                <p id="doctor-contact">{{ $serviceRequest->doctor_contact ?? 'N/A' }}</p>
                            </div>
                            <div class="item">
                                <label for="hospital-contact">
                                    <i class="fas fa-file-alt"></i> Status
                                </label>
                                <p id="hospital-contact">
                                    <span class="badge badge-pill badge-info">
                                        {{ $serviceRequest->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="donor" class="font-weight-bold text-dark text-uppercase">Donor</label>
                            <div id="donor" class="card text-center">
                                <img width="120px" src="/img/avatar-default.png" alt="Donor avatar"
                                    class="img-fluid rounded-circle mb-3">
                                <p>
                                    <a href="{{ route('users.show', ['user' => $serviceRequest->donor_id]) }}">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                    {{ $serviceRequest->donor->profile->full_name }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="patient" class="font-weight-bold text-dark text-uppercase">Patient</label>
                            <div id="patient" class="card text-center">
                                <img width="120px" src="/img/avatar-default.png" alt="Donor avatar"
                                    class="img-fluid rounded-circle mb-3">
                                <p>
                                    <a href="{{ route('users.show', ['user' => $serviceRequest->patient_id]) }}">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                    {{ $serviceRequest->patient->profile->full_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Update status</h4>
                            <update-status-form :service-request="{{ $serviceRequest }}"></update-status-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
