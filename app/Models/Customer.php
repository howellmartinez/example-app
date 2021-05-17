<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Traits\CanFilterBy;
use App\Model\Traits\CanSortBy;

use CometOneSolutions\Accounting\Contracts\Accountable;
use CometOneSolutions\Accounting\Traits\HasAccount;
use CometOneSolutions\Accounting\Helpers\CategoryNames;
use CometOneSolutions\Accounting\Helpers\NormalBalance;

use CometOneSolutions\Inventory\Contracts\Locationable;
use CometOneSolutions\Inventory\Contracts\LocationType;
use CometOneSolutions\Inventory\Traits\HasLocation;

class Customer extends Model implements Accountable, Locationable
{
    use HasFactory;
    use CanFilterBy;
    use CanSortBy;

    use HasAccount;
    use HasLocation;

    public $fillable = ['name'];

    protected $searchable = ['name', 'address'];

    public function salesOrder()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /* ----- Accountable BEGIN ----- */
    public function getId()
    {
        return $this->id;
    }

    public function getAccountName()
    {
        return sprintf('%s %s', 'A/R', $this->name);
    }

    public function getNormalBalance()
    {
        return NormalBalance::DEBIT;
    }

    public function getAccountCategoryName()
    {
        return CategoryNames::ACCOUNTS_RECEIVABLE;
    }

    // public function getAccount()
    // {

    // }

    /* ----- Accountable END ----- */


    /* ----- Locationable BEGIN ----- */
    // public function getId() ;
    // public function getLocation();
    public function getLocationName()
    {
        return sprintf('%s %s', $this->name, 'Customer');
    }

    public function getLocationType()
    {
        return LocationType::OUT;
    }
    /* ----- Locationable END ----- */

}
