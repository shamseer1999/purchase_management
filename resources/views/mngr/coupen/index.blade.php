@extends('mngr.layouts.template')
@section('content')
<div class="card">
    <div class="card-header">
      Coupens List
      <a href="{{route('coupon.add')}}" class="btn btn-primary btn-sm" style="float:right;">Add Coupon</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Sl.no</th>
                <th scope="col">Coupon</th>
                <th scope="col">Coupon Type</th>
                <th scope="col">Amount/Percent</th>
                <th scope="col">Valid From</th>
                <th scope="col">Valid To</th>
                <th scope="col">Action</th>
        
              </tr>
            </thead>
            <tbody>
                @if (sizeof($results) > 0)
                    @foreach ($results as $item)
                        <tr>
                            <td>{{$results->firstItem()+$loop->index}}</td>
                            <td>{{$item->coupon}}</td>
                            <td>{{$item->coupon_type == 1 ? 'Fixed Amount' : 'Percentage'}}</td>
                            <td>{{$item->type_val_fixed ? $item->type_val_fixed.'₹' : ''}} {{$item->type_val_percent ? $item->type_val_percent.'%' : ''}}</td>
                            <td>{{$item->valid_from ? date('d-m-Y',strtotime($item->valid_from)) : ''}}</td>
                            <td>{{$item->valid_to ? date('d-m-Y',strtotime($item->valid_to)) : ''}}</td>
                            <td>
                                <a href="{{route('coupon.view',encrypt($item->id))}}" class="btn btn-primary btn-sm" title="View">View</a>
                                <a href="" class="btn btn-primary btn-sm" title="Edit">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
          {{$results->links()}}
    </div>
  </div>

@endsection