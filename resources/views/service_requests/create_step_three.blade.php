@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Step 3: Select provider</h4>
                    <small>
                        Total cost <strong>{{ 'GHC ' . $serviceRequest->service->price }}</strong>
                    </small>
                    <p>Please select a mark on the map to view the provider's profile</p>
                </div>
                <div class="card-body">
                    <provider-proximity-map :all-providers="{{ $providers }}" :service-request="{{ $serviceRequest }}">
                    </provider-proximity-map>

                    <a class="btn btn-primary btn-round mb-3"
                        href="{{ route('service-requests.create.step-three', ['serviceRequest' => $serviceRequest->id]) }}">
                        Save and continue
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
