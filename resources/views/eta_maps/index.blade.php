@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">ETA map</h4>
                </div>
                <div class="card-body">
                    <eta-map :donation="{{ $donation }}"></eta-map>
                </div>
            </div>
        </div>
    </div>
@endsection
