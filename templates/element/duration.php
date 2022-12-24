<?php

if ($seconds) {
    echo '<span title="' . $seconds . ' seconds">';
    echo gmdate($format ?? 'i \m\i\n s', $seconds);
    echo '</span>';
}
