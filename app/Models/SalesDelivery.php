<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CometOneSolutions\Common\Models\C1Model;
use App\Model\Traits\CanSortBy;
use App\Model\Traits\CanFilterBy;

class SalesDelivery extends C1Model
{
    use HasFactory;
    use CanFilterBy;
    use CanSortBy;

    public $fillable = [
        'customer_id', 'warehouse_id',
        'date', 'total', 'remarks'
    ];

    protected $searchable = ['customer_name', 'date'];

    protected static function booted()
    {
        static::deleting(function ($model) {
            $model->salesDeliveryDetails->each->delete();
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function salesDeliveryDetails()
    {
        return $this->hasMany(SalesDeliveryDetail::class);
    }

    public function scopeCustomerName($query, $value, $operator = '=')
    {
        return $query->whereHas('customer', function ($customer) use ($value, $operator) {
            return $customer->where('name', $operator, $value);
        });
    }

    public function scopeSortByCustomerName($query, $direction)
    {
        return $query->join('customers', 'customers.id', 'sales_deliveries.customer_id')
            ->select('customers.name as customer_name', 'sales_deliveries.*')
            ->orderBy('customer_name', $direction);
    }
}
