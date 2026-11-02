<?php

namespace App\Http\Controllers\Home;

use App\Models\Market\Cart;
use App\Models\Market\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\Copan;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 0)->with('items.product')->first();

        $deliveries = Delivery::all();
        if (!$cart or $cart->items->isEmpty()) {
            return redirect()->route('home');
        }

        return view('app.checkout', compact('cart', 'deliveries'));
    }
    
    public function applyDiscount(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 0)->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'سبد خرید یافت نشد');
        }
        
        $copan = Copan::where('code', $request->code)->first();
        
        if (!$copan or !$copan->isValid()) {
            return redirect()->back()->with('error', 'کد تخفیف نامعتبر است');
        }
        
        $discountAmount = $copan->amount_type == 0 ? min(($cart->total_price * $copan->amount / 100), $copan->discount_ceiling) : min($copan->amount, $cart->total_price);
        
        $cart->update([
            'copan_id' => $copan->id,
            'discount_status' => 1,
            'total_off_price' => $discountAmount
        ]);
        
        return redirect()->back()->with('success', 'کد تخفیف با موفقیت اعمال شد');
    }
    
}
