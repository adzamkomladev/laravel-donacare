@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">History</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>#</th>
                                <th>Event</th>
                                <th>Name</th>
                                <th>Occured on</th>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <x-history-row :history="$history" :iteration="$loop->iteration" />
                                @empty
                                    No history available
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
