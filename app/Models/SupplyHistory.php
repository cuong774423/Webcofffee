<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyHistory extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không theo quy ước của Laravel
    protected $table = 'supply_histories';

    // Đặt khóa chính nếu không phải là 'id'
    protected $primaryKey = 'SupplyID';

    // Cho phép gán hàng loạt cho các thuộc tính này
    protected $fillable = [
        'SupplierID',
        'WarehouseInEmployeeID',
        'ProductID',
        'Quantity',
        'DeliveryDate',
        'Status',
    ];

    // Xác định mối quan hệ với model Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID');
    }

    // Xác định mối quan hệ với model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }

    // Xác định mối quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'WarehouseInEmployeeID', 'EmployeeID');
    }
    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'ProductID', 'id');
    }

}

