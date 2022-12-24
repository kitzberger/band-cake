<?php
    if ($currentUser['is_admin']) {
        ?>
<fieldset>
    <legend><?= __('Admin fields') ?></legend>
    <?= $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'default' => $currentUser['id']]) ?>
</fieldset>
<?php
    } else {
        echo $this->Form->control('user_id', ['type' => 'hidden', 'default' => $currentUser['id']]);
    }
?>
