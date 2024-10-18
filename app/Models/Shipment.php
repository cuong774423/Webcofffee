<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

   
    protected $table = 'shipments'; // Tên bảng
    protected $primaryKey = 'ShipmentID'; // Đặt tên cột khóa chính
    public $incrementing = false; // Nếu khóa chính không tự động tăng
    protected $keyType = 'string'; // Thay đổi nếu khóa chính là kiểu int
    protected $fillable = [
        'ProductID',
        'Quantity',
        'ShipmentDate',
        'Notes',
        'WarehouseOutEmployeeID'
    ];

    // Định nghĩa quan hệ belongsTo với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }

    // Định nghĩa quan hệ belongsTo với Employee (nếu có)
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'WarehouseOutEmployeeID');
    }
}
