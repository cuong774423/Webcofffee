<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with('product')->paginate(10);
        return view('admin.discount.discount-list', compact('discounts'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.discount.discount-add', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'DiscountCode' => 'required|unique:discounts',
            'DiscountAmount' => 'required|numeric|min:0',
            'DiscountAmount' => 'required|numeric|min:0',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
            'ProductID' => 'nullable|exists:products,ProductID'
        ]);

        Discount::create($request->all());

        return redirect()->route('discounts.index')->with('success', 'Thêm mã giảm giá thành công.');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $products = Product::all();
        return view('admin.discount.discount-edit', compact('discount', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'DiscountCode' => 'required|unique:discounts,DiscountCode,'.$id.',DiscountID',
            'DiscountAmount' => 'required|numeric|min:0',
            'UsageCount' => 'required|numeric|min:0',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
            'ProductID' => 'nullable|exists:products,ProductID'
        ]);

        $discount = Discount::findOrFail($id);
        $discount->update($request->all());

        return redirect()->route('discounts.index')->with('success', 'Cập nhật mã giảm giá thành công.');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Xóa mã giảm giá thành công.');
    }
    public function applyDiscount(Request $request)
    {
                // Kiểm tra nếu người dùng chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('cart.index')->with('error', 'Bạn cần đăng nhập để áp dụng mã giảm giá.');
        }
        $request->validate([
            'coupons' => 'required|string|max:255',
        ]);
    
        $discountCode = $request->input('coupons');
        $cart = Session::has('cart') ? Session::get('cart') : null;
    
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }
    
        if (Session::has('DiscountCode') && Session::get('DiscountCode') == $discountCode) {
            return redirect()->route('cart.index')->with('error', 'Mã giảm giá này đã được áp dụng trước đó.');
        }

        // Lấy mã giảm giá từ cơ sở dữ liệu
        $discount = Discount::where('DiscountCode', $discountCode)
            ->where('StartDate', '<=', now())
            ->where('EndDate', '>=', now())
            ->first();
    
        if (!$discount) {
            return redirect()->route('cart.index')->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
        }
    
        // Kiểm tra số lần sử dụng
        if ($discount->UsageCount >= 1 ) { // Giới hạn là 1 lần sử dụng, bạn có thể thay đổi giá trị này
            return redirect()->route('cart.index')->with('error', 'Mã giảm giá đã được sử dụng hết.');
        }
    
        // Khởi tạo tổng tiền
        $totalPrice = 0;
        $discountAmount = $discount->DiscountAmount; // Lấy giá trị giảm giá
        $discountApplied = false; // Biến kiểm tra xem có sản phẩm nào được giảm giá hay không
    
        foreach ($cart->items as $key => $item) {
            // Tính giá sản phẩm gốc
            $itemPrice = $item['item']['Price'] * $item['qty'];
    
            // Kiểm tra xem sản phẩm có mã giảm giá không
            if ($item['item']['ProductID'] == $discount->ProductID) {
                // Nếu có mã giảm giá, cập nhật giá cho sản phẩm
                $discountedPrice = max($itemPrice - $discountAmount * $item['qty'], 0); // Đảm bảo giá không âm
                $item['price'] = $discountedPrice;
                $cart->items[$key]['discounted_price'] = $discountedPrice; // Lưu giá đã giảm vào giỏ hàng
                $discountApplied = true; // Đánh dấu là có sản phẩm được giảm giá
            } else {
                // Nếu không có mã giảm giá, giữ nguyên giá gốc
                $item['price'] = $itemPrice; 
            }
    
            // Cộng dồn tổng tiền
            $totalPrice += $item['price'];
            // Cập nhật giá sản phẩm trong giỏ hàng
            $cart->items[$key]['price'] = $item['price'];
        }
    
        // Kiểm tra nếu không có sản phẩm nào được giảm giá
        if (!$discountApplied) {
            return redirect()->route('cart.index')->with('error', 'Không có sản phẩm nào trong giỏ hàng áp dụng được mã giảm giá.');
        }
    
        // Lưu mã giảm giá vào session
        Session::put('DiscountCode', $discountCode);

        // Cập nhật tổng tiền trong giỏ hàng
        $cart->totalPrice = $totalPrice;

        // Cập nhật giỏ hàng trong session
        Session::put('cart', $cart);
    
        return redirect()->route('cart.index')->with('success', 'Áp dụng mã giảm giá thành công!');
    }
      
    
}