<?php
    $simpleMode = (isset($date_id) || isset($idea_id) || isset($song_id) || isset($collection_id));
?>
<?= $this->Form->create($comment, ['url' => ['controller' => 'Comments', 'action' => 'add']]) ?>
<fieldset>
    <?php
        if ($simpleMode) {
            echo $this->Form->control('date_id', ['type' => 'hidden', 'default' => (isset($date_id) ? $date_id : null)]);
            echo $this->Form->control('idea_id', ['type' => 'hidden', 'default' => (isset($idea_id) ? $idea_id : null)]);
            echo $this->Form->control('song_id', ['type' => 'hidden', 'default' => (isset($song_id) ? $song_id : null)]);
            echo $this->Form->control('collection_id', ['type' => 'hidden', 'default' => (isset($collection_id) ? $collection_id : null)]);
        } else {
            echo '<legend>' . __('Add Comment') . '</legend>';
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
            echo $this->Form->control(
                'song_id',
                ['options' => $songs,
                                                'empty' => true,
                                                'default' => (isset($this->request->query['song_id']) ? $this->request->query['song_id'] : null)]
            );
            echo $this->Form->control(
                'collection_id',
                ['options' => $songs,
                                                'empty' => true,
                                                'default' => (isset($this->request->query['collection_id']) ? $this->request->query['collection_id'] : null)]
            );
        }

        echo $this->Form->textarea('text');
    ?>
</fieldset>
<?php
    if (!$simpleMode && $currentUser['is_admin']) {
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
