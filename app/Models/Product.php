<?php

namespace App\Models;

use CometOneSolutions\Inventory\Contracts\Inventory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Model\Traits\CanFilterBy;
use App\Model\Traits\CanSortBy;


class Product extends Model implements Inventory
{
    use HasFactory;

    use CanFilterBy;
    use CanSortBy;

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
        return $this->belongsToMany(Warehouse::class, 'warehouse_products');
    }

    /*----- INVENTORY Begin -----*/
    public function computeStock()
    {

    }

    public function getStock()
    {

    }

    public function updateStock()
    {
        // $this->setPcStock($this->computePcStock());
        // $this->setKgStock($this->computeKgStock());
        // $this->save();
    }
    /*----- INVENTORY End -----*/
}
