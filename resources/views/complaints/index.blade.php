@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Complaints</h4>
                    <a id="prntrt" href="{{ route('complaints.create') }}" class="btn btn-round btn-primary">
                        <i class="fas fa-plus"></i> Add complaint
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Name</th>
                                <th>Complaint</th>
                                <th>Status</th>
                                <th class="text-right">Log Date</th>
                                <th class="text-right">Address Date</th>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $complaint)
                                    <tr is="complaint-row" :row-complaint="{{ $complaint }}"></tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $complaints->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <service-details-modal></service-details-modal>
    <service-update-modal></service-update-modal>
@endsection
