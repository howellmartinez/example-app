<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseProduct extends Model
{
    protected $table = 'warehouse_products';

    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function updateStock()
    {
        // $this->pc_quantity = $this->itemMovements()->sum('pc_in') - $this->itemMovements()->sum('pc_out');
        // $this->kg_quantity = $this->itemMovements()->sum('kg_in') - $this->itemMovements()->sum('kg_out');
        $this->save();
    }
}
