<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; // Tên bảng trong database

    // Đặt tên cột khóa chính
    protected $primaryKey = 'ProductID';

    // Nếu khóa chính không tự động tăng
    public $incrementing = false;

    // Nếu cột khóa chính không phải là kiểu int
    protected $keyType = 'string'; // Thay đổi thành 'int' nếu khóa chính của bạn là kiểu số

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'ProductName', 'Description', 'Price', 'CategoryID', 'Stock', 'ImageURL'
    ];

    // Định nghĩa mối quan hệ với bảng Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }
    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'ProductID', 'id');
    }
    
}
