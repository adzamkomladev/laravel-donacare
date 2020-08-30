@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Prescriptions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th> #</th>
                                <th> Request </th>
                                <th>Prescription</th>
                                <th class="text-right">Date</th>
                            </thead>
                            <tbody>
                                @foreach ($prescriptions as $prescription)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $prescription->donation->value }}</td>
                                        <td id="complstgrn">
                                            <a id="comp"
                                                href="{{ route('prescriptions.show', ['prescription' => $prescription->id]) }}"
                                                class="btn btn-round btn-primary">Prescription(click
                                                to view)</a>
                                        </td>
                                        <td class="text-right">
                                            {{ $prescription->created_at->toDateString() }}
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
