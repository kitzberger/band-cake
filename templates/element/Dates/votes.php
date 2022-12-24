<?php

$voteClasses = [
    1 => 'success',
    -1 => 'alert',
    0 => 'secondary',
];

if ($date && $date->votes) {
    echo '<div class="inline-votes">';

    $otherUsersVotes = [];
    $currentUsersVote = null;
    foreach ($date->votes as $vote) {
        if ($vote->user_id == $currentUser['id']) {
            $currentUsersVote = $vote->vote;
        } else {
            $otherUsersVotes[] = $vote->vote;
        }
    }

    if (is_null($currentUsersVote)) {
        echo '<span title="' . __('Your vote') . '" class="label round own-vote">?</span>';
    } else {
        echo '<span title="' . __('Your vote') . '" class="label round own-vote ' . $voteClasses[$currentUsersVote] . '">&nbsp;</span>';
    }

    foreach ($otherUsersVotes as $vote) {
        echo '<span class="label round ' . $voteClasses[$vote] . '">&nbsp;</span>';
    }

    echo '</div>';
}
