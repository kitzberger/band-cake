<?php
    if (count($song->versions) > 1) {
        $chosenVersion = $song->_joinData->song_version_id;
        $chosenVersionTitle = 'Unknown'; ?>
<div class="button-group button-group-versions">
    <ul id="drop-song-<?= $song->id ?>" class="f-dropdown"
        data-dropdown-content
        aria-hidden="true"
        tabindex="-1"
        data-url-set-version="<?= $this->Url->build(['controller' => 'Collections', 'action' => 'setSongVersion', $collection->id, $song->id]) ?>"
        data-user-id="<?= $currentUser['id'] ?>"
        data-csrf-token="<?= $_csrfToken ?>">
    <?php
        echo sprintf(
            '<li><a href="javascript:" onclick="setVersion(this,%d,%d,null); return false">&nbsp;</a></li>',
            $collection->id,
            $song->id
        );
        foreach ($song->versions as $version) {
            if ($version->id === $chosenVersion) {
                $chosenVersionTitle = $version->title;
            }
            echo sprintf(
                '<li><a id="song-version-%d" href="javascript:" onclick="setVersion(this,%d,%d,%d); return false">%s</a></li>',
                $version->id,
                $collection->id,
                $song->id,
                $version->id,
                h($version->title)
            );
        } ?>
    </ul>
    <a class="button tiny split">
        <div id="song-<?= $song->id ?>-version-title"><?= $chosenVersionTitle ?></div>
        <span data-dropdown="drop-song-<?= $song->id ?>" aria-controls="drop" aria-expanded="false"></span>
    </a>
</div>
<?php
    } elseif (count($song->versions) === 1) { ?>
    <span class="button tiny">
        <?= h($song->versions[0]->title) ?>
    </span>
<?php } ?>
