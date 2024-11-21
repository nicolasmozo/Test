<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use GlobalStatus;

    protected $guarded = [];

    // scope
    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
}
