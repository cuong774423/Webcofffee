@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    </style>
@endsection
@section('content')
    <div class="checkout_container">
    <form class="checkout_content" action="{{ route('page.postdathang') }}" method="post">
            @csrf
        <div class="checkout_content_item1">
            
                <div class="checkout_item1">
                    <h3>Thông tin thanh toán</h3>
                </div>
                <div class="checkout_item1">
                    <label>Họ và tên *</label>
                    <input type="text" id="name" placeholder="Họ tên" name="name" required>
                </div>
                <div class="checkout_item1">
                    <label>Giới tính </label>
                    <div class="checkbox_gender">
                    <input id="gender" type="radio"  name="gender" value="Nam" checked="checked">
                    <span>Nam</span>
                    </div>
                    <div class="checkbox_gender">
                    <input id="gender" type="radio"  name="gender" value="Nữ" >
                    <span>Nữ</span>  
                    </div>           
                </div>
                <div class="checkout_item1">
                    <label for="email">Email*</label>
                    <input type="email" required placeholder="Emai của bạn" name="email">           
                </div>
                <div class="checkout_item1">
                    <label for="adress">Địa chỉ*</label>
                    <input type="text" id="adress" placeholder="Địa chỉ" name="address" required>        
                </div>
                <div class="checkout_item1">
                    <label for="phone">Điện thoại*</label>
                    <input type="numer" id="phone" placeholder="Số điện thoại" name="phone_number" required>          
                </div>
                <div class="checkout_item1">
                    <label for="notes">Ghi chú</label>
                    <textarea type="text" rows="6" cols="80" placeholder="Tin nhắn" id="notes" name="notes"></textarea>        
                </div>
          
        </div>

        <div class="checkout_content_item2">
            <div class="checkout_item2">
                <h3>Đơn hàng của bạn</h3>
            </div>
            <div class="checkout_item2 checkout_product1">
                <span>Sản phẩm</span>
                <span>Tạm tính</span>
            </div>
                    @if(Session::has('cart'))
            @foreach($productCarts as $product)
            <div class="checkout_item2 checkout_product2">
                <span>{{ $product['item']['ProductName'] }} x {{ $product['qty'] }}</span>
                <span>
                    <!-- Hiển thị giá sản phẩm sau khi áp dụng giảm giá -->
                    {{ number_format($product['item']['Price']) }}đ
                </span>
            </div>
            @endforeach
            <div class="checkout_item2 checkout_product1">
                <span>Tổng</span>
                <span>{{ number_format($totalPrice) }}đ</span>
            </div>
            @endif
            <div class="order">
                <ul class="payment_methods methods">
                    <li class="payment_method_bacs">
                        <input style="margin: 5px 0" id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                        <div class="payment_box payment_method_bacs" style="display: block;">
                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                        </div>                        
                    </li>

                    <li class="payment_method_cheque">
                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                        <label for="payment_method_cheque">Chuyển khoản </label>
                        <div class="payment_box payment_method_cheque" style="display: none;">
                            Chuyển tiền đến tài khoản sau:
                            <br>- Số tài khoản: 123 456 789
                            <br>- Chủ TK: Cuongprovip
                            <br>- Ngân hàng TECHCOMBANNK, Chi nhánh TPHCM
                        </div>                        
                    </li>

                                   
                    <li class="payment_method_cheque">
                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="VNPAY" data-order_button_text="">
                        <label for="payment_method_cheque">Thanh toán online</label>
                    </li>
                                                                       
                </ul>
            </div>
                <div class="order_btn">
                        <button type="submit">
                            Đặt hàng 
                        </button>
                </div>
        </div>
        </form>

    </div>
@endsection
