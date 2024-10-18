@extends('admin.master')

@section('content')
    <div class="container hunglo0">
        <h2>Thêm mã giảm giá</h2><br>
        @if ($errors->any())
            <div class="alert alert-danger hunglo">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('discounts.store') }}" method="POST">
            @csrf
            <div class="mb-3  ">
                <label for="DiscountCode" class="form-label">Mã giảm giá</label>
                <input type="text" class="form-control" id="DiscountCode" name="DiscountCode" value="{{ old('DiscountCode') }}" required>
            </div>
            <div class="mb-3 ">
                <label for="Description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="Description" name="Description">{{ old('Description') }}</textarea>
            </div>
            <div class="mb-3 ">
                <label for="DiscountAmount" class="form-label">Số tiền giảm</label>
                <input type="number" class="form-control" id="DiscountAmount" name="DiscountAmount" value="{{ old('DiscountAmount') }}" required>
            </div>
            <div class="mb-3 ">
                <label for="StartDate" class="form-label">Ngày bắt đầu</label>
                <input type="date" class="form-control" id="StartDate" name="StartDate" value="{{ old('StartDate') }}" required>
            </div>
            <div class="mb-3 ">
                <label for="EndDate" class="form-label">Ngày kết thúc</label>
                <input type="date" class="form-control" id="EndDate" name="EndDate" value="{{ old('EndDate') }}" required>
            </div>
            <div class="mb-3 ">
                <label for="ProductID" class="form-label ">Sản phẩm áp dụng</label>
                <select class="form-control" id="ProductID" name="ProductID">
                    <option value="">Áp dụng cho tất cả sản phẩm</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->ProductID }}" {{ old('ProductID') == $product->ProductID ? 'selected' : '' }}>
                            {{ $product->ProductName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success ">Thêm mã giảm giá</button>
        </form>
    </div>
@endsection
