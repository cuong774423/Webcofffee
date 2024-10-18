<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng nếu không phải là dạng số nhiều của tên model
    protected $table = 'customers';

    // Đặt các trường có thể gán hàng loạt
    protected $fillable = [
        'name',
        'gender',
        'email',
        'address',
        'phone_number',
        'note',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id'); // Đảm bảo rằng tên các cột là đúng
    }

    // Nếu bạn muốn tự động quản lý timestamp
    public $timestamps = true;
}
