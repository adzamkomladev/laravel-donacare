@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Order</th>
                                <th>
                                    {{ Auth::user()->role === 'donor' ? 'Patient' : 'Donor' }}
                                </th>
                                <th>Status</th>
                                <th>Date</th>
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
