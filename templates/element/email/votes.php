<?php

$voteClasses = [
    1 => 'success',
    -1 => 'alert',
    0 => 'secondary',
];

$userVotes = [];
if ($votes) {
    foreach ($votes as $vote) {
        $userVotes[$vote['user_id']] = $vote;
    }
}

echo '<div class="button-group">';
foreach ($users as $user) {
    $extraClass = '';
    if (isset($userVotes[$user->id]) && $userVotes[$user->id]->vote) {
        $extraClass = $voteClasses[$userVotes[$user->id]->vote];
    }

    echo '<a class="button ' . $extraClass . ' inactive" onclick="javascript:">' . $user['username'] . '</a> ';
}
echo '</div>';
echo "\n";
echo "\n";
echo '<h3>Change own vote</h3>';


$params = ['controller' => 'Votes', 'action' => 'add'];
$url = $this->Url->build($params, true);
foreach ([-1 => 'Negative', 0 => 'Neutral', 1 => 'Positive'] as $voteValue => $voteLabel) {
    echo '<form method="post" action="' . $url . '" class="inline">';
    echo '<input type="hidden" name="user_id" value="' . $user['id'] . '" />';
    if (!empty($vote['date_id'])) {
        echo '<input type="hidden" name="date_id" value="' . $vote['date_id'] . '" />';
    } elseif (!empty($vote['idea_id'])) {
        echo '<input type="hidden" name="idea_id" value="' . $vote['idea_id'] . '" />';
    }
    echo '<button type="submit" class="' . $voteClasses[$voteValue] . '">' . $voteLabel . '</button> ';
    echo '</form> ';
}
