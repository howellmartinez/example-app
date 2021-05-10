<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    public $fillable = ['customer_id', 'date'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesOrderDetails()
    {
        return $this->hasMany(SalesOrderDetail::class);
    }
}
