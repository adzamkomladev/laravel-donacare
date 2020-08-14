@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Step 3: Select provider</h4>
                    <small>Total cost {{ 'GHC ' . $serviceRequest->service->price }}</small>

                </div>
                <div class="card-body">
                    <provider-proximity-map :all-providers="{{ $providers }}"></provider-proximity-map>
                </div>
            </div>
        </div>
    </div>
@endsection
