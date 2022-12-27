<div class="collections index large-9 medium-8 columns content">
    <h3>
        <?= __('Collections') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Collections', 'action' => 'add'], ['escape' => false]) ?>
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
    <table cellpadding="0" cellspacing="0" class="collections no-padding-on-small">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th><?= __('Files') ?> / <?= __('Songs') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($collections as $collection): ?>
            <tr>
                <td><?= $this->Html->link($collection->title, ['action' => 'view', $collection->id]) ?></td>
                <td><?= count($collection->files) ?> / <?= count($collection->songs) ?></td>
                <td class="show-for-medium"><?= $this->element('date', ['date' => $collection->created]) ?></td>
                <td><?= $this->element('date', ['date' => $collection->modified]) ?></td>
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
