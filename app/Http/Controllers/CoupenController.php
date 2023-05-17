<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CoupenController extends Controller
{
    public function index()
    {
        $data['results'] =Coupon::where('status',1)->orderBy('id','DESC')->paginate(10);
        
        return view('mngr.coupen.index',$data);
    }
    public function add(Request $request)
    {
        if($request->isMethod('post'))
        {
            $validated=$request->validate([
                'coupon' =>'required|unique:coupons,coupon',
                'coupon_type' =>'required',
                'valid_from' =>'required',
                'valid_to' =>'required'
            ]);

            if($validated['coupon_type'])
            {
                if(empty($request->fixed_amt) && empty($request->percent_amt))
                {
                    return redirect()->route('coupon.add')->with('danger','Coupen type value is missing');
                }
            }

            $ins_arr=array(
                'coupon' =>$validated['coupon'],
                'coupon_type' =>$validated['coupon_type'],
                'type_val_fixed' =>$request->fixed_amt,
                'type_val_percent' =>$request->percent_amt,
                'valid_from' =>$validated['valid_from'],
                'valid_to' =>$validated['valid_to'],
                'created_by' =>auth()->user()->id
            );

            Coupon::create($ins_arr);

            return redirect()->route('coupons')->with('success','New coupon created successfully');
        }
        $data['random_coupen']=$this->generateCouponCode(20);
        return view('mngr.coupen.add',$data);
    }

    public function view($id)
    {
        $couponId=decrypt($id);
        $data['view_data'] =Coupon::find($couponId);

        return view('mngr.coupen.view',$data);
    }

    public function edit(Request $request,$id)
    {
        $couponId=decrypt($id);
        $edit_data=Coupon::find($couponId);

        if($request->isMethod('post'))
        {
            $validated=$request->validate([
                'coupon' =>'required',
                'coupon_type' =>'required',
                'valid_from' =>'required',
                'valid_to' =>'required'
            ]);

            if($validated['coupon'])
            {
                if($edit_data->coupon != $validated['coupon'])
                {
                    return redirect()->route('coupon.edit',encrypt($couponId))->with('danger','You cannot change the coupon');
                }
            }

            if($validated['coupon_type'])
            {
                if(empty($request->fixed_amt) && empty($request->percent_amt))
                {
                    return redirect()->route('coupon.edit',encrypt($couponId))->with('danger','Coupen type value is missing');
                }else{
                    if(!empty($request->fixed_amt))
                    {
                        $edit_data->type_val_fixed =$request->fixed_amt;
                        $edit_data->type_val_percent =NULL;
                    }else{
                        $edit_data->type_val_fixed =NULL;
                        $edit_data->type_val_percent =$request->percent_amt;
                    }
                }
            }

            $edit_data->coupon_type =$validated['coupon_type'];
            $edit_data->valid_from =$validated['valid_from'];
            $edit_data->valid_to =$validated['valid_to'];
            $edit_data->save();

            return redirect()->route('coupons')->with('success','Coupon updated successfully');
        }

        $data['edit_data']=$edit_data;
        return view('mngr.coupen.edit',$data);
    }

    public function generateCouponCode($length = 8) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $couponCode = '';
    
        for ($i = 0; $i < $length; $i++) {
            $couponCode .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $couponCode;
    }
}
