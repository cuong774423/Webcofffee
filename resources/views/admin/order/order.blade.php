@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách đơn hàng</h1>
            </div>
            <!-- /.col-lg-12 -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>ID Khách hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $order->OrderID }}</td>
                        <td>{{ $order->customer_id }}</td>
                        <td>{{ $order->OrderDate  }}</td>
                        <td>{{ $order->TotalAmount }}</td>
                        <td>{{ $order->Status  }}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('orders.edit', $order->OrderID) }}">Chỉnh sửa trạng thái</a></td>
                        <td>
                            <a href="{{ route('orders.show', $order->OrderID) }}" class="btn btn-info">Xem</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
