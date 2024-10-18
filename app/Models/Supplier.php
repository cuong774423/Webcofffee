<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'suppliers';

    // Khóa chính của bảng
    protected $primaryKey = 'SupplierID';

    // Các trường có thể được gán giá trị
    protected $fillable = [
        'SupplierName',
        'ContactName',
        'Address',
        'PhoneNumber',
        'Email'
    ];

    // Tùy chọn cho phép sử dụng timestamps (created_at, updated_at)
    public $timestamps = true;
}
