<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'Orders';
    protected $primaryKey = 'OrderID';

    protected $fillable = [
        'OrderID',
        'customer_id', // Đảm bảo tên cột là customer_id
        'OrderDate',
        'TotalAmount',
        'Status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id'); // customer_id là cột trong bảng orders, id là cột trong bảng customers
    }

    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class, 'OrderID', 'OrderID');
    }
}

