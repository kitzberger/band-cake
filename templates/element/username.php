<?php

if ($currentUser['is_admin']) {
    echo $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]);
} else {
    echo h($user->username);
}
