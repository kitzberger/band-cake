<div class="songs view large-9 medium-8 columns content">
    <h3>
        <?= h($song->title) ?>
        <?php $this->assign('title', $song->title); ?>
        <small>
            <?= $this->Html->link('<i class="fi-pencil"></i> ' . __('Edit'), ['controller' => 'Songs', 'action' => 'edit', $song->id], ['escape' => false]) ?>
            <?php
                if ($currentUser['is_admin']) {
                    echo $this->Form->postLink(
                        '<i class="fi-trash"></i> ' . __('Delete'),
                        ['action' => 'delete', $song->id],
                        ['confirm' => __('Are you sure you want to delete "{0}"?', $song->title), 'escape' => false]
                    );
                }
            ?>
        </small>
        <small class="right">
            <?php
            if ($song->text) {
                echo $this->Html->link(
                    __('Tabs/Chords'),
                    ['controller' => 'Songs', 'action' => 'display', $song->id],
                    ['escape' => false, 'class' => 'button small success']
                );
            }
            ?>
        </small>
    </h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $song->has('user') ? $this->element('username', ['user' => $song->user]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->element('date', ['date' => $song->created]) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= $this->element('date', ['date' => $song->modified]) ?></td>
        </tr>
        <?php if ($song->artist): ?>
        <tr>
            <th><?= __('Artist') ?></th>
            <td><?= $this->Html->link(h($song->artist), ['controller' => 'Songs', 'action' => 'index', 'sword' => $song->artist]) ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <th><?= __('Tabs/Chords') ?></th>
            <td><?php
                if ($song->text) {
                    echo $this->Html->link('<i class="fi-page"></i> ' . urldecode($song->url), ['controller' => 'Songs', 'action' => 'display', $song->id], ['escape' => false]);
                }
                ?>
            </td>
        </tr>
        <tr>
            <th>
                <?= __('Versions') ?>
                <?= $this->Html->link(
                    __('<i class="fi-page-add"></i>'),
                    [
                        'controller' => 'SongsVersions',
                        'action' => 'add',
                        '?' => [
                            'song_id' => $song->id,
                        ],
                    ],
                    ['escape' => false]
                ); ?>
            </th>
            <td>
                <?php
                    if (count($song->versions)) {
                        echo '<table class="versions">';
                        echo '<tr><th>Name</th><th>Length</th><th>Reference file</th><th>Modified</th></tr>';
                        foreach ($song->versions as $version) {
                            echo '<tr>';
                            echo '<td>' . $this->Html->link($version->title, ['controller' => 'SongsVersions', 'action' => 'view', $version->id]) . '</td>';
                            echo '<td>' . $this->element('duration', ['seconds' => $version->length]) . '</td>';
                            if (count($version->files)) {
                                echo '<td>';
                                foreach ($version->files as $file) {
                                    echo $this->element('Files/embed-inline', ['file' => $file]);
                                }
                                echo '</td>';
                            } else {
                                echo '<td></td>';
                            }
                            echo '<td>' . $this->element('date', ['date' => $version->modified]) . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '-';
                    }
                ?>
            </td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Comments') ?></h4>
        <?= $this->element('Comments/list', ['comments' => $song->comments]); ?>
        <?= $this->element('Comments/new', ['comment' => null, 'song_id' => $song->id]); ?>
    </div>
    <div class="related">
        <h4><?= __('Files') ?></h4>
        <?= $this->element('Files/upload', ['song_id' => $song->id]); ?>
        <?= $this->element('Files/list', ['files' => $song->files]); ?>
    </div>
    <div class="related">
        <h4><?= __('Collections') ?></h4>
        <?= $this->element('Collections/list', ['collections' => $song->collections]) ?>
    </div>
</div>
