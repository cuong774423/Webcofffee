@extends('admin.master')

@section('content')
<div id="page-wrapper hunglo0">
    <div class="container-fluid hunglo0">
        <div class="row =">
            <div class="col-lg-12">
                <h1 class="page-header">Add Supply History</h1>
            </div>
        </div>
        <div class="row =">
            <div class="col-lg-12">
                <form action="{{ route('supply-history.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="SupplierID">Supplier</label>
                        <select class="form-control" name="SupplierID" id="SupplierID">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->SupplierID }}">{{ $supplier->SupplierName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="WarehouseInEmployeeID">Nhân viên nhập kho</label>
                        <select class="form-control" name="WarehouseInEmployeeID" id="WarehouseInEmployeeID">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->EmployeeID }}">{{ $employee->FirstName }} {{ $employee->LastName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ProductID">Product</label>
                        <select class="form-control" name="ProductID" id="ProductID">
                            @foreach ($products as $product)
                                <option value="{{ $product->ProductID }}">{{ $product->ProductName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Quantity">Quantity</label>
                        <input class="form-control" name="Quantity" type="number" required>
                    </div>
                    <div class="form-group">
                        <label for="DeliveryDate">Delivery Date</label>
                        <input class="form-control" name="DeliveryDate" type="date" required>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" name="Status" id="Status">
                            <option value="Delivered">Delivered</option>
                            <option value="Pending">Pending</option>
                            <option value="Delayed">Delayed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Supply History</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
