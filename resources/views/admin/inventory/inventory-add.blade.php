@extends('admin.master')

@section('content')
<div class="container hunglo0">
    <h2>Add New Inventory</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('inventories.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="ProductID">Product</label>
                    <select id="ProductID" name="ProductID" class="form-control">
                        @foreach($products as $product)
                            <option value="{{ $product->ProductID }}">{{ $product->ProductName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="SupplierID">Supplier</label>
                    <select id="SupplierID" name="SupplierID" class="form-control">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->SupplierID }}">{{ $supplier->SupplierName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="TotalStock">Total Stock</label>
                    <input type="number" name="Quantity" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('inventories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
