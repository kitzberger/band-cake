<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Share $share
 */
?>
<div class="shares form large-9 medium-8 columns content">
    <?= $this->Form->create($share) ?>
    <fieldset>
        <legend><?= __('Add Share') ?></legend>
        <?php
            $format = \Cake\Core\Configure::read('DateTimeFormat');

            echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('date_id', ['options' => $dates, 'empty' => true]);
            echo $this->Form->control('idea_id', ['options' => $ideas, 'empty' => true]);
            echo $this->Form->control('song_id', ['options' => $songs, 'empty' => true]);
            echo $this->Form->control('file_id', ['options' => $songs, 'empty' => true]);
            echo $this->Form->control('collection_id', ['options' => $collections, 'empty' => true]);
            echo $this->Form->control('expire_date', [
                'class' => 'datetime',
                'type' => 'text',
                'format' => $format,
                'default' => date($format),
                'value' => !empty($share->expire_date) ? $share->expire_date->format($format) : '',
            ]);
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
