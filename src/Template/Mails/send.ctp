<div class="mails view large-9 medium-8 columns content">
    <h3>
        <?= h($mail->subject) . ' => ' . h($location->title) ?>
        <?php $this->assign('title', $mail->subject); ?>
        <small>
            <?= $this->Html->link('<i class="fi-arrow-left"></i> '.__('View'), ['action' => 'view', $mail->id], ['escape' => false]) ?>
        </small>
    </h3>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?php
            $text = $mail->text;
            $text = str_replace(
                [
                    '{person}',
                    '{title}',
                    '{city}',
                ],
                [
                    $location->person ?? 'ihr Lieben',
                    $location->title,
                    $location->city,
                ],
                $text
            );
            echo $this->Text->autoParagraph(h($text));
        ?>
    </div>
    <div class="related">
        <h4><?= __('Location') ?></h4>
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
