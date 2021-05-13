<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($model) {
            Warehouse::cursor()->each(function ($warehouse) use ($model) {
                $model->warehouses()->attach($warehouse->id, ['stock' => 0]);
            });
        });
    }

    public function salesOrderDetails()
    {
        return $this->hasMany(SalesOrderDetail::class);
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class);
    }
}
