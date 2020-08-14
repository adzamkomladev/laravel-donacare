@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add New Complaint</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('complaints.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control @error('title') form-control-danger @enderror"
                                        name="title" value="{{ old('title') }}" required placeholder="Complaint title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="4" cols="80"
                                        class="form-control @error('description') form-control-danger @enderror"
                                        name="description" placeholder="Complaint description">
                                    {{ old('description') }}
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" id="sbmt" class="form-control s" value="add">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
