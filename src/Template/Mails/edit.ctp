<div class="mails form large-9 medium-8 columns content">
    <?= $this->Form->create($mail) ?>
    <fieldset>
        <legend><?= __('Edit Mail') ?></legend>
        <?php
            echo $this->Form->control('subject');
            echo $this->Form->control('text');
            echo $this->Form->control('locations._ids', ['options' => $locations]);
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
