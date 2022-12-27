<div class="locations view large-9 medium-8 columns content">
    <h3>
        <?= h($location->title) ?>
        <?php $this->assign('title', $location->title); ?>
        <small>
            <?= $this->Html->link('<i class="fi-pencil"></i> ' . __('Edit'), ['action' => 'edit', $location->id], ['escape' => false]) ?>
            <?php
                if ($currentUser['is_admin']) {
                    echo $this->Form->postLink(
                        '<i class="fi-trash"></i> ' . __('Delete'),
                        ['action' => 'delete', $location->id],
                        ['confirm' => __('Are you sure you want to delete "{0}"?', $location->title), 'escape' => false]
                    );
                }
            ?>
        </small>
    </h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $location->has('user') ? $this->element('username', ['user' => $location->user]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($location->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= h($location->person) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($location->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($location->address) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($location->city) ?></td>
        </tr>
        <tr>
            <th><?= __('Zip') ?></th>
            <td><?= h($location->zip) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($location->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($location->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($location->text)); ?>
    </div>
    <div class="related">
        <h4><?= __('Mails') ?></h4>
        <?php if (!empty($location->mails)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Subject') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($location->mails as $mail): ?>
            <tr>
                <td><?= h($mail->subject) ?></td>
                <td><?= h($mail->text) ?></td>
                <td><?= $mail->_joinData->email ? h($mail->_joinData->email) : h($mail->email) ?></td>
                <td>
                    <?php
                        if ($mail->_joinData->sent) {
                            echo '<span title="' . $mail->_joinData->sent->format('Y-m-d') . '">' . __('Sent!') . '</span>';
                        } elseif ($mail->_joinData->email) {
                            echo '<span>' . __('In mail queue') . '</span>';
                        } else {
                            echo '';
                        }
                    ?>
                </td>
                <td class="actions">
                    <?php
                        echo $this->Html->link(__('View'), ['controller' => 'Mails', 'action' => 'view', $mail->id]);
                        if (empty($mail->_joinData->email)) {
                            echo ' ';
                            echo $this->Html->link(__('Send'), ['controller' => 'Mails', 'action' => 'prepare', $mail->id, $location->id]);
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
