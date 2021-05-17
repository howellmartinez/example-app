<?php

namespace App\Models;

use App\Traits\HasWarehouseProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use CometOneSolutions\Inventory\Traits\HasItemMovements;
use CometOneSolutions\Inventory\Contracts\Inventoriable;

use CometOneSolutions\Accounting\Contracts\Entryable;
use CometOneSolutions\Accounting\Traits\HasEntries;
use CometOneSolutions\Accounting\Helpers\AccountNames;

use Carbon\Carbon;

class SalesDeliveryDetail extends Model implements Inventoriable, Entryable
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    use HasWarehouseProduct;
    use HasItemMovements;
    use HasEntries;

    public $fillable = ['warehouse_product_id', 'quantity', 'unit_cost', 'unit_price', 'line_total', 'sales_order_detail_id'];

    public $timestamps = false;

    protected static function booted()
    {
        static::saved(function ($model) {
            if ($model->salesOrderDetail()->exists()) {
                $model->salesOrderDetail->updateDelivered();
            }
        });

        static::deleted(function ($model) {
            if ($model->salesOrderDetail()->exists()) {
                $model->salesOrderDetail->updateDelivered();
            }
        });
    }

    /*----- RELATIONSHIPS Begin -----*/

    public function salesDelivery()
    {
        return $this->belongsTo(SalesDelivery::class);
    }

    public function salesOrderDetail()
    {
        return $this->belongsTo(SalesOrderDetail::class);
    }

    public function customer()
    {
       return $this->belongsToThrough(Customer::class, SalesDelivery::class);
    }

    /*----- RELATIONSHIPS End -----*/


    /*----- INVENTORIABLE Begin -----*/
    public function getId()
    {
        return $this->id;
    }

    public function getInventoryRefNo()
    {
        return 'SALE ID ' . $this->sales_delivery_id;
    }

    public function getInventoryUri()
    {
        return route('sales_delivery_edit', ['salesDelivery' => $this->salesDelivery]);
    }

    public function getInventory()
    {
        return $this->product;
    }

    public function getItemMovementDate()
    {
        return Carbon::parse($this->salesDelivery->date);
    }

    public function getInventoryLocationInName()
    {
        return $this->customer->getLocationName();
    }

    public function getInventoryLocationOutName()
    {
        return $this->warehouse->getLocationName();
    }

    public function getItemMovementQuantity()
    {
        return $this->quantity;
    }

    // TODO is this necessary?
    public function getIsStandard()
    {
        return false;
    }
    /*----- INVENTORIABLE End -----*/

    /*----- ENTRYABLE Begin ----*/
    // public function getId()
    // {
    // }

    // TODO add in package interface
    public function getUnitCost()
    {
       return $this->unit_cost; 
    }

    public function getAccountingUri()
    {
        return '123';
    }

    public function getAccountingRefNo()
    {
        return $this->id;
    }

    public function getDebitAccountName()
    {
        return AccountNames::COST_OF_GOODS_SOLD;
    }

    public function getCreditAccountName()
    {
        return AccountNames::SALES;
    }

    public function getEntryDate()
    {
        return Carbon::parse($this->salesDelivery->date);
    }

    public function getEntryAmount()
    {
        return $this->unit_cost * $this->quantity;
    }

    // public function getEntries()
    // {
    // }
    
    // public function getBook()
    // {

    // }
    /*----- ENTRYABLE End -----*/

}
