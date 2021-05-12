<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Traits\CanFilterBy;
use App\Model\Traits\CanSortBy;

class Customer extends Model
{
    use HasFactory;
    use CanFilterBy;
    use CanSortBy;

    public $fillable = ['name'];

    protected $filters = ['name', 'address'];

    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
