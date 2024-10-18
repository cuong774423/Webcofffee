@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Shipment
                    <small>List</small>
                </h1>
            </div>

            <!-- Hiển thị thông báo thành công nếu có -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Bảng hiển thị lô hàng -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Ngày giao hàng</th>
                        <th>Ghi chú</th>
                        <th>Nhân viên kho hàng</th>
                        <th>Chỉnh Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $shipment)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $shipment->ShipmentID }}</td>
                        <!-- Hiển thị tên sản phẩm nếu có, nếu không thì "N/A" -->
                        <td>{{ $shipment->product ? $shipment->product->ProductName : 'N/A' }}</td>
                        <td>{{ $shipment->Quantity }}</td>
                        <td>{{ $shipment->ShipmentDate }}</td>
                        <td>{{ $shipment->Notes }}</td>
                        <!-- Hiển thị tên nhân viên xuất kho nếu có, nếu không thì "N/A" -->
                        <td>{{ $shipment->employee ? $shipment->employee->FirstName . ' ' . $shipment->employee->LastName : 'N/A' }}</td>

                        <!-- Nút chỉnh sửa -->
                        <td>
                            <a href="{{ route('shipments.edit', $shipment->ShipmentID) }}" class="btn btn-warning">Edit</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
