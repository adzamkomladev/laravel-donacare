@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">User Account Details</h5>
                </div>
                <div class="card-body">
                    <profile-form></profile-form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <user-details-card></user-details-card>
        </div>
    </div>
@endsection
