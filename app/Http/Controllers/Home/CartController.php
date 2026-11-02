<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Market\Cart;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 0)->with('items.product')->first();
        return view('app.cart', compact('cart', 'cart'));

    }
    
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 0],
            ['total_price' => 0, 'total_off_price' => 0, 'expired_at' => now()->addDays(7)]
        );
        
        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();
        
        if ($cartItem) {
            if ($cartItem->quantity + 1 <= $product->marketable_number) {
                $cartItem->increment('quantity');
                $cartItem->update(['total_price' => $cartItem->quantity * $product->price]);
            } else {
                return redirect()->back()->with('error', 'موجودی محصول کافی نیست.');
            }
        } else {
            if ($product->marketable_number >= 1) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'total_price' => $product->price
                ]);
            } else {
                return redirect()->back()->with('error', 'موجودی محصول کافی نیست.');            
            }
        }
        
        $totalPrice = CartItem::where('cart_id', $cart->id)->sum('total_price');
        $cart->update(['total_price' => $totalPrice]);

        return redirect()->back()->with('success', 'محصول به سبد خرید اضافه شد');
    }

    public function decreaseItem($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
            $cartItem->update(['total_price' => $cartItem->quantity * $cartItem->product->price]);
        } else {
            $this->removeFromCart($id);
            return redirect()->back()->with('success', 'محصول با موفقیت حذف شد');
        }
        
        $this->updateCartTotal($cartItem->cart);
        return redirect()->back();
    }

    private function updateCartTotal($cart)
    {
        $totalPrice = $cart->items()->sum('total_price');
        $cart->update(['total_price' => $totalPrice]);
    }
    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = $cartItem->cart;

        $cartItem->delete();
        $this->updateCartTotal($cart);
        return redirect()->back()->with('success', 'محصول با موفقیت حذف شد');
    }

}
