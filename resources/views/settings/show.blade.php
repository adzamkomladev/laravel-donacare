@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">System settings</h5>
            </div>
            <div class="card-body">
            <update-setting :setting="{{ $setting->data }}"></update-setting>
            </div>
        </div>
    </div>
</div>
@endsection
