<?php

namespace App\Helper;

class VoteVote
{
    public static function toString($vote)
    {
        switch ($vote) {
            case -1: return __('Negative');
            case 0:  return __('Neutral');
            case 1:  return __('Positive');
            default: throw new \Exception('Unknown vote!');
        }
    }
}
