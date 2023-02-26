<div class="collections view large-9 medium-8 columns content">
    <h3>
        <?= h($collection->title) ?>
        <?php $this->assign('title', $collection->title); ?>
        <small class="hide-for-print">
            <?php
                if ($currentUser['is_active']) {
                    echo $this->Html->link('<i class="fi-pencil"></i> ' . __('Edit'), ['controller' => 'Collections', 'action' => 'edit', $collection->id], ['escape' => false]);
                    echo ' ';
                    echo $this->Html->link('<i class="fi-page-copy"></i> ' . __('Copy'), ['controller' => 'Collections', 'action' => 'add', $collection->id], ['escape' => false]);
                    echo ' ';
                }
                if ($currentUser['is_active'] == 1 && $currentUser['id'] == $collection->user_id) {
                    echo $this->Form->postLink(
                        '<i class="fi-trash"></i> ' . __('Delete'),
                        ['action' => 'delete', $collection->id],
                        ['confirm' => __('Are you sure you want to delete "{0}"?', $collection->title), 'escape' => false]
                    );
                }
            ?>
        </small>
        <small class="right hide-for-print">
            <?php
                echo $this->element('Button/ShareLink', ['passiveUsers' => $passiveUsers, 'controller' => 'Collections', 'record' => $collection]);

                echo $this->Html->link('<i class="fi-page-pdf"></i> ' . __('Get PDF'), ['controller' => 'Collections', 'action' => 'view', $collection->id, '_ext' => 'pdf'], ['escape' => false, 'class' => 'button small success'])
            ?>
        </small>
    </h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $collection->has('user') ? $this->element('username', ['user' => $collection->user]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->element('date', ['date' => $collection->created]) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->element('date', ['date' => $collection->modified]) ?></td>
        </tr>
        <tr>
            <th><?= __('Shared with') ?></th>
            <td><?= $this->element('shares', ['shares' => $collection->shares]) ?></td>
        </tr>
    </table>

    <div class="related">
        <h4><?= __('Comments') ?></h4>
        <?= $this->element('Comments/list', ['comments' => $collection->comments]); ?>
        <?= $this->element('Comments/new', ['comment' => null, 'collection_id' => $collection->id]); ?>

        <?php if ($currentUser['is_active']): ?>
        <?= $this->element('Files/upload', ['collection_id' => $collection->id]); ?>
        <hr>
        <?php endif; ?>

        <?php if (!empty($collection->files)): ?>
        <h4><?= __('Related Files') ?></h4>
        <?= $this->element('Files/gallery', ['files' => $collection->files]); ?>
        <table cellpadding="0" cellspacing="0" class="related-files audio-player">
            <tr>
                <th class="index"></th>
                <th><?= __('Record') ?></th>
                <th><?= __('File') ?></th>
                <th><?= __('Reference') ?></th>
                <th><?= __('Preview') ?></th>
            </tr>
            <?php
                $i=1;
                foreach ($collection->files as $file):
            ?>
            <tr class="item item-<?= $file->getType() ?>">
                <td class="index"><?= $i++ ?></td>
                <td>
                    <?= $file->has('date') ? __('Date') . ': ' . $this->Html->link($file->date->title, ['controller' => 'Dates', 'action' => 'view', $file->date->id]) : '' ?>
                    <?= $file->has('idea') ? __('Idea') . ': ' . $this->Html->link($file->idea->title, ['controller' => 'Ideas', 'action' => 'view', $file->idea->id]) : '' ?>
                    <?= $file->has('song') ? __('Song') . ': ' . $this->Html->link($file->song->title, ['controller' => 'Songs', 'action' => 'view', $file->song->id]) : '' ?>
                </td>
                <td>
                    <?= $this->Html->link(__($file->title), ['controller' => 'Files', 'action' => 'view', $file->id]) ?>
                </td>
                <td>
                    <?= $file->is_public ? '<i class="fi-check"></i>' : '' ?>
                </td>
                <td>
                    <?= $this->element('Files/embed-inline', ['file' => $file]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

        <?php if (!empty($collection->songs)): ?>
        <h4><?= __('Related Songs') ?></h4>
        <table cellpadding="0" cellspacing="0" class="related-songs">
            <tr>
                <th class="index"></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Version') ?></th>
                <th><?= __('Reference file') ?></th>
                <th></th>
            </tr>
            <?php
                $i=1;
                foreach ($collection->songs as $song):
            ?>
            <tr>
                <td class="index"><?= $song->is_pseudo ? '' : $i++ ?></td>
                <td>
                    <?php
                        if ($song->is_pseudo) {
                            echo '&nbsp;';
                        } else {
                            if ($song->text) {
                                echo $this->Html->link($song->title, ['controller' => 'Songs', 'action' => 'display', $song->id]);
                            } else {
                                echo $this->Html->link($song->title, ['controller' => 'Songs', 'action' => 'view', $song->id]);
                            }
                        }
                    ?>
                </td>
                <td>
                    <?= $this->element('versions', ['collection' => $collection, 'song' => $song]) ?>
                </td>
                <td>
                    <?php
                        $file = null;
                        // Selected version has a reference file?
                        foreach ($song->versions as $version) {
                            if ($version->id === $song->_joinData->song_version_id) {
                                $file = $version->files[0] ?? null;
                            }
                        }
                        // Otherwise use the song reference file.
                        if (empty($file)) {
                            $file = $song->files[0] ?? null;
                        }
                        if ($file) {
                            echo $this->element('Files/embed-inline', ['file' => $file]) . '<br>';
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
