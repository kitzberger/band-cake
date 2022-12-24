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
?>


<h1><?= $date['title'] ?: '[No title]' ?></h1>

<dl>
    <dt>Beginn</dt><dd><?= $date['begin'] ?></dd>
    <dt>Ende</dt><dd><?= $date['end'] ?></dd>
    <dt>Text</dt><dd><?= $date['text'] ?></dd>
</dl>
