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
                    <donation-form type="{{ $type }}" :services="{{ $services }}"></donation-form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="//static.filestackapi.com/filestack-js/3.x.x/filestack.min.js" crossorigin="anonymous"></script>
    @endpush
@endsection
