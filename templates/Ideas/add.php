<div class="ideas form large-9 medium-8 columns content">
    <?= $this->Form->create($idea) ?>
    <fieldset>
        <legend><?= __('Add Idea') ?></legend>
        <?php
            echo $this->Form->control('title', ['autofocus' => 1]);
            echo $this->Form->control('text');
        ?>
    </fieldset>
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
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
