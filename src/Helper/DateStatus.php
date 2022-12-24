<?php

namespace App\Helper;

class DateStatus
{
    public static function toString($status)
    {
        switch ($status) {
            case \App\Model\Entity\Date::STATUS_CANCELED: return __('Gig (cancelled)');
            case \App\Model\Entity\Date::STATUS_BLOCKER: return __('Blocker');
            case \App\Model\Entity\Date::STATUS_DEFAULT: return __('Default');
            case \App\Model\Entity\Date::STATUS_UNCONFIRMED: return __('Gig (unconfirmed)');
            case \App\Model\Entity\Date::STATUS_CONFIRMED: return __('Gig (confirmed)');
            default: throw new \Exception('Unknown status!');
        }
    }
}
