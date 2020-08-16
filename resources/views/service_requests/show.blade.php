@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card card-upgrade">
                <div class="card-header text-center">
                    <h4 class="card-title">Request details</h4>
                    <p class="card-category">
                        Order #{{ $serviceRequest->id }}
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-upgrade">
                        <table class="table">
                            <thead>
                                <th></th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Title</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center">xx</td>
                                    <td class="text-center">xx</td>
                                </tr>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center">xx</td>
                                    <td class="text-center">xx</td>
                                </tr>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center">xx</td>
                                    <td class="text-center">xx</td>
                                </tr>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_simple-remove text-danger"></i></td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_simple-remove text-danger"></i></td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_simple-remove text-danger"></i></td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td>detail goes here</td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_simple-remove text-danger"></i></td>
                                    <td class="text-center"><i class="now-ui-icons ui-1_check text-success"></i></td>
                                </tr>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                    </td>
                                    <td class="text-center">
                                        <a href="client_detail.html" class="btn btn-round btn-primary">client details</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
