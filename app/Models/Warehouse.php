<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

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
}
