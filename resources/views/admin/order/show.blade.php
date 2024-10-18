@extends('admin.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('content')
    <div class="container hunglo0">
        <h1>Chi tiết đơn hàng #{{ $order->OrderID }}</h1>
        

        <p><strong>Khách hàng:</strong> {{ optional($order->customer)->name }}</p>
        <p><strong>Ngày đặt hàng:</strong> {{ $order->OrderDate }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->TotalAmount) }} VND</p>

        <h2>Sản phẩm đã mua</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order->orderDetails as $item)
                <tr>
                    <td>{{ optional($item->product)->ProductName }}</td>
                    <td>
                        <img src="{{ asset('images/' . $item->product->ImageURL) }}" alt="{{ optional($item->product)->ProductName }}" style="width: 100px; height: auto;">
                    </td>

                    <td>{{ $item->Quantity }}</td>
                    <td>{{ number_format($item->UnitPrice) }}</td>
                    <td>{{ number_format($item->Quantity * $item->UnitPrice) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
@endsection
