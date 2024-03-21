<div class="bands view large-9 medium-8 columns content">
    <h3>
        <?= h($band->title) ?>
        <small>
            <?= $this->Html->link(
                '<i class="fi-pencil"></i> ' . __('Edit'),
                ['controller' => 'Bands', 'action' => 'edit', $band->id],
                ['escape' => false])
            ?>
        </small>
    </h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($band->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($band->text) ?></td>
        </tr>
        <tr>
            <th><?= __('Members') ?></th>
            <td><?php
                if (count($band->users)) {
                    echo '<ul>';
                    foreach ($band->users as $user) {
                        echo '<li>';
                        echo $this->Html->link(
                            $user->username,
                            ['controller' => 'Users', 'action' => 'view', $user->id],
                            ['escape' => false]
                        );
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($band->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($band->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Dates') ?></h4>
        <?php if (!empty($band->dates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Begin') ?></th>
                <th><?= __('End') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($band->dates as $dates): ?>
            <tr>
                <td><?= h($dates->id) ?></td>
                <td><?= h($dates->begin) ?></td>
                <td><?= h($dates->end) ?></td>
                <td><?= h($dates->title) ?></td>
                <td><?= h($dates->created) ?></td>
                <td><?= h($dates->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Dates', 'action' => 'view', $dates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Dates', 'action' => 'edit', $dates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dates', 'action' => 'delete', $dates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ideas') ?></h4>
        <?php if (!empty($band->ideas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($band->ideas as $ideas): ?>
            <tr>
                <td><?= h($ideas->id) ?></td>
                <td><?= h($ideas->title) ?></td>
                <td><?= h($ideas->created) ?></td>
                <td><?= h($ideas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ideas', 'action' => 'view', $ideas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ideas', 'action' => 'edit', $ideas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ideas', 'action' => 'delete', $ideas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ideas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Songs') ?></h4>
        <?php if (!empty($band->songs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($band->songs as $songs): ?>
            <tr>
                <td><?= h($songs->id) ?></td>
                <td><?= h($songs->title) ?></td>
                <td><?= h($songs->created) ?></td>
                <td><?= h($songs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Songs', 'action' => 'view', $songs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Songs', 'action' => 'edit', $songs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Songs', 'action' => 'delete', $songs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $songs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Collections') ?></h4>
        <?php if (!empty($band->collections)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($band->collections as $collections): ?>
            <tr>
                <td><?= h($collections->id) ?></td>
                <td><?= h($collections->title) ?></td>
                <td><?= h($collections->created) ?></td>
                <td><?= h($collections->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Collections', 'action' => 'view', $collections->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Collections', 'action' => 'edit', $collections->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Collections', 'action' => 'delete', $collections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $collections->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
