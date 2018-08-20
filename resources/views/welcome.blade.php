<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AWS Essentials</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <img src="img/2x-AWS.png" alt="AWS Essentials"/>
            </div>
        </div>

        <div class="row justify-content-center m-5">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="file">Upload file to S3</label>
                        <input type="file" name="file" class="form-control-file" id="file"/>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
