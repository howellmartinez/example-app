<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\MyBaseModel;
use App\Model\Traits\CanSortBy;
use App\Model\Traits\CanFilterBy;

// use CometOneSolutions\Common\Models\C1Model;

class SalesOrder extends MyBaseModel
{
    use HasFactory;
    use CanSortBy;
    use CanFilterBy;

    public $fillable = ['customer_id', 'date'];

    protected $filters = ['customer_name', 'id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesOrderDetails()
    {
        return $this->hasMany(SalesOrderDetail::class);
    }

    public function scopeCustomerName($query, $value, $operator = '=')
    {
        return $query->whereHas('customer', function ($customer) use ($value, $operator) {
            return $customer->where('name', $operator, $value);
        });
    }

    public function scopeSortByCustomerName($query, $direction)
    {
        return $query->join('customers', 'customers.id', 'sales_orders.customer_id')
            ->select('customers.name as customer_name', 'sales_orders.*')
            ->orderBy('customer_name', $direction);
    }
}
