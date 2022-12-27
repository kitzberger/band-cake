<div class="mails index large-9 medium-8 columns content">
    <h3>
        <?= __('Mails') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> '.__('New'), ['controller' => 'Mails', 'action' => 'add'], ['escape' => false]) ?>
        </small>
    </h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= __('Recipients') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mails as $mail): ?>
            <tr>
                <td><?= $this->Html->link($mail->subject, ['action' => 'view', $mail->id]) ?></td>
                <td><?= count($mail->locations) ?></td>
                <td><?= $mail->has('user') ? $this->Html->link($mail->user->username, ['controller' => 'Users', 'action' => 'view', $mail->user->id]) : '' ?></td>
                <td class="show-for-medium"><?= $this->element('date', ['date' => $mail->created]) ?></td>
                <td><?= $this->element('date', ['date' => $mail->modified]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($this->Paginator->total() > 1): ?>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
    <?php endif; ?>
</div>
