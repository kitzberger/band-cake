<?php

if ($currentUser['is_admin'] || $currentUser['is_active']) {
    echo '<ul id="drop-share" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">';
    foreach ($passiveUsers as $user) {
        echo '<li>';

        echo $this->Html->link(
            $user->username,
            [
                'controller' => $controller,
                'action' => 'share',
                $record->id,
                $user->id
            ],
            [
                'title' => __('Share with ') . $user->username,
                'onclick' => 'return confirm("' . __('Sure?') . '")'
            ]
        );

        echo '</li>';
    }
    echo '</ul>';
    echo '<a class="button small split" id="share-links">' . __('Share');
    echo '  <span data-dropdown="drop-share" aria-controls="drop" aria-expanded="false"></span>';
    echo '</a> ';
}
