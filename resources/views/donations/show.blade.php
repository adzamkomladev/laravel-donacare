@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card card-upgrade">
                <div class="card-header text-center">
                    <h4 class="card-title">Donation details</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="font-weight-bold">
                            ({{ 'Group ' . $donation->value }})
                        </h4>
                        <p>{{ $donation->description }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="item">
                                <label for="hospital-name">
                                    <i class="fas fa-hospital"></i> Hospital name
                                </label>
                                <p id="hospital-name">{{ $donation->hospital_name ?? 'N/A' }}</p>
                            </div>
                            <div class="item">
                                <label for="hospital-location">
                                    <i class="fas fa-location-arrow"></i> Hospital location
                                </label>
                                <p id="hospital-location">{{ $donation->hospital_location ?? 'N/A' }}</p>
                            </div>
                            <div class="item">
                                <label for="value">
                                    <i class="fas fa-bed"></i> Request item
                                </label>
                                <p id="value">{{ $donation->value }}</p>
                            </div>
                            <div class="donor">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="item">
                                <label for="quantity">
                                    <i class="fas fa-shopping-basket"></i> Quantity
                                </label>
                                <p id="quantity">{{ $donation->quantity }}</p>
                            </div>
                            <div class="item">
                                <label for="payment-status">
                                    <i class="fas fa-money-bill"></i> Free/Charged
                                </label>
                                <p id="payment-status" class="text-capitalize">{{ $donation->payment_status }}</p>
                            </div>
                            <div class="item">
                                <label for="status">
                                    <i class="fas fa-file-alt"></i> Status
                                </label>
                                <p id="status">
                                    <span class="badge badge-pill badge-info">
                                        {{ $donation->status }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if ($donation->patient_id === Auth::id())
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('user_reviews.create', ['donation' => $donation->id]) }}"
                                    class="btn btn-success btn-round">
                                    Make a review
                                </a>
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        @if ($donation->donor_id)
                            <div class="col-md-6">
                                <label for="donor" class="font-weight-bold text-dark text-uppercase">Donor</label>
                                <div id="donor" class="card text-center">
                                    <img width="120px" src="/img/avatar-default.png" alt="Donor avatar"
                                        class="img-fluid rounded-circle mb-3">
                                    <p>
                                        <a href="{{ route('users.show', ['user' => $donation->donor_id]) }}">
                                            <i class="fas fa-share-square"></i>
                                        </a>
                                        {{ $donation->donor->profile->full_name }}
                                    </p>
                                </div>
                            </div>

                        @endif

                        <div class="col-md-6">
                            <label for="patient" class="font-weight-bold text-dark text-uppercase">Patient</label>
                            <div id="patient" class="card text-center">
                                <img width="120px" src="/img/avatar-default.png" alt="Donor avatar"
                                    class="img-fluid rounded-circle mb-3">
                                <p>
                                    <a href="{{ route('users.show', ['user' => $donation->patient_id]) }}">
                                        <i class="fas fa-share-square"></i>
                                    </a>
                                    {{ $donation->patient->profile->full_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Update status</h4>
                            <update-status-form :donation="{{ $donation }}"></update-status-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
