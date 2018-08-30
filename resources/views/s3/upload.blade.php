@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">

    <div class="container">

        <div class="row justify-content-center m-5">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/aws/s3/upload') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="file">Upload file to S3</label>
                                <input type="file" name="file" class="form-control-file" id="file"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center m-5">
            <div class="col-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    @if (session()->has('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
