<div class="ideas index large-9 medium-8 columns content">
    <h3>
        <?= __('Ideas') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Ideas', 'action' => 'add'], ['escape' => false]) ?>
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
    <table cellpadding="0" cellspacing="0" class="ideas no-padding-on-small">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('title') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('user_id') ?></th>
                <th class="show-for-medium"><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ideas as $idea): ?>
            <tr>
                <td><?= $this->Html->link($idea->title, ['action' => 'view', $idea->id]) ?></td>
                <td class="show-for-medium"><?= $idea->has('user') ? $this->element('username', ['user' => $idea->user]) : '' ?></td>
                <td class="show-for-medium"><?= $this->element('date', ['date' => $idea->created]) ?></td>
                <td><?= $this->element('date', ['date' => $idea->modified]) ?></td>
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
