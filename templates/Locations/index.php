<div class="locations index large-9 medium-8 columns content">
    <h3>
        <?= __('Locations') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Locations', 'action' => 'add'], ['escape' => false]) ?>
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
    <table cellpadding="0" cellspacing="0" class="locations no-padding-on-small">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Locations.title', 'Name') ?></th>
                <th><?= $this->Paginator->sort('Locations.city', 'City') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('Locations.created', 'Created') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('Locations.modified', 'Modified') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $location): ?>
            <tr>
                <td><?= $this->Html->link($location->title, ['action' => 'view', $location->id]) ?></td>
                <td><?= h($location->city) ?></td>
                <td class="show-for-medium"><?= $this->element('date', ['date' => $location->created]) ?></td>
                <td><?= $this->element('date', ['date' => $location->modified]) ?></td>
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
