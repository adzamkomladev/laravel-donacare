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
                                @foreach ($donations as $donation)
                                    <tr is="donation-row" :row-donation="{{ $donation }}"></tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $donations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
