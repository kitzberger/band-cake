<div class="files form large-9 medium-8 columns content">
    <?= $this->Form->create($file) ?>
    <fieldset>
        <legend><?= __('Edit File') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('file', ['readonly']);
            echo $this->Form->control('collections._ids', ['options' => $collections]);
            echo $this->Form->control('date_id', ['options' => $dates, 'empty' => true]);
            echo $this->Form->control('idea_id', ['options' => $ideas, 'empty' => true]);
            if ($file->isAudio()) {
                echo $this->Form->control(
                    'song_id',
                    [
                        'options' => $songs,
                        'empty' => true,
                        'default' => (isset($this->request->query['song_id']) ? $this->request->query['song_id'] : null)
                    ]
                );
                echo $this->Form->control('is_public', ['type' => 'checkbox', 'label' => 'Set as reference file for this song?']);
            }
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
