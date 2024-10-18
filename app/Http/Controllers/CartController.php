<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.cart', compact('products'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);

        $request->session()->put('cart', $cart);

        
        return redirect()->route('cart.index');
    }
    
    public function delCartItem($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else Session::forget('cart');
        return redirect()->back();
    }


    // Hàm giảm số lượng sản phẩm trong giỏ hàng
    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('cart.index');
    }

    public function showCart()
    {
        $cart = Session::has('cart') ? Session::get('cart') : null;
        $productCarts = $cart ? $cart->items : [];
        $totalPrice = $cart ? $cart->totalPrice : 0;

        return view('cart.index', compact('productCarts', 'totalPrice'));
    }

    // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
    
        $quantities = $request->input('quantities');
    
        // Kiểm tra và cập nhật số lượng sản phẩm
        foreach ($quantities as $id => $qty) {
            if ($qty > 0) {
                $product = Product::find($id);
                if ($product) {
                    $cart->items[$id]['qty'] = $qty;
                    $cart->items[$id]['price'] = ($product->Price) * $qty;
                }
            } else {
                unset($cart->items[$id]);
            }
        }
    
        // Kiểm tra nếu giỏ hàng rỗng thì xóa khỏi session
        if (count($cart->items) > 0) {
            $cart->totalQty = 0;
            $cart->totalPrice = 0;
    
            // Lấy mã giảm giá từ session nếu có
            $discountCode = Session::get('DiscountCode');
            $discount = null;
            if ($discountCode) {
                $discount = Discount::where('DiscountCode', $discountCode)->first();
            }
    
            // Lặp qua các sản phẩm trong giỏ hàng và cập nhật giá
            foreach ($cart->items as $key => $item) {
                $itemPrice = $item['price'];
    
                // Nếu có mã giảm giá và sản phẩm này nằm trong danh sách sản phẩm được giảm giá
                if ($discount && $item['item']['ProductID'] == $discount->ProductID) {
                    $itemPrice = max($itemPrice - $discount->DiscountAmount * $item['qty'], 0); // Áp dụng giảm giá
                }
    
                $cart->items[$key]['price'] = $itemPrice;
                $cart->totalQty += $item['qty'];
                $cart->totalPrice += $itemPrice;
            }
    
            // Cập nhật giỏ hàng trong session
            Session::put('cart', $cart);
        } else {
            // Xóa giỏ hàng khỏi session nếu không còn sản phẩm
            Session::forget('cart');
        }
    
        return redirect()->route('cart.index');
    }    
    
}

