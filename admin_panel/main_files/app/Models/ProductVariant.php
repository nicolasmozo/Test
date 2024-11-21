<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $appends = ['service_options'];

    protected $hidden = ['options'];

    public function getServiceOptionsAttribute()
    {
        return json_decode($this->options);
    }
}
