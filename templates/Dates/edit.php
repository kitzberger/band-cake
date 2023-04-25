<div class="dates form large-9 medium-8 columns content">
    <?= $this->Form->create($date) ?>
    <fieldset>
        <legend><?= __('Edit Date') ?></legend>
        <?php
            $this->Form->setTemplates(['formGroup' => '{{label}}{{hint}}{{input}}']);
            echo $this->Form->control('title');

            if ($date->is_fullday) {
                $type = 'date';
                $format = \Cake\Core\Configure::read('DateFormat');
            } else {
                $type = 'datetime-local';
                $format = \Cake\Core\Configure::read('DateTimeFormat');
            }

            echo $this->Form->control('begin', [
                'class' => 'date',
                'type' => $type,
                'format' => $format,
                'default' => date($format),
                'value' => $date->begin->format($format)
            ]);
            echo $this->Form->control('end', [
                'class' => 'date',
                'type' => $type,
                'format' => $format,
                'default' => date($format),
                'value' => !empty($date->end) ? $date->end->format($format) : ''
            ]);

            echo '<input type="checkbox" name="is_fullday" id="full-day" onchange="changeDateFields()" ' . ($date->is_fullday ? "checked" : "") . ' value="1"><label for="full-day">Full-Day?</label>';
            echo $this->Form->control('location_id', ['options' => $locations, 'empty' => true]);
            echo '<div class="input radio">';
            echo $this->Form->label('status');
            echo '<div>';
            echo $this->Form->radio('status', [
                \App\Model\Entity\Date::STATUS_BLOCKER => __('Blocker'),
                \App\Model\Entity\Date::STATUS_DEFAULT => __('Default'),
                \App\Model\Entity\Date::STATUS_UNCONFIRMED => __('Gig (unconfirmed)'),
                \App\Model\Entity\Date::STATUS_CONFIRMED => __('Gig (confirmed)'),
                \App\Model\Entity\Date::STATUS_CANCELED => __('Gig (cancelled)')
            ]);
            echo '</div>';
            echo '</div>';
            echo $this->Form->control('text', [
                'autofocus' => 1,
                'templateVars' => [
                    'hint' => '<p class="hint">Supports <a href="https://www.markdownguide.org/cheat-sheet/" target="_blank">markdown</a> syntax.</p>',
                ]
            ]);
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
