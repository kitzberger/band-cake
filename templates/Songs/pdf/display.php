<?php $this->assign('title', $song->title); ?>
<?php if ($song['text']) { ?>
    <div class="markdown mode-<?= $mode ?>"><?= $this->Markdown->transform($this->Chord->render($song['text'], ['transposeBy' => $transposeBy, 'mode' => $mode])) ?></div>
<?php } ?>
