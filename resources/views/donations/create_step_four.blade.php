@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Step 4: Select donor</h4>
                    <small>
                        Total cost <strong>{{ 'GHC ' . $donation->cost }}</strong>
                    </small>
                    <p>Please select a mark on the map to view the donor's profile</p>
                </div>
                <div class="card-body">
                    <donor-proximity-map :all-donors="{{ $donors }}" :donation="{{ $donation }}">
                    </donor-proximity-map>

                    <a class="btn btn-primary btn-round mb-3"
                        href="{{ route('payment.index', ['donation' => $donation->id]) }}">
                        Move to payment
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
