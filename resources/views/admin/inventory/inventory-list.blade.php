@extends('admin.master')

@section('content')
<div class="container mt-5 hunglo0">
    <h1 class="mb-4">Inventory List</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <a href="{{ route('inventories.create') }}" class="btn btn-primary mb-3">Add New Inventory</a>

    <table class="table table-bordered hunglo table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Product</th>
                <th>Supplier</th>
                <th>Total Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inventory->product->ProductName }}</td>
                    <td>{{ optional($inventory->supplier)->SupplierName }}</td>
                    <td>{{ $inventory->Quantity }}</td>
                    <td>
                        <a href="{{ route('inventories.edit', $inventory->InventoryID) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('inventories.destroy', $inventory->InventoryID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
    {{ $inventories->links() }}
</div>
</div>
@endsection
