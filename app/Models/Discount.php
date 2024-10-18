<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    protected $primaryKey = 'DiscountID';
    protected $fillable = ['DiscountCode', 'Description', 'DiscountAmount','UsageCount', 'StartDate', 'EndDate', 'ProductID'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');
    }
}