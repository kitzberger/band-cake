<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Share[]|\Cake\Collection\CollectionInterface $shares
 */
?>
<div class="shares index large-9 medium-8 columns content">
    <h3>
        <?= __('Shares') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Shares', 'action' => 'add'], ['escape' => false]) ?>
        </small>
    </h3>
    <p>
        <?=

            $this->Paginator->counter(
                'Page {{page}} of {{pages}}, showing {{current}} records out of
                 {{count}} total, starting on record {{start}}, ending on {{end}}'
            );

        ?>
    </p>
    <table cellpadding="0" cellspacing="0" class="shares no-padding-on-small">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= __('Record') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expire_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shares as $share): ?>
            <tr>
                <td><?= $share->has('user') ? $this->element('username', ['user' => $share->user]) : '' ?></td>
                <td>
                    <?= $share->has('date') ? __('Date') . ': ' . $this->Html->link($share->date->title, ['controller' => 'Dates', 'action' => 'view', $share->date->id]) : '' ?>
                    <?= $share->has('idea') ? __('Idea') . ': ' . $this->Html->link($share->idea->title, ['controller' => 'Ideas', 'action' => 'view', $share->idea->id]) : '' ?>
                    <?= $share->has('song') ? __('Song') . ': ' . $this->Html->link($share->song->title, ['controller' => 'Songs', 'action' => 'view', $share->song->id]) : '' ?>
                    <?= $share->has('collection') ? __('Collection') . ': ' . $this->Html->link($share->collection->title, ['controller' => 'Collections', 'action' => 'view', $share->collection->id]) : '' ?>
                    <?= $share->has('file') ? __('File') . ': ' . $this->Html->link($share->file->title, ['controller' => 'Files', 'action' => 'view', $share->file->id]) : '' ?>
                </td>
                <td><?= h($share->expire_date) ?></td>
                <td><?= h($share->created) ?></td>
                <td><?= h($share->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $share->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $share->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $share->id], ['confirm' => __('Are you sure you want to delete # {0}?', $share->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
