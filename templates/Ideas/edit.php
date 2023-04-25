<div class="ideas form large-9 medium-8 columns content">
    <?= $this->Form->create($idea) ?>
    <fieldset>
        <legend><?= __('Edit Idea') ?></legend>
        <?php
            $this->Form->setTemplates(['formGroup' => '{{label}}{{hint}}{{input}}']);
            echo $this->Form->control('title');
            echo $this->Form->control('text', [
                'autofocus' => 1,
                'templateVars' => [
                    'hint' => '<p class="hint">Supports <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">markdown</a> syntax.</p>',
                ]
            ]);
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
