<div class="songsVersions form large-9 medium-8 columns content">
    <?= $this->Form->create($songsVersion) ?>
    <fieldset>
        <legend><?= __('Edit Songs Version') ?></legend>
        <?php
            echo $this->Form->control('song_id', ['type' => 'hidden']);
            echo $this->Form->control('title');
            echo $this->Form->control('length', ['label' => __('Length (in seconds)')]);
            echo $this->Form->control('text', ['autofocus' => 1]);
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
