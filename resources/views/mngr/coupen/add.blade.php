@extends('mngr.layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
      Add Coupon
    </div>
    <div class="card-body">
        <form action="" method="post" onsubmit="return check()">
            @csrf
            <div class="form-group">
              <label for="formGroupExampleInput">Coupon</label>
              <input type="text" class="form-control" name="coupon" id="coupon" readonly required value="{{$random_coupen}}">
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Coupon Type</label>
              <select name="coupon_type" class="form-control" id="type" required onchange="typeValue()">
                <option value=""> --SELECT--</option>
                <option value="1"> Fixed Amount </option>
                <option value="2"> Percentage </option>
              </select>
            </div>
            <div class="form-group" style="display:none" id="typeval">
                <label for="">Type Value</label>
                <input type="text" name="fixed_amt" class="form-control" id="fixed" placeholder="Amount">
                <input type="text" name="percent_amt" class="form-control" id="percent" placeholder="Percentage">
            </div>
            <div class="form-group">
                <label for="">Coupen Valid From</label>
                <input type="date" name="valid_from" min="{{date('Y-m-d')}}" class="form-control" required id="from">
            </div>
            <div class="form-group">
                <label for="">Coupen Valid To</label>
                <input type="date" name="valid_to" class="form-control" required id="to">
            </div>
            <div class="form-group m-2">
                <input type="submit" class="btn btn-primary" value="Add Coupon">
            </div>
          </form>
    </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>
        function typeValue()
        {
            var type =$("#type").val();
            
            $("#typeval").css("display","block");
            if(type == 1)
            {
                
                $("#fixed").css("display","block");
                $("#fixed").attr("required",true);
                $("#percent").attr("required",false);
                $("#percent").css("display","none");
            }else{
                $("#fixed").css("display","none");
                $("#fixed").attr("required",false);
                $("#percent").attr("required",true);
                $("#percent").css("display","block");
            }
        }
        function check()
        {
            if($("#coupon").val() =="")
            {
                alert("Coupon field is required")
            }
            if($("#type").val() =="")
            {
                alert("Choose a coupon type")
            }
            if($("#from").val() =="")
            {
                alert("From date is required")
            }
            if($("#to").val() =="")
            {
                alert("To date is required")
            }
        }
    </script>
@endsection