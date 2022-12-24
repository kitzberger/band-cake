<?php

$fileFormat = $file->getExtension();
$filePath = 'uploads' . DS . $file->file;

if ($file->isMissing()) {
    echo '[missing]';
} else {
    switch ($fileFormat) {
        case 'mpeg':
        case 'mp4':
        case 'ogg':
        case 'wav':
            ?>
                <audio controls style="height: 30px">
                    <source src="<?= DS . $filePath ?>" type="audio/<?= $fileFormat ?>">
                </audio>
            <?php
            break;
        case 'jpg':
        case 'jpeg':
        case 'gif':
        case 'png':
            echo $this->Glide->image($file->file, ['w' => 50], []);
            break;
        default:
            echo $this->Html->link('<i class="fi-download"></i> ' . __('Download'), $filePath, ['class' => 'button small', 'escape' => false]);
    }
}
