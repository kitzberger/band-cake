<div class="bands form large-9 medium-8 columns content">
    <?= $this->Form->create($band) ?>
    <fieldset>
        <legend><?= __('Add Band') ?></legend>
        <?php
            echo $this->Form->control('title', ['autofocus' => 1, 'autocomplete' => 'off', 'data-lpignore' => 'true']);
            echo $this->Form->control('text', ['autocomplete' => 'off', 'data-lpignore' => 'true']);
            echo $this->Form->control('users._ids', ['options' => $users]);
            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'default' => $currentUser['id']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
