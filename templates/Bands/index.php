<div class="bands index large-9 medium-8 columns content">
    <h3>
        <?= __('Bands') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Bands', 'action' => 'add'], ['escape' => false]) ?>
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
    <table cellpadding="0" cellspacing="0" class="bands no-padding-on-small">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Bands.title', 'Title') ?></th>
                <th><?= $this->Paginator->sort('Bands.text', 'Text') ?></th>
                <th><?= $this->Paginator->sort('Bands.users', 'Members') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bands as $band): ?>
            <tr>
                <td><?= $this->Html->link($band->title, ['action' => 'view', $band->id]) ?></td>
                <td><?= h($band->text) ?></td>
                <td><?= join(', ', array_column($band->users, 'username')) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $band->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $band->id], ['confirm' => __('Are you sure you want to delete # {0}?', $band->id)]) ?>
                </td>
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
