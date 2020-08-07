@extends('layouts.app')

@section('content')
    <div class="row">
      <div class="col-md-12">
        <div class="card  card-tasks">
          <div class="card-header ">
            <h5 class="card-category">-------</h5>
            <h4 class="card-title">---</h4>
          </div>
          <div class="card-body ">
            <div class="table-full-width table-responsive">
              <table class="table">
                <tbody>
                  <thead class=" text-primary">
                    <th>
                      #
                    </th>
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
                  <tr>
                    <td class="text-left">0</td>
                    <td class="text-left">Account name</td>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked>
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
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
                  <tr>
                    <td class="text-left">0</td>
                   <td class="text-left">Account name</td>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
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
                  <tr>
                    <td class="text-left">0</td>
                    <td class="text-left">Account name</td>
                    <td>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" checked>
                          <span class="form-check-sign"></span>
                        </label>
                      </div>
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
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
