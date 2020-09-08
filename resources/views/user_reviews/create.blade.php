@extends('layouts.app')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Make review</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user_reviews.store') }}" method="POST">
                        @csrf
                        <input type="text" name="donation_id" hidden value="{{ $donation->id }}">
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>Select rating</label>
                                    <!-- <input type="text" class="form-control" placeholder="Product/Service"> -->
                                    <select class="form-control" name="rating" required>
                                        <option id="jui" value="1">1 star</option>
                                        <option id="jui" value="2">2 stars</option>
                                        <option id="jui" value="3">3 stars</option>
                                        <option id="jui" value="4">4 stars</option>
                                        <option id="jui" value="5">5 stars</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <label for="details">Review details</label>
                                    <textarea class="form-control" name="details" id="details" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" id="sbmt" class="form-control s" value="Add review">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
