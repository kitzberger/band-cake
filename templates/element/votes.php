<?php

$voteClasses = [
    1 => 'success',
    -1 => 'alert',
    0 => 'secondary',
];

$userVotes = [];
if ($record->votes) {
    foreach ($record->votes as $vote) {
        $userVotes[$vote->user->id] = $vote;
    }
}

switch (get_class($record)) {
    case \App\Model\Entity\Date::class:
        $controller = 'Dates';
        $related_to = 'date:' . $record->id;
        break;
    case \App\Model\Entity\Idea::class:
        $controller = 'Ideas';
        $related_to = 'idea:' . $record->id;
        break;
    default: throw new \Exception('Record type not supported!');
}

echo '<div class="button-group button-group-votes">';
foreach ($users as $user) {
    $extraClass = '';
    if (isset($userVotes[$user->id])) {
        $extraClass = $voteClasses[$userVotes[$user->id]->vote];
    }

    if ($user['id'] === $currentUser['id']) {
        echo '<ul id="drop" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1" data-related-to="' . $related_to . '" data-url-vote="' . $this->Url->build(['controller' => 'Votes', 'action' => 'add']) . '" data-user-id="' . $currentUser['id'] . '" data-csrf-token="' . $_csrfToken . '">';
        echo '  <li><a href="javascript:" onclick="vote(this,1); return false">Dafür</a></li>';
        echo '  <li><a href="javascript:" onclick="vote(this,0); return false">Enthalten</a></li>';
        echo '  <li><a href="javascript:" onclick="vote(this,-1); return false">Dagegen</a></li>';
        echo '</ul>';
        echo '<a class="button split ' . $extraClass . '" id="my-vote">' . $user['username'];
        echo '  <span data-dropdown="drop" aria-controls="drop" aria-expanded="false"></span>';
        echo '</a>';
    } else {
        if ($user['is_active']) {
            echo '<a class="button ' . $extraClass . '">' . $user['username'] . '</a>';
        } else {
            echo $this->Html->link(
                $user->username,
                [
                    'controller' => $controller,
                    'action' => 'share',
                    $record->id,
                    $user->id
                ],
                [
                    'class' => 'button ' . $extraClass,
                    'title' => __('Ask ') . $user->username,
                    'onclick' => 'return confirm("' . __('Sure?') . '")'
                ]
            );
        }
    }
}
echo '</div>';
