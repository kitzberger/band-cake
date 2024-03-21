<div class="songs form large-9 medium-8 columns content">
    <?= $this->Form->create($song) ?>
    <fieldset>
        <legend><?= __('Edit Song') ?></legend>
        <?php
            $this->Form->setTemplates(['formGroup' => '{{label}}{{hint}}{{input}}']);

            echo $this->Form->control('title');
            echo $this->Form->control('artist');
            if ($currentUser['is_admin']) {
                echo $this->Form->control('bands._ids', ['options' => $bands]);
                echo $this->Form->control('is_pseudo');
                if ($githubEnabled) {
                    echo $this->Form->control('url', ['label' => __('URL') . ' (' . \Cake\Core\Configure::read('Github.repository_url') . ')']);
                }
            }
            if (empty($song->url)) {
                echo $this->Form->control('text', [
                    'autofocus' => 1,
                    'templateVars' => [
                        'hint' => '<p class="hint">Supports <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">markdown</a> syntax.</p>',
                    ]
                ]);
            }
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
