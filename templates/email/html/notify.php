<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<h2><?= __('Hi') . ' ' . $user['username'] ?>!</h2>

<p><?= __('Here\'s the latest updates on the band portal. Enjoy!') ?></p>

<h3><?= __('Logs') ?></h3>

<table cellpadding="0" cellspacing="0" class="logs">
    <thead>
        <tr>
            <th><?= __('User') ?></th>
            <th><?= __('Record') ?></th>
            <th><?= __('Diff') ?></th>
            <th><?= __('Created') ?></th>
        </tr>
    </thead>
    <tbody>
<?php
    $count=0;
    foreach ($logs as $log):
        $count++;
?>
        <tr class="<?= ($count%2==0 ? 'even' : 'odd') ?>">
            <td><?= $log->has('user') ? h($log->user->username) : '' ?></td>
            <td>
                <?php
                    if ($log->has('song')) {
                        echo __('Song') . ': ' . $this->Html->link($log->song->title, ['_full' => true, 'controller' => 'Songs', 'action' => 'view', $log->song->id]);
                    }
                    if ($log->has('date')) {
                        echo __('Date on') . ' ' . $log->date->begin->format('Y-m-d') . ': ' . $this->Html->link($log->date->title, ['_full' => true, 'controller' => 'Dates', 'action' => 'view', $log->date->id]);
                    }
                    if ($log->has('idea')) {
                        echo __('Idea') . ': ' . $this->Html->link($log->idea->title, ['_full' => true, 'controller' => 'Ideas', 'action' => 'view', $log->idea->id]);
                    }
                    if ($log->has('collection')) {
                        echo __('Collection') . ': ' . $this->Html->link($log->collection->title, ['_full' => true, 'controller' => 'Collections', 'action' => 'view', $log->collection->id]);
                    }
                ?>
            </td>
            <td class="diff"><?= $this->Diff->render($log->diff) ?></td>
            <td><?= h($log->created) ?></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
