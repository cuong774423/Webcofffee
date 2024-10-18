@extends('admin.master')

@section('content')
<div id="page-wrapper ">
    <div class="container-fluid hunglo0">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Supply History</h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12">
                <form action="{{ route('supply-history.update', $supplyHistory->SupplyID) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="SupplierID">Supplier</label>
                        <select class="form-control" name="SupplierID" id="SupplierID">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->SupplierID }}" {{ $supplier->SupplierID == $supplyHistory->SupplierID ? 'selected' : '' }}>{{ $supplier->SupplierName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="WarehouseInEmployeeID">Nhân viên nhập kho</label>
                        <select class="form-control" name="WarehouseInEmployeeID" id="WarehouseInEmployeeID">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->EmployeeID }}" {{ $employee->EmployeeID == $supplyHistory->WarehouseInEmployeeID ? 'selected' : '' }}>{{ $employee->FirstName }} {{ $employee->LastName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ProductID">Product</label>
                        <select class="form-control" name="ProductID" id="ProductID">
                            @foreach ($products as $product)
                                <option value="{{ $product->ProductID }}" {{ $product->ProductID == $supplyHistory->ProductID ? 'selected' : '' }}>{{ $product->ProductName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Quantity">Quantity</label>
                        <input class="form-control" name="Quantity" type="number" value="{{ $supplyHistory->Quantity }}" required>
                    </div>
                    <div class="form-group">
                        <label for="DeliveryDate">Delivery Date</label>
                        <input class="form-control" name="DeliveryDate" type="date" value="{{ $supplyHistory->DeliveryDate }}" required>
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" name="Status" id="Status">
                            <option value="Delivered" {{ $supplyHistory->Status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="Pending" {{ $supplyHistory->Status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Delayed" {{ $supplyHistory->Status == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update Supply History</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
