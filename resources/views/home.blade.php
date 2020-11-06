@extends('layouts.app')

@section('content')
    {{-- <div class="row">
        <div class="col-md-6">
            <div class="card  card-tasks">
                <div class="card-header ">
                    <h5 class="card-category">User Accounts</h5>
                    <h4 class="card-title">Latest users</h4>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                <thead class=" text-primary">
                                    <th>
                                        User Name
                                    </th>
                                    <th>
                                        Status(activted)
                                    </th>
                                    <th class="text-right">
                                        Action
                                    </th>
                                </thead>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-left">{{ $user->profile->full_name }}</td>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox"
                                                        {{ $user->activated ? 'checked' : '' }} readonly>
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title=""
                                                class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                data-original-title="View user details">
                                                <a href="{{ route('users.show', ['user' => $user->id]) }}"><i
                                                        class="now-ui-icons users_circle-08"></i></a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="now-ui-icons loader_refresh spin"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Top services</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Service
                                </th>
                                <th>
                                    charge/price (GHc)
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>
                                            {{ $service->name }}
                                        </td>
                                        <td>
                                            {{ $service->price }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="home row px-4 py-3 justify-content-center">
        <div class="stats-card col-md-10 p-4 row text-center">
            <div class="col-md-3">
                <x-total-cash-flow-stat-card />
            </div>

            <div class="col-md-3">
                <x-total-donations-stat-card />
            </div>

            <div class="col-md-3">
                <x-total-users-stat-card />
            </div>

            <div class="col-md-3 last">
                <x-total-users-stat-card />
            </div>
        </div>
    </div>
    <div class="chart-table-section row mt-4 p-4 ">
        <div class="col-md-6">
            <h4>Donation request summary</h4>
            <!-- Chart's container -->
            <div id="chart" style="height: 300px;"></div>
        </div>
        <div class="last col-md-6">
            <h4>Latest Donation Requests</h4>
            <x-latest-donations-table />
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('donation_pie_chart')",
        });

    </script>
@endpush
