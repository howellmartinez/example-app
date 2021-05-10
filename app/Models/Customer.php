<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
