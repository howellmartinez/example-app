<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model
{
    use HasFactory;

    public $fillable = ['product_id', 'quantity', 'unit_price', 'line_total', 'delivered'];

    public $timestamps = false;

    protected $attributes = ['cancelled' => false, 'delivered' => 0];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }

    public function salesDeliveryDetails()
    {
        return $this->hasMany(SalesDeliveryDetail::class);
    }

    public function updateDelivered()
    {
        $this->update(['delivered' => $this->salesDeliveryDetails()->sum('quantity')]);
    }

    public function scopePending($query)
    {
        return $query->whereRaw('delivered < quantity')->where('cancelled', false);
    }
}
