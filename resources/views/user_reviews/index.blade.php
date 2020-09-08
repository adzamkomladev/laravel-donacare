@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Donor Ratings</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>#</th>
                                <th>Donation Request</th>
                                <th>Details</th>
                                <th>Rating (out of 5)</th>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('donations.show', ['donation' => $review->donation_id]) }}">
                                                {{ ($review->donation->type. ' ' . $review->donation->value) ?? 'N/A' }}
                                            </a>
                                        </td>
                                        <td>{{ $review->details ?? 'N/A' }}</td>
                                        <td>{{ $review->rating . ' stars' ?? 'N/A' }}</td>
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
