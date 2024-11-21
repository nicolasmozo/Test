<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use GlobalStatus;

    public function isDefaultBadge(): Attribute
    {
        return new Attribute(
            get: fn () => $this->defaultbadgeData(),
        );
    }
    public function defaultbadgeData()
    {
        $html = '';
        if ($this->is_default === 'Yes') {
            $html = '<span class="badge badge-success">' . trans('Yes') . '</span>';
        } else {
            $html = '<span class="badge badge-danger">' . trans('No') . '</span>';
        }
        return $html;
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
            $html = '<span class="badge badge-success">' . trans('Enable') . '</span>';
        } else {
            $html = '<span class="badge badge-danger">' . trans('Disabled') . '</span>';
        }
        return $html;
    }
}
