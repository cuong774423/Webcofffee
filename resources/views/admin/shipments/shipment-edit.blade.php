@extends('admin.master')

@section('content')
    <h1>Edit Shipment</h1>

    <form class="hunglo0" action="{{ route('shipments.update', $shipment->ShipmentID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="ProductID">Product</label>
            <select name="ProductID" class="form-control">
                @foreach ($products as $product) <!-- Giả sử bạn đã truyền $products từ controller -->
                    <option value="{{ $product->ProductID }}" {{ $shipment->ProductID == $product->ProductID ? 'selected' : '' }}>
                        {{ $product->ProductName }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="Quantity">Quantity</label>
            <input type="number" name="Quantity" class="form-control" value="{{ $shipment->Quantity }}" required>
        </div>

        <div class="form-group">
            <label for="ShipmentDate">Shipment Date</label>
            <input type="date" name="ShipmentDate" class="form-control" value="{{ $shipment->ShipmentDate }}" required>
        </div>

        <div class="form-group">
            <label for="Notes">Notes</label>
            <textarea name="Notes" class="form-control">{{ $shipment->Notes }}</textarea>
        </div>

        <div class="form-group">
            <label for="WarehouseOutEmployeeID">Warehouse Out Employee</label>
            <select name="WarehouseOutEmployeeID" class="form-control" required>
                @foreach ($employees as $employee) <!-- Giả sử bạn đã truyền $employees từ controller -->
                    <option value="{{ $employee->EmployeeID }}">
                        {{ $employee->FirstName }} {{ $employee->LastName }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
