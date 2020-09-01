@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h6 class="category"><lc class="now-ui-icons media-2_sound-wave"></lc> Make Request</h6> -->
                    <h6 class="title">
                        <lc class="now-ui-icons media-2_sound-wave"></lc> Make Request
                    </h6>
                    <a id="mr2" href="{{ route('donations.create') . '?type=blood' }}"
                        class="btn btn-round btn-primary">Blood</a>
                    <a id="mr2" href="{{ route('donations.create') . '?type=organ' }}"
                        class="btn btn-round btn-primary">Organ</a>
                    <a id="mr2" href="{{ route('donations.create') . '?type=funds' }}"
                        class="btn btn-round btn-primary">Funds</a>
                    <h5 class="title">Search Donors</h5>
                </div>
                <div class="card-body all-icons">
                    <display-donors :all-donors="{{ $donors }}"></display-donors>
                </div>
            </div>
        </div>
    </div>
@endsection
