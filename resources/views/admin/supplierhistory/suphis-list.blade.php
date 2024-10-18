@extends('admin.master')

@section('content')
<div class="container mt-5 hunglo0">
    <h1 class="mb-4 ">Supply History</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success ">
            {{ $message }}
        </div>
    @endif

    <div class="container mt-5">

    <table class="table table-bordered hunglo table-striped">
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Nhân viên nhập kho</th> <!-- Thay đổi tiêu đề -->
                <th>Product</th>
                <th>Quantity</th>
                <!-- <th>Price</th>
                <th>Date</th>
                <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($supplyHistories as $history)
                <tr>
                    <td>{{ $history->supplier->SupplierName }}</td>
                    <td>{{ $history->employee->FirstName }} {{ $history->employee->LastName }}</td> <!-- Thay Order bằng Employee -->
                    <td>{{ $history->product->ProductName }}</td>
                    <td>{{ $history->Quantity }}</td>
                    <!-- <td>
                        <a href="{{ route('supply-history.edit', $history->SupplyID) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('supply-history.destroy', $history->SupplyID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td> -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Thêm phân trang ở dưới bảng -->
</div>

</div>
@endsection
