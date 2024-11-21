<?php

namespace App\Constants;

class Status{
    const ACTIVE = 1;
    const SUCCESS = 1;
    const INACTIVE = 0;
    const PENDING = 0;
    const YES = 1;
    const NO = 0;
    const REJECTED =2;

    const COMMISSION_BASED = 0;
    const SUBSCRIPTION_BASED = 1;

    const ENABLE = 1;
    const DISABLE = 0;

    const UNLIMITED = -1;

    const LIFETIME= 'lifetime';
    const FREE= 'free';

    const PENDING_SUBSCRIPTION = 0;
    const ACTIVE_SUBSCRIPTION = 1;
}
