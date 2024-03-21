<div class="collections form large-9 medium-8 columns content">
    <?= $this->Form->create($collection) ?>
    <fieldset>
        <legend><?= __('Edit Collection') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('files._ids', ['options' => $files]);
            echo $this->Form->control('songs._ids', ['options' => $songs]);
        ?>
    </fieldset>
    <?php
        if ($currentUser['is_admin']) {
            ?>
    <fieldset>
        <legend><?= __('Admin fields') ?></legend>
        <?= $this->Form->control('bands._ids', ['options' => $bands]); ?>
        <?= $this->Form->control('user_id', ['options' => $users, 'empty' => true]) ?>
    </fieldset>
    <?php
        }
    ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
