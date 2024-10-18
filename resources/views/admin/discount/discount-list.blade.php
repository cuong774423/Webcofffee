@extends('admin.master')

@section('content')
    <div class="container hunglo0">
        <h2>Danh sách mã giảm giá</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('discounts.create') }}" class="btn btn-primary mb-3 btn_counpon ">Thêm mã giảm giá</a>
        <table class="table table-bordered  ">
            <thead>
                <tr>
                    <th>Mã giảm giá</th>
                    <th>Mô tả</th>
                    <th>Số tiền giảm</th>
                    <th>Số lần dùng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Sản phẩm áp dụng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $discount->DiscountCode }}</td>
                        <td>{{ $discount->Description }}</td>
                        <td>{{ number_format($discount->DiscountAmount, 2) }}đ</td>
                        <td>{{ $discount->UsageCount }}</td>
                        <td>{{ $discount->StartDate }}</td>
                        <td>{{ $discount->EndDate }}</td>
                        <td>{{ $discount->product ? $discount->product->ProductName : 'Tất cả sản phẩm' }}</td>
                        <td>
                            <a href="{{ route('discounts.edit', $discount->DiscountID) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('discounts.destroy', $discount->DiscountID) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $discounts->links() }}
    </div>
@endsection
