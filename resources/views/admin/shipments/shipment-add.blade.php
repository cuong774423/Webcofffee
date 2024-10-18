@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Shipment</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form để thêm lô hàng mới -->
            <form action="{{ route('shipments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Product</label>
                    <select name="ProductID" class="form-control">
                        @foreach ($products as $product)
                            <option value="{{ $product->ProductID }}">{{ $product->ProductName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="Quantity" class="form-control" placeholder="Enter quantity">
                </div>

                <div class="form-group">
                    <label>Shipment Date</label>
                    <input type="date" name="ShipmentDate" class="form-control">
                </div>

                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="Notes" class="form-control" placeholder="Enter notes"></textarea>
                </div>

                <div class="form-group">
                    <label  for="WarehouseOutEmployeeID">Warehouse Out Employee</label>
                    <select name="WarehouseOutEmployeeID" id="WarehouseOUtEmployeeID" class="form-control">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->EmployeeID }}">{{ $employee->FirstName }} {{ $employee->LastName }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add Shipment</button>
            </form>
        </div>
    </div>
</div>
@endsection
