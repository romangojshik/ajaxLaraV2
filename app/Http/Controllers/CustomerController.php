<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::all();

        return view('customer', ['customers' => $customers]);
    }

    public function newCustomer(Request $request) {
        if($request->ajax())
        {
            $customer = Customer::create($request->all());

            return Response($customer);
//            return response()->json($customer);
        }
    }

    public function getUpdate(Request $request)
    {
        if($request->ajax())
        {
            $customer = Customer::find($request->id);

            return Response($customer);
        }
    }

    public function newUpdate(Request $request)
    {
        if($request->ajax())
        {
            $customer = Customer::find($request->id);
            $customer->first_name=$request->first_name;
            $customer->lasr_name=$request->last_name;
            $customer->sex=$request->sex;
            $customer->email=$request->email;
            $customer->phone=$request->phone;
            $customer->save();

            return Response($customer);
        }
    }

    public function deleteCustomer(Request $request)
    {
        if($request->ajax())
        {
            Customer::destroy($request->id);

            return Response()->json(['sms'=>'delete successfully']);
        }
    }

}
