<div class="mails view large-9 medium-8 columns content">
    <h3>
        <?= h($mail->subject) ?>
        <?php $this->assign('title', $mail->subject); ?>
        <small>
            <?= $this->Html->link('<i class="fi-pencil"></i> '.__('Edit'), ['action' => 'edit', $mail->id], ['escape' => false]) ?>
            <?php
                if ($currentUser['is_admin']) {
                    echo $this->Form->postLink(
                        '<i class="fi-trash"></i> '.__('Delete'),
                        ['action' => 'delete', $mail->id],
                        ['confirm' => __('Are you sure you want to delete "{0}"?', $mail->subject), 'escape' => false]
                    );
                }
            ?>
        </small>
    </h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $mail->has('user') ? $this->Html->link($mail->user->username, ['controller' => 'Users', 'action' => 'view', $mail->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mail->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mail->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($mail->text)); ?>
    </div>
    <div class="related">
        <h4><?= __('Locations') ?></h4>
        <?php if (!empty($mail->locations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Zip') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Sent') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($mail->locations as $location): ?>
            <tr>
                <td><?= h($location->title) ?></td>
                <td><?= h($location->city) ?></td>
                <td><?= h($location->zip) ?></td>
                <td><?= $location->_joinData->email ? h($location->_joinData->email) : h($location->email) ?></td>
                <td><?= $location->_joinData->sent ? $location->_joinData->sent->format('Y-m-d') : '-' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Locations', 'action' => 'view', $location->id]) ?>
                    <?= $this->Html->link(__('Send'), ['controller' => 'Mails', 'action' => 'send', $mail->id, $location->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
