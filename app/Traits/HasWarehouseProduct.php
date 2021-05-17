<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseProduct;

trait HasWarehouseProduct
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected static function bootHasWarehouseProduct()
    {
        static::saved(function ($model) {
            if ($model->isDirty('warehouse_product_id')) {
                $originalWarehouseProduct = WarehouseProduct::find($model->getOriginal('warehouse_product_id'));
                // Warehouse Product has changed
                if ($originalWarehouseProduct) {
                    $originalWarehouseProduct->updateStock();
                    // Product has changed
                    if ($originalWarehouseProduct->product_id != $model->product->id) {
                        $originalWarehouseProduct->product->updateStock();
                    }
                }
                $model->warehouseProduct->updateStock();
                $model->product->updateStock();
            }
        });

        static::deleted(function ($model) {
            $model->warehouseProduct->updateStock();
            $model->product->updateStock();
        });
    }

    public function warehouseProduct()
    {
        return $this->belongsTo(WarehouseProduct::class);
    }

    public function product()
    {
        return $this->belongsToThrough(Product::class, WarehouseProduct::class);
    }

    public function warehouse()
    {
        return $this->belongsToThrough(Warehouse::class, WarehouseProduct::class);
    }

    public function scopeWarehouse($query, Warehouse $value)
    {
        return $query->whereHas('warehouse', function ($warehouse) use ($value) {
            return $warehouse->whereId($value->id);
        });
    }

    public function scopeWarehouseName($query, $value)
    {
        return $query->whereHas('warehouse', function ($warehouse) use ($value) {
            return $warehouse->where('name', 'like', $value);
        });
    }

    public function scopeProductName($query, $value)
    {
        return $query->whereHas('product', function ($product) use ($value) {
            return $product->where('name', 'like', $value);
        });
    }

    public function scopeSortByWarehouseName($query, $direction)
    {
        return $query->join('warehouse_products', 'warehouse_products.id', `{$this->table}.warehouse_product_id`)
            ->join('warehouses', 'warehouses.id', 'warehouse_products.warehouse_id')
            ->select('warehouses.name as warehouse_name', 'warehouse_products.*', `{$this->table}.*`)
            ->orderBy('warehouse_name', $direction);
    }

    public function scopeSortByProductName($query, $direction)
    {
        return $query->join('warehouse_products', 'warehouse_products.id', `{$this->table}.warehouse_product_id`)
            ->join('products', 'products.id', 'warehouse_products.product_id')
            ->select('products.name as product_name', 'warehouse_products.*', `{$this->table}.*`)
            ->orderBy('product_name', $direction);
    }
}
