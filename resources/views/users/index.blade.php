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
                                    <tr>
                                        <td class="text-left text-muted">
                                            @if($user->role === 'admin')
                                                <i class="fas fa-user-cog fa-lg"></i>
                                                <small>Admin</small>
                                            @endif
                                        </td>
                                        <td class="text-left">Account name</td>
                                        <td class="text-left">{{ $user->telephone }}</td>
                                        <td>
                                            @if($user->role !== 'admin')
                                                <div class="form-check">
                                                  <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                    <span class="form-check-sign"></span>
                                                  </label>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-success">Online</span>
                                        </td>
                                        <td class="td-actions text-right">
                                          <button type="button" rel="tooltip" title="" class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Edit Task">
                                            <a href="user.html"><i class="now-ui-icons users_circle-08"></i></a>
                                          </button>
                                          <button type="button" rel="tooltip" title="" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" data-original-title="Remove">
                                            <i class="now-ui-icons ui-1_simple-remove" title="delete this user"></i>
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
                    <div class="stats">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
