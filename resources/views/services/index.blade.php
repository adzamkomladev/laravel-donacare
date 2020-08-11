@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Services</h4>
                    <a id="prntrpt" href="add_prices.html" class="btn btn-round btn-primary">
                        <i class="fas fa-plus"></i> Add service
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>#</th>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0</td>
                                    <td>product/service 1</td>
                                    <td>xx</td>
                                    <td>
                                        <button type="button" rel="tooltip" title=""
                                            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove" title="delete this user"></i>
                                        </button>

                                    </td>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>
                                        product/service 1
                                    </td>
                                    <td>
                                        xx
                                    </td>
                                    <td>
                                        <button type="button" rel="tooltip" title=""
                                            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove" title="delete this user"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>
                                        product/service 1
                                    </td>
                                    <td>
                                        xx
                                    </td>
                                    <td>
                                        <button type="button" rel="tooltip" title=""
                                            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove" title="delete this user"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>
                                        product/service 1
                                    </td>
                                    <td>
                                        xx
                                    </td>
                                    <td>
                                        <button type="button" rel="tooltip" title=""
                                            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove" title="delete this user"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>0</td>
                                    <td>
                                        product/service 1
                                    </td>
                                    <td>
                                        xx
                                    </td>
                                    <td>
                                        <button type="button" rel="tooltip" title=""
                                            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                            data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove" title="delete this user"></i>
                                        </button>
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
