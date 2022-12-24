<?php if (!empty($collections)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('User') ?></th>
            <th><?= __('Title') ?></th>
        </tr>
        <?php foreach ($collections as $collection): ?>
        <tr>
            <td><?= h($collection->user->username) ?></td>
            <td><?= $this->Html->link($collection->title, ['controller' => 'Collections', 'action' => 'view', $collection->id]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
