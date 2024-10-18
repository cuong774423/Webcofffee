@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Product</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sửa sản phẩm
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('products.update', $product->ProductID) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Product Name</label>
                                <input class="form-control" name="ProductName" value="{{ $product->ProductName }}" placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="Description" rows="3">{{ $product->Description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="Price" value="{{ $product->Price }}" placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input class="form-control" name="Stock" value="{{ $product->Stock }}" placeholder="Enter stock quantity">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="CategoryID">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->CategoryID }}" {{ $category->CategoryID == $product->CategoryID ? 'selected' : '' }}>{{ $category->CategoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div>
                                    @if ($product->ImageURL)
                                        <img src="{{ asset('images/' . $product->ImageURL) }}" alt="{{ $product->ProductName }}" width="100">
                                    @else
                                        <p>No image found</p>
                                    @endif
                                </div>
                                <input type="file" class="form-control-file" name="ImageURL">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
