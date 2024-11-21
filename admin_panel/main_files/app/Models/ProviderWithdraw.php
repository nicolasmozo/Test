<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProviderWithdraw extends Model
{

    use GlobalStatus;
    public function provider(){
        return $this->belongsTo(User::class,'user_id');
    }

    // scope
    public function scopeApproved($query)   {
        return $query->where('status', Status::ACTIVE);
    }

    public function scopePending($query)   {
        return $query->where('status', Status::INACTIVE);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', Status::REJECTED);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->badgeData(),
        );
    }

    public function badgeData()
    {
        $html = '';
        if ($this->status == Status::ENABLE) {
            $html = '<span class="badge badge-success">' . trans('Success') . '</span>';
        } elseif($this->status == Status::PENDING) {
            $html = '<span class="badge badge-danger">' . trans('Pending') . '</span>';
        } else{
            $html = '<span class="badge badge-warning">' . trans('Rejected') . '</span>';
        }
        return $html;
    }


}
