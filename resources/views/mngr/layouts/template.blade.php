<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hexeam</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul>
                    <li class="mt-2"><a href="{{route('coupons')}}"  class="text-decoration-none text-dark">Coupons</a></li>
                    <li class="mt-2"><a href="{{route('orders')}}"  class="text-decoration-none text-dark">Orders</a></li>
                    <li class="mt-2"><a href="{{route('logout')}}" onclick="return confirm('Are you sure you want to logout ?')" class="text-decoration-none text-dark">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-10 bg-light pt-2">
                @if (session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if (session()->has('danger'))
                    <div class="alert alert-danger">{{session('danger')}}</div>
                @endif
                @yield('content')
            </div>
        </div>
        
    </div>
</body>
</html>