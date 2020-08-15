@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Payment</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('payment.pay') }}" method="POST" accept-charset="UTF-8" class="form-horizontal" role="form">
                        @csrf
{{--                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> --}}

                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') form-control-danger @enderror"
                                           name="name" value="{{ old('email') }}" required placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" step=".01" min="0"
                                           class="form-control @error('amount') form-control-danger @enderror"
                                           placeholder="Amount" name="price" value="{{ old('amount') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="form-control s" value="Pay Now!">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
