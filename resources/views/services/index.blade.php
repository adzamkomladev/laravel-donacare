@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Services</h4>
                    <a id="prntrpt" href="add_prices.html" class="btn btn-round btn-primary">
                        <i class="fas fa-plus"></i> Add service
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Service</th>
                                <th>Price (GH₵)</th>
                                <th>Availability</th>
                                <th>No. of requests</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr is="service-row" :row-service="{{ $service }}"></tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <service-details-modal></service-details-modal>
    <service-update-modal></service-update-modal>
@endsection
