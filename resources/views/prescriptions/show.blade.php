@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card card-upgrade">
                <div class="card-header text-center">
                    <h4 class="card-title">Prescription</h3>
                        <p class="card-category">
                            Prescription image for <strong>{{ $prescription->donation->value }}</strong> donation request.
                            <br>
                            Requested on {{ $prescription->donation->created_at->toDateString() }}
                        </p>
                </div>
                <div class="card-body">
                    <img src="{{ $prescription->path }}" alt="Prescription image">
                    <div class="row">
                        <a href="{{ route('donations.show', [$prescription->donation->id]) }}"
                            class="btn btn-primary btn-round mt-5">View Request</a>
                        <a href="{{ $prescription->path }}" target="_blank" class="btn btn-primary btn-round mt-5">
                            Download prescription image
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
