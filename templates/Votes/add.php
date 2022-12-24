<div class="votes form large-9 medium-8 columns content">
    <?= $this->Form->create($vote) ?>
    <fieldset>
        <legend><?= __('Add Vote') ?></legend>
        <?php
            echo $this->Form->control(
    'date_id',
    ['options' => $dates,
                                                'empty' => true,
                                                'default' => (isset($this->request->query['date_id']) ? $this->request->query['date_id'] : null)]
);
            echo $this->Form->control(
                'idea_id',
                ['options' => $ideas,
                                                'empty' => true,
                                                'default' => (isset($this->request->query['idea_id']) ? $this->request->query['idea_id'] : null)]
            );
            echo $this->Form->control('vote');
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
