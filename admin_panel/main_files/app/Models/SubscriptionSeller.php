<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SubscriptionSeller extends Model
{

    use GlobalStatus;
    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    // badge
    public function paymentBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->paymentBadgeData(),
        );
    }

    public function paymentBadgeData()
    {
        $html = '';
        if ($this->payment_status == Status::ENABLE) {
            $html = '<span class="badge badge-success">' . trans('Paid') . '</span>';
        } else {
            $html = '<span class="badge badge-danger">' . trans('Un Paid') . '</span>';
        }
        return $html;
    }

}
