<div class="users index large-9 medium-8 columns content">
    <h3>
        <?= __('Users') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Users', 'action' => 'add'], ['escape' => false]) ?>
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
    <table cellpadding="0" cellspacing="0" class="users no-padding-on-small">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('Users.username', 'Username') ?></th>
                <th><?= $this->Paginator->sort('Users.email', 'E-Mail') ?></th>
                <th><?= $this->Paginator->sort('Users.is_admin', 'Is Admin?') ?></th>
                <th><?= $this->Paginator->sort('Users.is_active', 'Is Active?') ?></th>
                <th><?= $this->Paginator->sort('Users.is_passive', 'Is Passive?') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Html->link($user->username, ['action' => 'view', $user->id]) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->is_admin) ? '<i class="fi-check"></i>' : '' ?></td>
                <td><?= h($user->is_active) ? '<i class="fi-check"></i>' : '' ?></td>
                <td><?= h($user->is_passive) ? '<i class="fi-check"></i>' : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
