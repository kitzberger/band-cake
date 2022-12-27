<div class="mails form large-9 medium-8 columns content">
    <?= $this->Form->create($mail) ?>
    <fieldset>
        <legend><?= __('Edit Mail') ?></legend>
        <?php
            echo $this->Form->control('subject');
            echo $this->Form->control('text', [
                'templates' => [
                    'textarea' => '<p class="hint">' . __('Possible dynamic placeholders: <code>{person}</code>, <code>{location}</code> and <code>{city}</code>') . '</p><textarea name="{{name}}"{{attrs}}>{{value}}</textarea>'
                ],
            ]);
            echo $this->Form->control('locations._ids', ['options' => $locations]);
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
