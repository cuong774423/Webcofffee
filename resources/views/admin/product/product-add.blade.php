@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Product</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Thêm sản phẩm mới
                    </div>
                    <div class="panel-body">
                        <!-- Hiển thị thông báo lỗi validation nếu có -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form role="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Product Name</label>
                                <input class="form-control" name="ProductName" placeholder="Enter product name">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="Description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="Price" placeholder="Enter price">
                            </div>
                            <div class="form-group">
                                <label>Stock</label>
                                <input class="form-control" name="Stock" placeholder="Enter stock quantity">
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
                                <label>Category</label>
                                <select class="form-control" name="CategoryID">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
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
