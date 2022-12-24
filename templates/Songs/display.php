<div class="songs view large-9 medium-8 columns content">
    <h3>
        <?= h($song->title) ?>
        <?php $this->assign('title', $song->title); ?>
        <small>
            <?= $this->Html->link(__('Show'), ['controller' => 'Songs', 'action' => 'view', $song->id]) ?>
        </small>
        <?php if ($song['text']) { ?>
        <small class="right">
            <?= $this->Html->link('<i class="fi-arrow-left"></i>', ['controller' => 'Songs', 'action' => 'display', $song->id, 'transposeBy' => (int)$transposeBy+1], ['escape' => false, 'class' => 'button small', 'title' => __('Capo left')]) ?>
            <?= $this->Html->link('<i class="fi-arrows-in"></i>', ['controller' => 'Songs', 'action' => 'display', $song->id], ['escape' => false, 'class' => 'button small', 'title' => __('Standard')]) ?>
            <?= $this->Html->link('<i class="fi-arrows-out"></i>', ['controller' => 'Songs', 'action' => 'display', $song->id, 'transposeBy' => 'auto'], ['escape' => false, 'class' => 'button small', 'title' => __('Capo off')]) ?>
            <?= $this->Html->link('<i class="fi-arrow-right"></i>', ['controller' => 'Songs', 'action' => 'display', $song->id, 'transposeBy' => (int)$transposeBy-1], ['escape' => false, 'class' => 'button small', 'title' => __('Capo right')]) ?>
            <?= $this->Html->link('<i class="fi-page-pdf"></i> ' . __('PDF'), ['controller' => 'Songs', 'action' => 'display', $song->id, 'transposeBy' => $transposeBy, '_ext' => 'pdf', 'mode' => 'full'], ['escape' => false, 'class' => 'button small success']) ?>
            <?= $this->Html->link('<i class="fi-page-pdf"></i> ' . __('PDF (Text)'), ['controller' => 'Songs', 'action' => 'display', $song->id, 'transposeBy' => $transposeBy, '_ext' => 'pdf', 'mode' => 'text'], ['escape' => false, 'class' => 'button small success']) ?>
            <?= $this->Html->link('<i class="fi-page-pdf"></i> ' . __('PDF (Chords)'), ['controller' => 'Songs', 'action' => 'display', $song->id, 'transposeBy' => $transposeBy, '_ext' => 'pdf', 'mode' => 'chords'], ['escape' => false, 'class' => 'button small success']) ?>
        </small>
        <?php }?>
    </h3>

    <?php if ($song['text']) { ?>
        <div class="markdown mode-<?= $mode ?>"><?= $this->Markdown->transform($this->Chord->render($song['text'], ['transposeBy' => $transposeBy, 'mode' => $mode])) ?></div>
    <?php } ?>
</div>
