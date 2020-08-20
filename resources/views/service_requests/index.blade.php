@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Services requests</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Service</th>
                                <th>Price (GH₵)</th>
                                <th>
                                    {{ Auth::user()->role === 'donor' ? 'Patient' : 'Donor' }}
                                </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($serviceRequests as $serviceRequest)
                                    <tr is="service-request-row" :row-service-request="{{ $serviceRequest }}"></tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $serviceRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
