<div class="files index large-9 medium-8 columns content">
    <h3>
        <?= __('Files') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Files', 'action' => 'add'], ['escape' => false]) ?>
        </small>
    </h3>
    <?= $this->element('sword', ['sword' => $sword]) ?>
    <p>
        <?=

            $this->Paginator->counter(
                'Page {{page}} of {{pages}}, showing {{current}} records out of
                 {{count}} total, starting on record {{start}}, ending on {{end}}'
            );

        ?>
    </p>
    <table cellpadding="0" cellspacing="0" class="files no-padding-on-small">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('file') ?></th>
                <th><?= __('Reference') ?></th>
                <th><?= __('Record') ?></th>
                <th><?= __('Collection') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('user_id') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
            <tr>
                <td><?= $this->Html->link($file->title, ['controller' => 'Files', 'action' => 'view', $file->id]) ?></td>
                <td class="show-for-medium"><?= $this->Html->link($file->file, 'uploads' . DS . $file->file) ?></td>
                <td><?= $file->is_public ? '<i class="fi-check"></i>' : '' ?></td>
                <td>
                    <?= $file->has('date') ? __('Date') . ': ' . $this->Html->link($file->date->title, ['controller' => 'Dates', 'action' => 'view', $file->date->id]) . '<br>' : '' ?>
                    <?= $file->has('idea') ? __('Idea') . ': ' . $this->Html->link($file->idea->title, ['controller' => 'Ideas', 'action' => 'view', $file->idea->id]) . '<br>' : '' ?>
                    <?= $file->has('song') ? __('Song') . ': ' . $this->Html->link($file->song->title, ['controller' => 'Songs', 'action' => 'view', $file->song->id]) : '' ?>
                </td>
                <td><?php
                    if (!empty($file->collections)) {
                        foreach ($file->collections as $collection) {
                            echo $this->Html->link($collection->title, ['controller' => 'Collections', 'action' => 'view', $collection->id]);
                        }
                    }
                    ?>
                </td>
                <td class="show-for-medium"><?= $file->has('user') ? $this->element('username', ['user' => $file->user]) : '' ?></td>
                <td class="show-for-medium"><?= $this->element('date', ['date' => $file->created]) ?></td>
                <td><?= $this->element('date', ['date' => $file->modified]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($this->Paginator->total() > 1): ?>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    <?php endif; ?>
</div>
