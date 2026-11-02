<?php

namespace App\Http\Controllers\Home;

use App\Models\Market\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use App\Models\Market\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'delivery_id' => 'required|exists:deliveries,id',
            'address_id' => 'required|exists:addresses,id'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 0)->with('items.product')->first();

        if (!$cart or $cart->items->isEmpty()) {
            return redirect()->route('home');
        }



        try {
            DB::beginTransaction();

            $delivery = Delivery::findOrFail($request->delivery_id);
            $address = $user->addresses->where('id', $request->address_id)->first();

            $order = Order::create([
                'user_id' => $user->id,
                'cart_id' => $cart->id,
                'copan_id' => $cart->copan_id,
                'delivery_id' => $delivery->id,
                'delivery_object' => json_encode($delivery),
                'delivery_amount' => $delivery->amount,
                'address_id' => $address->id,
                'address_object' => json_encode($address),
                'order_final_amount' => $cart->total_price - $cart->total_off_price,
                'order_discount_amount' => $cart->total_off_price,
                'order_total_discount' => $cart->total_off_price,
                'order_status' => 0,
                'payment_type' => 0,
                'payment_status' => 0,
                'delivery_status' => 0,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_object' => json_encode($item->product),
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'total_price' => $item->total_price,
                    'status' => 0
                ]);
            }

            $cart->update(['status' => 1]);
            DB::commit();
            return redirect()->route('home')->with('success', 'سفارش شما با موفقیت ثبت شد');

        } catch (\Throwable $th) {
            DB::rollBack();
            redirect()->back()->with('error', 'خطایی پیش آمد');
        }
    }
}
