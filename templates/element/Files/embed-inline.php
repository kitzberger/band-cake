<?php

$fileFormat = $file->getExtension();

if ($file->isMissing()) {
    echo '[missing]';
} else {
    switch ($fileFormat) {
        case 'mpeg':
        case 'mp4':
        case 'ogg':
        case 'wav':
            ?>
                <a class="button round no-margin tiny" onclick="playInWaveform(this); return false" data-audioplayer='<?= json_encode($file->getAudioPlayerData()) ?>'>
                    <i class="fi fi-play"></i>
                    <?= __('Play') ?>
                </a>
                <?= $this->Html->link('<i class="fi-download"></i> ' . __('Download'), $file->getRelativePath(), ['class' => 'button round tiny', 'escape' => false]); ?>
                <!--
                    <audio controls style="height: 30px">
                        <source src="<?= $file->getRelativePath() ?>" type="audio/<?= $fileFormat ?>">
                    </audio>
                -->
            <?php
            break;
        case 'jpg':
        case 'jpeg':
        case 'gif':
        case 'png':
            echo $this->Glide->image($file->file, ['w' => 50], []);
            break;
        default:
            echo $this->Html->link('<i class="fi-download"></i> ' . __('Download'), $file->getRelativePath(), ['class' => 'button small', 'escape' => false]);
    }
}
