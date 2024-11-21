<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;

class PaystackAndMollie extends Model
{
    protected $hidden = ['mollie_key', 'mollie_currency_rate', 'paystack_public_key', 'paystack_secret_key', 'paystack_currency_rate'];

    public function molliecurrency()
    {
        return $this->belongsTo(MultiCurrency::class, 'mollie_currency_id', 'id');
    }

    public function paystackcurrency()
    {
        return $this->belongsTo(MultiCurrency::class, 'paystack_currency_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
}
