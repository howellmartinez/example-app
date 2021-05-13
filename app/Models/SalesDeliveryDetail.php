<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDeliveryDetail extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    public $fillable = ['product_warehouse_id', 'quantity', 'unit_price', 'line_total', 'sales_order_detail_id'];

    public $timestamps = false;

    protected static function booted()
    {
        static::updated(function ($model) {
            dd('hi');
        });
    }

    public function product()
    {
        return $this->belongsToThrough(Product::class, WarehouseProduct::class);
    }

    public function salesDelivery()
    {
        return $this->belongsTo(SalesDelivery::class);
    }

    public function salesOrderDetail()
    {
        return $this->belongsTo(SalesOrderDetail::class);
    }
}
