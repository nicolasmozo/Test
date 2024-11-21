<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model
{
    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
}
