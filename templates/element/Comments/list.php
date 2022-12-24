<?php if (!empty($comments)): ?>
    <table cellpadding="0" cellspacing="0" class="comments">
        <tr class="toggle-old-ones hide">
            <td colspan="3">
                <div class="panel">
                    <p>
                        <?= __('Some older comments have been hidden automatically.') ?>
                        <a class="show-old-ones"><?= __('Show old comments!') ?></a>
                        <a class="hide-old-ones hide"><?= __('Hide old comments!') ?></a>
                    </p>
                </div>
            </td>
        </tr>
        <?php foreach ($comments as $comment): ?>
        <tr class="<?= ($comment->created->wasWithinLast('1 month') ? 'younger-than-last-month' : 'older-than-last-month hide') ?>">
            <td class="gravatar">
                <?= $this->element('gravatar', ['user' => $comment->user]) ?>
            </td>
            <td>
                <div class="gray">
                <?php
                    echo h($comment->user->username);
                    echo ', ';
                    echo $this->element('date', ['date' => $comment->created]);
                    if ($comment->created != $comment->modified) {
                        echo ', ' . __('modified') . ' ';
                        echo $this->element('date', ['date' => $comment->modified]);
                    }
                ?>
                </div>
                <?= $this->element('text', ['text' => $comment->text]) ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('<i class="fi-pencil"></i> ' . __('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comment->id], ['escape' => false]) ?>
                <?php
                    if ($currentUser['is_admin']) {
                        echo '<br>';
                        echo $this->Form->postLink('<i class="fi-trash"></i> ' . __('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'escape' => false]);
                    }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
