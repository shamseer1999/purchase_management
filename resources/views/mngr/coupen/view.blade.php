@extends('mngr.layouts.template')
@section('content')
        <div class="card">
            <div class="card-header">
              Coupon View
            </div>
            <div class="card-body">
              <p class="card-text">{{'Coupon : '.$view_data->coupon}}</p>
              <p class="card-text">Coupon Type : {{$view_data->coupon_type == 1 ? 'Fixed Amount' : 'Percentage'}}</p>
              <p class="card-text">Amount : {{$view_data->type_val_fixed ? $view_data->type_val_fixed.'₹' : 'N/A'}}</p>
              <p class="card-text">Percentage : {{$view_data->type_val_percent ? $view_data->type_val_percent.'%' : 'N/A'}}</p>
              <p class="card-text">Valid From : {{$view_data->valid_from ? date('d-m-Y',strtotime($view_data->valid_from)) :''}}</p>
              <p class="card-text">Valid To : {{$view_data->valid_to ? date('d-m-Y',strtotime($view_data->valid_to)) : ''}}</p>
            </div>
          </div>
@endsection