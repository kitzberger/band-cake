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

<?php
$content = explode("\n", $content);

foreach ($content as $line):
    echo '<p> ' . $line . "</p>\n";
endforeach;
?>

<p>
<?php
    if (!empty($date)) {
        echo $date->begin->format('Y-m-d') . ': ' . $this->Html->link($date->title, ['_full' => true, 'controller' => 'Dates', 'action' => 'view', $date->id]);
    }
    if (!empty($idea)) {
        echo $this->Html->link($idea->title, ['_full' => true, 'controller' => 'Ideas', 'action' => 'view', $idea->id]);
    }
    if (!empty($collection)) {
        echo $this->Html->link($collection->title, ['_full' => true, 'controller' => 'Collections', 'action' => 'view', $collection->id]);
    }
?>
</p>

<p>
<?= __('Love, your friends of this one cool band') ?>
</p>
