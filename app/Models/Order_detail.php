<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = "order_details";

    // Định nghĩa mối quan hệ ngược với Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID', 'OrderID');
    }

    // Định nghĩa quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class,'ProductID');
    }

}
