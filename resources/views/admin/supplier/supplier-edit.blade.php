@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Supplier</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sửa nhà cung cấp
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ route('suppliers.update', $supplier->SupplierID) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <input class="form-control" name="SupplierName" value="{{ $supplier->SupplierName }}" placeholder="Enter supplier name">
                            </div>
                            <div class="form-group">
                                <label>Contact Name</label>
                                <input class="form-control" name="ContactName" value="{{ $supplier->ContactName }}" placeholder="Enter contact name">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" name="Address" value="{{ $supplier->Address }}" placeholder="Enter address">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input class="form-control" name="PhoneNumber" value="{{ $supplier->PhoneNumber }}" placeholder="Enter phone number">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="Email" value="{{ $supplier->Email }}" placeholder="Enter email">
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
