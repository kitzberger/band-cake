<div class="locations form large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Add Location') ?></legend>
        <?php
            echo $this->Form->control('title', ['autofocus' => 1]);
            echo $this->Form->control('address');
            echo $this->Form->control('city');
            echo $this->Form->control('zip');
            echo $this->Form->control('url');
            echo $this->Form->control('email');
            echo $this->Form->control('text');
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
