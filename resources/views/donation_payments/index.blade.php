@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Transaction Log</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>#</th>
                                <th>Transaction detail</th>
                                <th>Status</th>
                                <th class="text-right">Initiation Date</th>
                                <th class="text-right">Confirmed Date</th>
                                <th class="text-right">Actions</th>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('donations.show', ['donation' => $payment->donationDonor->donation_id]) }}">
                                                {{ 'Blood donation (Group ' . $payment->donationDonor->donation->value . ' )' }}
                                            </a>
                                        </td>
                                        <td id="{{ $payment->confirmed ? 'complstgrn' : 'complstrd' }}">
                                            {{ $payment->confirmed ? 'Confirmed' : 'Unconfirmed' }}
                                        </td>
                                        <td class="text-right">
                                            {{ $payment->created_at->toDateString() }}
                                        </td>
                                        <td class="text-right">
                                            {{ $payment->confirmed ? $payment->created_at->toDateString() : 'Not yet' }}
                                        </td>
                                        <td class="text-right">
                                            @if (!$payment->confirmed)
                                                <a href="{{ route('donation_payments.confirm', ['payment' => $payment->id]) }}"
                                                    class="btn btn-primary btn-round">
                                                    Confirm
                                                </a>
                                            @else
                                                <p>No actions</p>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <p>No payments made so far</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
