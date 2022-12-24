<?php

if ($date) {
    echo '<span title="' . $date . '">';
    echo $date->timeAgoInWords(['accuracy' => ['month' => 'month'], 'end' => '1 year']);
    echo '</span>';
}
