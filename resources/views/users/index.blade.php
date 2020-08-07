@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card  card-tasks">
                <div class="card-header ">
                    <h5 class="card-category">All users</h5>
                    <h4 class="card-title">All user accounts in the system</h4>
                </div>
                <div class="card-body ">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                                <thead class=" text-primary">
                                    <th>Role</th>
                                    <th>User Name</th>
                                    <th>Telephone</th>
                                    <th>Status(activted)</th>
                                    <th>Online status</th>
                                    <th class="text-right">Action</th>
                                </thead>
                                @foreach ($users as $user)
                                    <tr is="users-table-row"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
