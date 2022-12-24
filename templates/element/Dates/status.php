<?php

if (isset($mode) === false) {
    switch ($date->status) {
        case \App\Model\Entity\Date::STATUS_CANCELED: echo '<span class="label alert">' . $date->status_string . '</span>'; break;
        case \App\Model\Entity\Date::STATUS_BLOCKER: echo '<span class="label blocker">' . $date->status_string . '</span>'; break;
        case \App\Model\Entity\Date::STATUS_DEFAULT:  echo '<span class="label">' . $date->status_string . '</span>'; break;
        case \App\Model\Entity\Date::STATUS_UNCONFIRMED:  echo '<span class="label warning">' . $date->status_string . '</span>'; break;
        case \App\Model\Entity\Date::STATUS_CONFIRMED:  echo '<span class="label success">' . $date->status_string . '</span>'; break;
        default: echo $date->status_string;
    }
} elseif ($mode === 'hex') {
    switch ($date->status) {
        case \App\Model\Entity\Date::STATUS_CANCELED: echo '#f04124'; break;
        case \App\Model\Entity\Date::STATUS_BLOCKER: echo '#555555'; break;
        case \App\Model\Entity\Date::STATUS_DEFAULT:  echo '#008CBA'; break;
        case \App\Model\Entity\Date::STATUS_UNCONFIRMED:  echo '#f08a24'; break;
        case \App\Model\Entity\Date::STATUS_CONFIRMED:  echo '#43AC6A'; break;
        default: echo '#000000';
    }
}
