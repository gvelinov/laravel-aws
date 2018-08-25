<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AWS Essentials</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <a href="/"><img src="{{ asset('img/2x-AWS.png') }}" alt="AWS Essentials"/></a>
            </div>
        </div>

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
</body>
</html>
