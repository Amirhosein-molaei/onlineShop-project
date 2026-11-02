<?php

namespace App\Http\Controllers\Home\Customer;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    public function index(Request $request, $order_status = null)
    {
        if (isset($order_status)) {
            if (in_array($order_status, [0,1,2,3,4])) {
                $orders = Order::where('user_id', Auth::user()->id)->where('order_status', $order_status)->with('items.product')->latest()->get();

                $filtered = 1;
                return view('app.profile.my-orders', compact('orders', 'filtered'));
            } else {
                return redirect()->back()->with('error', 'خطای کاربر');
            }
        } else {
            $orders = Order::where('user_id', Auth::user()->id)->with('items.product')->latest()->get();
        }
        return view('app.profile.my-orders', compact('orders'));

    }
}
 