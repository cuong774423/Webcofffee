@extends('admin.master')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Category</h1>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form role="form" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" name="CategoryName" placeholder="Enter category name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="Description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
