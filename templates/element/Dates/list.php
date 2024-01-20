<table cellpadding="0" cellspacing="0" class="dates no-padding-on-small">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Dates.title', 'Title') ?></th>
            <th><?= $this->Paginator->sort('Dates.begin', 'Begin') ?></th>
            <th><?= $this->Paginator->sort('Dates.status', 'Status') ?></th>
            <th><?= $this->Paginator->sort('Dates.votes', 'Votes') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dates as $date): ?>
        <tr class="status<?= $date->status ?> <?= $date->isAlreadyPast() ? 'already-passed' : '' ?>">
            <td><?= $this->Html->link($date->title, ['action' => 'view', $date->id]) ?></td>
            <td><?= $this->element('Dates/date', ['date' => $date]) ?></td>
            <td><?= $this->element('Dates/status', ['date' => $date]) ?></td>
            <td><?= $this->element('Dates/votes', ['date' => $date]) ?></td>
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
