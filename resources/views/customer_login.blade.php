<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body style="background-color: darkcyan">
    <div class="container">
        <div class="row justify-content-center" style="position: relative;">
            <div class="col-md-6 bg-warning" style="position: absolute;margin-top:300px;">
                @if (session()->has('danger'))
                    <div class="alert alert-danger mt-1">{{session('danger')}}</div>
                @endif
                <form action="" method="post">
                    @csrf
                    <h4 class="text-center m-2">Login</h4>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Phone</label>
                      <input type="text" class="form-control" name="phone" id="formGroupExampleInput" placeholder="">
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput2">Password</label>
                      <input type="password" class="form-control" name="password" id="formGroupExampleInput2" placeholder="">
                    </div>
                    <div class="form-group m-2">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                  </form>
            </div>
        </div>
    </div>
</body>
</html>