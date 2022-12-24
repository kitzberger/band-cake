<?php

if ($shares) {
    $usernames = [];
    foreach ($shares as $share) {
        $usernames[] = $share->user->username;
    }
    echo join(', ', $usernames);
}
