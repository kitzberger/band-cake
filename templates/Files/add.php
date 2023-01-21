<div class="files form large-9 medium-8 columns content">
    <?= $this->Form->create($file, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('Add File') ?></legend>
        <?php
            echo $this->Form->control('title', ['autofocus' => 1]);
            echo $this->Form->control('file', ['type' => 'file']);
            echo $this->Form->control('collections._ids', ['options' => $collections]);
            echo $this->Form->control(
                'date_id',
                [
                    'options' => $dates,
                    'empty' => true,
                    'default' => (isset($this->request->query['date_id']) ? $this->request->query['date_id'] : null),
                ]
            );
            echo $this->Form->control(
                'idea_id',
                [
                    'options' => $ideas,
                    'empty' => true,
                    'default' => (isset($this->request->query['idea_id']) ? $this->request->query['idea_id'] : null),
                ]
            );
            echo $this->Form->control(
                'song_id',
                [
                    'options' => $songs,
                    'empty' => true,
                    'default' => (isset($this->request->query['song_id']) ? $this->request->query['song_id'] : null),
                ]
            );
            echo $this->Form->control('is_public', ['type' => 'checkbox', 'label' => 'Set as reference file for this song?']);
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
