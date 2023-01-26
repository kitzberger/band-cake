<?php if (!empty($files)): ?>
    <table cellpadding="0" cellspacing="0" class="files audio-player">
        <tr>
            <th><?= __('User') ?></th>
            <th><?= __('File') ?></th>
            <th><?= __('Reference') ?></th>
            <th><?= __('Collection') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions hide-for-print"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($files as $file): ?>
        <tr class="item item-<?= $file->getType() ?>">
            <td><?= h($file->user->username) ?></td>
            <td><?= h($file->title) ?><br>
                <?= $this->element('Files/embed-inline', ['file' => $file]) ?>
            </td>
            <td><?= $file->is_public ? '<i class="fi-check"></i>' : '' ?></td>
            <td><?php
                if (!empty($file->collections)) {
                    foreach ($file->collections as $collection) {
                        echo $this->Html->link($collection->title, ['controller' => 'Collections', 'action' => 'view', $collection->id]);
                    }
                }
                ?>
            </td>
            <td><?= h($file->created) ?></td>
            <td><?= ($file->created != $file->modified) ? h($file->modified) : '' ?></td>
            <td class="actions hide-for-print">
                <?= $this->Html->link(__('View'), ['controller' => 'Files', 'action' => 'view', $file->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Files', 'action' => 'edit', $file->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
