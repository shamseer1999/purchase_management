<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function dashbord()
    {
        return view('customer.order');
    }
    public function order(Request $request)
    {
        $validated=$request->validate([
            'amt'=>'required|numeric',
            'coupon' =>'required'
        ]);

        $customer=auth()->guard('customer')->user()->id;

        $checkCoupon=Coupon::where('coupon',$validated['coupon'])->first();

        if(empty($checkCoupon))
        {
            return redirect()->route('customer.dashbord')->with('danger','Coupon is not exist! Check your coupon correctly');
        }
// dd($checkCoupon);
        if(($checkCoupon->valid_from <= date('Y-m-d')) && ($checkCoupon->valid_to >= date('Y-m-d')))
        {
            if($checkCoupon->coupon_type ==1)
            {
                $amt=(float)$validated['amt'];
                $discount=$checkCoupon->type_val_fixed;
                $total = $amt - $discount;
            }else{
                $amt=(float)$validated['amt'];
                $discount = $checkCoupon->type_val_percent;
                $total = $amt - ($amt * ($discount/100));
            }

            $order_data=array(
                'original_amount' =>$amt,
                'discounted_amount'=>$total,
                'coupon_id' =>$checkCoupon->id,
                'coupen_type' =>$checkCoupon->coupon_type,
                'discount' =>$discount,
            );

            $checkOrder=Order::where(['coupon_id'=>$checkCoupon->id,'created_by'=>$customer])->first();
//  dd($checkOrder);
            if(empty($checkOrder))
            {
                $data['order'] =$order_data;
                return view('customer.proceed_to_pay',$data);
            }else{
                return redirect()->route('customer.dashbord')->with('danger','This coupon is already used');
            }

        }else{
            return redirect()->route('customer.dashbord')->with('danger','Coupon is expired!'); 
        }
    }

    public function order_proceed(Request $request)
    {
        $validated=$request->validate([
            'original_amt'=>'required',
            'coupon_id' =>'required',
            'coupen_type' =>'required',
            'discount' =>'required',
            'discounted_amt' =>'required'
        ]);
        $couponId=decrypt($validated['coupon_id']);
        $couponType=decrypt($validated['coupen_type']);
        $discount=decrypt($validated['discount']);

        $order_data=array(
            'original_amount'=>$validated['original_amt'],
            'discounted_amount'=>$validated['discounted_amt'],
            'coupon_id'=>$couponId,
            'coupen_type'=>$couponType,
            'discount'=>$discount,
            'created_by'=>auth()->guard('customer')->user()->id,
            'order_date'=>date('Y-m-d H:i:s'),
            'payment_status'=>2
        );

        $order=Order::create($order_data);

        if($order)
        {
            return redirect()->route('success');
        }
        return redirect()->route('not');
    }
    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validated=$request->validate([
                'name' =>'required',
                'phone' =>'required|unique:customers,phone',
                'password' =>'required'
            ]);

            $ins_arr=array(
                'name' =>$validated['name'],
                'phone' =>$validated['phone'],
                'password' =>bcrypt($validated['password']),
                
            );

            Customer::create($ins_arr);

            if(auth()->guard('customer')->attempt(['phone'=>$validated['phone'],'password'=>$validated['password']]))
            {
                 return redirect()->route('customer.dashbord')->with('success','You are registerd successfully');
            }

            return redirect()->route('customer.register')->with('danger','Something went wrong.Please try again.');
            
        }
        return view('customer_register');
    }
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $credentials=array(
                'phone'=>$request->phone,
                'password' =>$request->password
            );

            if(auth()->guard('customer')->attempt($credentials))
            {
                return redirect()->route('customer.dashbord');
            }else{
                return redirect()->route('customer.login')->with('danger','Invalid credentials');
            }
        }
        return view('customer_login');
    }
    public function logout()
    {
        auth()->guard('customer')->logout();

        return redirect()->route('customer.login');
    }
}
