@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
@endsection
@section('content')    

<div class="cart_content">
    <div class="cart_content_item1">
        @if(Session::has('cart') && count($productCarts) > 0)
        <form id="cart-form" action="{{ route('updateCart') }}" method="post">
            @csrf
            <table>
                <tr class="cart_th">
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tạm tính</th>
                </tr>
                @foreach($productCarts as $product)
                <tr class="cart_td">
                    <td>
                        <div class="cart_product">
                            <div class="cart__container__body__box__delete">
                                <a href="{{ route('cart.xoagiohang',$product['item']['ProductID']) }}"><i class="fa fa-times"></i>
                                </a>
                            </div>
                            <a href="#"><img src="images/{{ $product['item']['ImageURL'] }}" alt=""></a>
                            <span class="cart-item-title">{{ $product['item']['ProductName'] }}</span>
                        </div>
                    </td>
                    <td>
                        <span>
                                {{ number_format($product['item']['Price']) }}đ
                        </span>
                    </td>
                    <td>
                        <div class="quantity-control">
                            <button type="button" class="quantity-decrease" data-id="{{ $product['item']['ProductID'] }}">-</button>
                            <input type="number" name="quantities[{{ $product['item']['ProductID'] }}]" value="{{ $product['qty'] }}" min="1">
                            <button type="button" class="quantity-increase" data-id="{{ $product['item']['ProductID'] }}">+</button>
                        </div>
                    </td>
                    <td>
                        <span class="cart-total-value">{{ number_format($product['item']['Price'] * $product['qty']) }}đ</span>
                    </td>
                </tr>  
                @endforeach
            </table>
            <button type="submit" class="update-cart-button">Cập nhật giỏ hàng</button>
            <span class="cart_sum">Tổng tiền: {{ number_format($totalPrice) }}đ</span>
        </form>
        @else
            <!-- Hiển thị thông báo khi giỏ hàng trống -->
            <p>Giỏ hàng của bạn hiện đang trống.</p>
        @endif
        <br>
        @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
   
    </div>
    @if(Session::has('cart') && count($productCarts) > 0)
    <div class="cart_content_item2">
        <div class="cart_item2">
            <span>Cộng giỏ hàng</span>
        </div>
            <div class="cart_item2 cart_sum1">
            <span>Tổng</span>
            <span>{{ number_format($totalPrice) }}đ</span> <!-- Sử dụng tổng tiền mới -->
        </div>
        <div class="cart_item2 cart_sum2">
            <span>Tổng sau giảm giá</span>
            <span>{{ number_format($cart->totalPrice ?? $totalPrice) }}đ</span> <!-- Hiển thị tổng tiền sau giảm giá -->
        </div>
        <div class="cart_item2">
            <a href="{{ route('page.getdathang') }}">
                <button type="button">
                    Tiến hành thanh toán
                </button>
            </a>
        </div>
        <div class="counpon__container">
            <form action="{{ route('apply.discount') }}" method="post">
                    @csrf
                    <div class="coupon_title">
                        <i class="fa-solid fa-tag"></i>
                        <span>Phiếu ưu đãi</span>
                    </div>
                    <div class="coupon_code">
                        <input type="text" name="coupons" placeholder="Mã ưu đãi" id="couponCode">
                    </div>
                    <div class="coupon_btn">
                        <button type="submit" id="applyCouponBtn">
                            Áp dụng
                        </button>
                    </div>
                    </form>
        </div>
    </div>
    @else
    <div class="cart_content_item2">
        <div class="cart_item2">
            <span>Cộng giỏ hàng</span>
        </div>
            <div class="cart_item2 cart_sum1">
            <span>Tổng</span>
            <span>0đ</span> <!-- Sử dụng tổng tiền mới -->
        </div>
        <div class="cart_item2 cart_sum2">
            <span>Tổng sau giảm giá</span>
            <span>0đ</span> <!-- Hiển thị tổng tiền sau giảm giá -->
        </div>
        <div class="cart_item2">
            <a href="{{ route('page.getdathang') }}">
                <button type="button">
                    Tiến hành thanh toán
                </button>
            </a>
        </div>
        <div class="counpon__container">
            <form action="{{ route('apply.discount') }}" method="post">
                    @csrf
                    <div class="coupon_title">
                        <i class="fa-solid fa-tag"></i>
                        <span>Phiếu ưu đãi</span>
                    </div>
                    <div class="coupon_code">
                        <input type="text" name="coupons" placeholder="Mã ưu đãi" id="couponCode">
                    </div>
                    <div class="coupon_btn">
                        <button type="submit" id="applyCouponBtn">
                            Áp dụng
                        </button>
                    </div>
                    </form>
        </div>
    </div>
        @endif
</div>

<script>
document.querySelectorAll('.quantity-decrease').forEach(button => {
    button.addEventListener('click', function() {
        let input = this.nextElementSibling;
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
        }
    });
});

document.querySelectorAll('.quantity-increase').forEach(button => {
    button.addEventListener('click', function() {
        let input = this.previousElementSibling;
        input.value = parseInt(input.value) + 1;
    });
});
</script>

@endsection
