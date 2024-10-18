@extends('admin.master')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Suppliers</h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success productsucces ">
            {{ $message }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Contact Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->SupplierName }}</td>
                    <td>{{ $supplier->ContactName }}</td>
                    <td>{{ $supplier->Address }}</td>
                    <td>{{ $supplier->PhoneNumber }}</td>
                    <td>{{ $supplier->Email }}</td>
                    <td class="text-center">
                        <a href="{{ route('suppliers.edit', $supplier->SupplierID) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('suppliers.destroy', $supplier->SupplierID) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
