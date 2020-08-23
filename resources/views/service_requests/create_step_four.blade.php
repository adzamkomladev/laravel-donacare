@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Step 4: Select donor</h4>
                    <small>
                        Total cost <strong>{{ 'GHC ' . $serviceRequest->cost }}</strong>
                    </small>
                    <p>Please select a mark on the map to view the donor's profile</p>
                </div>
                <div class="card-body">
                    <donor-proximity-map :all-donors="{{ $donors }}" :service-request="{{ $serviceRequest }}">
                    </donor-proximity-map>

                    <a class="btn btn-primary btn-round mb-3"
                        href="{{ route('payment.index', ['serviceRequest' => $serviceRequest->id]) }}">
                        Move to payment
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
