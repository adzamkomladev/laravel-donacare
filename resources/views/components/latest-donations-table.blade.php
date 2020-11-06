<div class="donations-table">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Hospital</th>
                <th>Number of Blood Bags</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donations as $donation)
                <tr>
                    <td scope="row"> {{ $donation->patient->profile->full_name }}</td>
                    <td>{{ $donation->hospital->location->name }}</td>
                    <td>{{ $donation->quantity }}</td>
                </tr>
            @empty
                <p>
                    No Donation requests available
                </p>
            @endforelse
        </tbody>
    </table>
</div>
