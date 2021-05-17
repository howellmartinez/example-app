<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use CometOneSolutions\Inventory\Contracts\Locationable;
use CometOneSolutions\Inventory\Contracts\LocationType;
use CometOneSolutions\Inventory\Traits\HasLocation;

class Warehouse extends Model implements Locationable
{
    use HasFactory;
    use HasLocation;

    protected static function booted()
    {
        static::created(function ($model) {
            Product::cursor()->each(function ($product) use ($model) {
                $model->products()->attach($product->id, ['stock' => 0]);
            });
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'warehouse_products');
    }

    /* ----- Locationable BEGIN ----- */
    public function getId()
    {
        return $this->id;
    }
    // public function getLocation();
    public function getLocationName()
    {
        return sprintf('%s %s', $this->name, 'Warehouse');
    }

    public function getLocationType()
    {
        return LocationType::IN;
    }
    /* ----- Locationable END ----- */
}
