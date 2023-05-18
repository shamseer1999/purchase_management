<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data['results'] = Order::with('coupons','customers')->paginate(10);

        return view('mngr.order.index',$data);
    }
}
