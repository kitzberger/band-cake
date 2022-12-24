<div class="ideas form large-9 medium-8 columns content">
    <?= $this->Form->create($idea) ?>
    <fieldset>
        <legend><?= __('Edit Idea') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('text');
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
