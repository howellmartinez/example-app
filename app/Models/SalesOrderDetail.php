<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    use HasFactory;

    public $fillable = ['product_id', 'quantity', 'unit_price', 'line_total'];

    protected static function booted()
    {
        static::saving(function ($model) {
            $model->line_total = $model->quantity * $model->unit_price;
        });
    }

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}
