@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Donation donors</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th> #</th>
                                <th> Donor name </th>
                                <th>Payment status</th>
                                <th>Date paid</th>
                                <th class="text-right">Make mobile money payment</th>
                            </thead>
                            <tbody>
                                @foreach ($donation->donationDonors as $donationDonor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $donationDonor->user->profile->full_name }}</td>
                                        <td>
                                            @if ($donationDonor->payment)
                                                {{ $donationDonor->payment->confirmed ? 'Completed' : 'Initiated' }}
                                            @else
                                                Not initiated
                                            @endif
                                        </td>
                                        <td>
                                            @if ($donationDonor->payment)
                                                {{ $donationDonor->payment->updated_at->toDateString() }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-right" id="complstgrn">
                                            @if ($donationDonor->donation->payment_method === 'Mobile money')
                                                    <a id="comp"
                                                        href="{{ route('initiate-payment', ['donationDonor' => $donationDonor->id]) }}"
                                                        class="btn btn-round btn-primary">Payment(click
                                                        to initiate)</a>
                                            @else
                                                Unavailable
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
