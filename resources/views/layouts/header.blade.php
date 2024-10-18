<header>
<div class="navbar">
    <div class="logo">
        <a href="{{ route('pages.index') }}">COFFEE DA DEN</a>
    </div>
    <nav class="menu">
        <li>
             <a href="#">Cà phê</a>
        </li>
        <li>   
            <a href="#">Trà</a>
        </li>
        <li class="dropdown-list"> 
        <a href="#" class="dropdown_menu">Menu</a>
            <ul class="cate-list">
                @foreach($cates as $cate)
                        <li><a href="{{ route('page.category', ['id' => $cate->CategoryID]) }}">{{ $cate->CategoryName }}</a></li>
                        <hr class="hr_dropdown">
                @endforeach
            </ul>  
        </li> 
        <li>       
            <a href="#">Cửa hàng</a></li>    
        </li>
        <li> 
             <a href="{{ route('contact.view') }}">Liên hệ</a>
        </li>
        @if(Auth::check())
            <a href="#"><i class="fa fa-user"></i>Chào bạn {{ Auth::user()->Username }}</a>
            <a href="{{ route('getLogout') }} "></i>Đăng xuất</a>
        @else
            <a href="{{ route('getLogin') }}">Đăng nhập</a>
        @endif
    </nav>
    <div class="cart__container">
        <div class="cart__container__menu">
            <i class="fa fa-shopping-cart"></i>
            <span> Giỏ hàng 
            (@if(Session::has('cart')) {{ Session('cart')->totalQty }}
            @else Trống @endif)</span>
            <i class="fa fa-chevron-down"></i>
        </div>
        @if(Session::has('cart') && Session('cart')->totalQty > 0)
            <div class="cart__body">
                <div class="cart__container__body">
                    @foreach($productCarts as $product)
                    <div class="cart__container__body__box">
                        <div class="cart__container__body__box__item">
                            <div class="cart__container__body__box__item__img">
                                <img src="images/{{ $product['item']['ImageURL'] }}" alt="">
                            </div>
                            <div class="cart__container__body__box__item__nameprice">
                                <span >{{ $product['item']['ProductName'] }}</span>
                                <span > Số lượng: {{ $product['qty'] }}  </span>
                                <span> Đơn giá: {{ number_format($product['item']['Price']) }}đ </span>
                            </div>
                        </div>
                        <div class="cart__container__body__box__delete">
                            <a href="{{ route('page.xoagiohang',$product['item']['ProductID']) }}">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="cart__container__body__hr">
                            <hr>
                        </div>
                    @endforeach
                    <div class="cart__container__body__end">
                        <div class="cart__container__body__total">
                            <span> Tổng tiền: </span>
                            <span> {{ number_format($totalPrice) }}đ</span>
                        </div>
                        <div class="cart__container__body__ordercart">
                            <a href="{{ route('cart.index') }}" class="beta-btn primary text-center">Xem giỏ hàng</a>
                            <a href="{{ route('page.getdathang') }}" class="beta-btn primary text-center">Đặt hàng</a>
                        </div>
                    </div>
                
                </div>
            </div>
            
        @endif
    </div>
</div>

<script>
document.querySelector('.cart__container__menu').addEventListener('click', function() {
    // Toggle class 'active' khi nhấn vào giỏ hàng
    document.querySelector('.cart__container').classList.toggle('active');
});
</script>

</header>
<div class="navbar_fake">
     
</div>
