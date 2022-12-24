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
<?php
$content = explode("\n", $content);

foreach ($content as $line):
    echo '<p> ' . $line . "</p>\n";
endforeach;

if (!empty($vote['date_id'])) {
    $title = $vote['date']['title'];
} elseif (!empty($vote['idea_id'])) {
    $title = $vote['idea']['title'];
} else {
    $title = '[No title]';
}

?>


<h1><?= $title ?></h1>

<p><?= $vote['user']['username'] ?> changed their vote.</p>


<?= $this->element('Email/votes', ['votes' => $vote['date']['votes']]) ?>
