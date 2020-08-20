@extends('layouts.app')

@section('content')
    <update-jurisdiction :selected-profile="{{ $profile }}"></update-jurisdiction>
@endsection
