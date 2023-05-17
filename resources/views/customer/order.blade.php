<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-color: darkcyan">
    <div class="container">
        <a href="{{route('customer.logout')}}" class="text-decoration-none text-white mt-1" style="float:right"><i class="fa fa-sign-out"></i> Logout</a>
        <div class="row justify-content-center" style="position: relative;">
            <div class="col-md-6 bg-light" style="position: absolute;margin-top:300px;">
                @if (session()->has('danger'))
                    <div class="alert alert-danger mt-1">{{session('danger')}}</div>
                @endif
                @if ($errors->any())
                <div>
                    <ul>
                    @foreach ($errors->all() as $item)
                        
                                <li>{{$item}}</li>
                            
                    @endforeach
                </ul>
            </div>
                @endif
                <form action="{{route('customer.order')}}" method="post">
                    @csrf
                    <h4 class="text-center m-2">Create Order</h4>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Order Amount</label>
                      <input type="number" class="form-control" name="amt" id="amt" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Coupen Code</label>
                      <input type="text" class="form-control" name="coupon" id="coupon" placeholder="" required>
                    </div>
                    <div class="form-group m-2">
                        <input type="submit" class="btn btn-primary" value="Order">
                    </div>
                  </form>
            </div>
        </div>
    </div>
</body>
</html>