@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Step 2: Upload prescription images</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('files.store', ['serviceRequest' => $serviceRequest->id]) }}"
                        enctype="multipart/form-data" class="dropzone" id="dropzone">
                        @csrf
                    </form>

                    <a class="btn btn-primary btn-round mb-3"
                        href="{{ route('service-requests.create.step-three', ['serviceRequest' => $serviceRequest->id]) }}">
                        Save and continue
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
            integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
            crossorigin="anonymous" />
    @endpush


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"
            integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA=="
            crossorigin="anonymous"></script>

        <script type="text/javascript">
            Dropzone.options.dropzone = {
                maxFilesize: 10,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 60000,
                success: function(file, response) {
                    console.log(response);
                },
                error: function(file, response) {
                    return false;
                }
            };

        </script>
    @endpush

@endsection
