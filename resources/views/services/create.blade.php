@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add New Service</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') form-control-danger @enderror"
                                        name="name" value="{{ old('name') }}" required placeholder="Service name">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Price/Charge</label>
                                    <input type="number" step=".01" min="0"
                                        class="form-control @error('price') form-control-danger @enderror"
                                        placeholder="Service price/charge" name="price" value="{{ old('price') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="4" cols="80"
                                        class="form-control @error('description') form-control-danger @enderror"
                                        name="description" placeholder="Service description">
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
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <h4>Recent services</h4>
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Service</th>
                            <th>Price (GHc)</th>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->price }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
