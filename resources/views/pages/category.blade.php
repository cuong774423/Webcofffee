@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
@endsection
@section('content')	
<div class="category_content">
    <div class="category_banner">
        <div class="category_box">
            <div class="category_title">
                <h3>{{ $category->CategoryName }}</h3>       
            </div>
            <div class="category_link">
                <a href="{{ route('pages.index') }}">
                    Trang chủ
                </a>
                <span> / <span>
                <span>
                    {{ $category->CategoryName }}
                </span>
            </div>
        </div>
    </div>
    <div class="product-container">
    @foreach ($products as $product)
        <div class="product-card">
            <a href="{{ route('page.product', $product->ProductID) }}">
                <img src="{{ asset('images/' . $product->ImageURL) }}" alt="">
            </a>
            <a href="{{ route('page.product', $product->ProductID) }}">
                <h2>{{ $product->ProductName }}</h2>
            </a>
                <span>{{ $product->Price }}đ</span>
                <a class="add-to-cart pull-left" href="{{ route('banhang.addtocart',$product->ProductID) }}"><i class="fa fa-shopping-cart"></i></a>
        </div>
    @endforeach
</div>
</div>

@endsection