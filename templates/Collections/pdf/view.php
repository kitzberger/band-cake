<?php $this->assign('title', $collection->title); ?>

<style>
h1 { font-size: 50px; }
table { width: 100%; font-size: 30px; }
table th,
table td { text-align: left; padding-right: 20px; padding-bottom: 10px; }
table td.index { width: 8%; text-align: right; color: #ccc; }
table td.title { width: 80% }
table td.length { width: 12%; font-size: 0.6em; text-align: right; }
</style>

<h1><?= $collection->title ?></h1>

<?php if (!empty($collection->songs)): ?>
<table cellpadding="0" cellspacing="0">
    <?php
        $i=1;
        $totalLength = 0;
        foreach ($collection->songs as $song):
            $chosenVersion = $song->_joinData->song_version_id;
            switch (count($song->versions)) {
                case 0:
                    $songLength = 0;
                    break;
                case 1:
                    $songLength = $song->versions[0]->length;
                    break;
                default:
                    foreach ($song->versions as $version) {
                        if ($version->id === $chosenVersion) {
                            $songLength = $version->length;
                            break;
                        }
                    }
            }
            $totalLength += $songLength;
    ?>
    <tr>
        <td class="index"><?= $song->is_pseudo ? '' : $i++ ?></td>
        <td class="title"><?= $song->is_pseudo ? '&nbsp;' : $song->title ?></td>
        <td class="length"><?= $this->element('duration', ['seconds' => $songLength, 'format' => 'i:s']) ?></td>
    </tr>
    <?php endforeach; ?>
    <?php if ($totalLength): ?>
    <tr>
        <td colspan="2"></td>
        <td class="length"><b><?= $this->element('duration', ['seconds' => $totalLength, 'format' => 'H:i:s']) ?></b></td>
    </tr>
    <?php endif; ?>
</table>
<?php endif; ?>
