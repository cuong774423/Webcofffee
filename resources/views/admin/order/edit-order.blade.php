@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chỉnh sửa trạng thái đơn hàng</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('bills.update', $bill->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Trạng thái:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="new" {{ $Order->status == 'new' ? 'selected' : '' }}>Mới</option>
                                <option value="processing" {{ $Order->status == 'processing' ? 'selected' : '' }}>Đang giao</option>
                                <option value="delivered" {{ $Order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                                <option value="cancelled" {{ $Order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
