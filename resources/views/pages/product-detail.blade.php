@extends('layouts.master')
@section('content')	
<div class="productDetail__container">
    <div class="productDetail__container__menu">
        <a href="">Menu</a>
        <span>/</span>
        <a href="">loại</a>
        <span>/</span>
        <span >cafe</span>
    </div>
    <div class="productDetail__container__content">
        <div class="productDetail__container__content__img">
            <img src="{{ asset('images/' . $product->ImageURL) }}">
        </div>
        <div class="productDetail__container__content__infor">
            <div class="productDetail__container__content__infor__name">
                <h3>{{ $product->ProductName }}</h3>
            </div>
            <div class="productDetail__container__content__infor__price">
                <span>{{ $product->Price }} đ</span>
            </div>
            <div class="productDetail__container__content__infor__stock">
                <span> Số lượng còn lại:</span>
                <span>{{ $product->Stock }}</span>
            </div>
            <div class="productDetail__container__content__infor__addcart">
                <a href="{{ route('banhang.addtocart',$product->ProductID) }}">
                    <button type="submit">Thêm vào giỏ hàng</button>
                </a>
            </div>
            <div class="productDetail__container__content__infor__buy">
                <a href="{{ route('page.getdathang') }}">
                    <button type="submit">Mua ngay</button>
                </a>
            </div>
        </div>
    </div>
    <div class="productDetail__container__description">
         <p> Mô tả sẩn phẩm </p> 
         <p> {{ $product->Description }}</p>
    </div>
</div>
    
@endsection