@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <h5 class="title">
                        {{ $type === 'blood' ? 'Blood Request Form' : ($type === 'funds' ? 'Fund Request Form' : 'Organ Request Form') }}
                    </h5>
                </div>
                <div class="card-body">
                <create-donation type="{{ $type }}" :service="{{ $services[0] }}"></create-donation>
                </div>
            </div>
        </div>
    </div>
@endsection
