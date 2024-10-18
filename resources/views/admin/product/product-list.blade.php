@extends('admin.master')
@section('content')
<div class="container mt-5">    

    @if ($message = Session::get('success'))
        <div class="alert alert-success productsucces">
            {{ $message }}
        </div>
    @endif

     <!-- Form tìm kiếm theo tên sản phẩm -->
     <form action="{{ route('products.index') }}" method="GET" class="mb-3">
    <div class="row hunglo0">
        <!-- Phần tìm kiếm từ khóa -->
        <div class="col-md-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm..." value="{{ request()->search }}">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>

        <!-- Phần lọc theo danh mục -->
        <div class="col-md-6 hunglo">
            <div class="input-group mb-3">
                <select name="category" class="form-control">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->CategoryID }}" {{ request()->category == $category->CategoryID ? 'selected' : '' }}>
                            {{ $category->CategoryName }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-secondary" type="submit">Lọc theo danh mục</button>
            </div>
        </div>
    </div>
</form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CategoryID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->ProductID }}</td>
                    <td>{{ $product->CategoryID }}</td>
                    <td class="text-center">
                        @if(isset($product->ImageURL) && $product->ImageURL)
                            <img src="{{ asset('images/' . $product->ImageURL) }}" alt="{{ $product->ProductName }}" width="100" class="img-thumbnail">
                        @else
                            <span>No image</span>
                        @endif
                    </td>
                    <td>{{ $product->ProductName }}</td>
                    <td>{{ $product->Description }}</td>
                    <td>${{ number_format($product->Price, 2) }}</td>
                    <td>{{ $product->Stock }}</td>
                    <td class="text-center">
                        <a href="{{ route('products.edit', $product->ProductID) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->ProductID) }}" method="POST" class="d-inline">
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

    <!-- Thêm liên kết phân trang -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
