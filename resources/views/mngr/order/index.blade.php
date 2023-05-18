@extends('mngr.layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
      Orders List
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Sl.no</th>
                <th scope="col">Customer</th>
                <th scope="col">Coupon</th>
                <th scope="col">Original Rate</th>
                <th scope="col">Discounted Rate</th>
                <th scope="col">Payment Status</th>
        
              </tr>
            </thead>
            <tbody>
                @if (sizeof($results) > 0)
                    @foreach ($results as $item)
                        <tr>
                            <td>{{$results->firstItem()+$loop->index}}</td>
                            <td>{{$item->customers->name}}</td>
                            <td>{{$item->coupons->coupon}}</td>
                            <td>{{$item->original_amount}}</td>
                            <td>{{$item->discounted_amount}}</td>
                            <td>{{$item->payment_status ==1 ? 'Not Paid' : 'Paid'}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
          {{$results->links()}}
    </div>
  </div>

@endsection