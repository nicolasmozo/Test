<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flutterwave extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(MultiCurrency::class, 'currency_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    protected $hidden = ['public_key', 'secret_key', 'currency_rate'];
}
