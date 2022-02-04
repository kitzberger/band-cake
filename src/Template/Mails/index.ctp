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
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mails as $mail): ?>
            <tr>
                <td><?= $this->Number->format($mail->id) ?></td>
                <td><?= $mail->has('user') ? $this->Html->link($mail->user->username, ['controller' => 'Users', 'action' => 'view', $mail->user->id]) : '' ?></td>
                <td><?= h($mail->subject) ?></td>
                <td><?= h($mail->created) ?></td>
                <td><?= h($mail->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mail->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mail->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mail->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
