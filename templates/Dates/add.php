<div class="dates form large-9 medium-8 columns content">
    <?= $this->Form->create($date) ?>
    <fieldset>
        <legend><?= __('Add Date') ?></legend>
        <?php

            if ($date->is_fullday) {
                $class = 'date';
                $format = \Cake\Core\Configure::read('DateFormat');
                $formatBegin = \Cake\Core\Configure::read('DateFormat');
            } else {
                $class = 'datetime';
                $format = \Cake\Core\Configure::read('DateTimeFormat');
                $formatBegin = \Cake\Core\Configure::read('DateTimeFormatBegin');
            }

            echo $this->Form->control('begin', [
                'class' => $class,
                'type' => 'text',
                'format' => $format,
                'default' => date($format),
                'value' => !empty($date->begin) ? $date->begin->format($format) : date($formatBegin)
            ]);
            echo $this->Form->control('end', [
                'class' => $class,
                'type' => 'text',
                'format' => $format,
                'default' => date($format),
                'empty' => true,
                'value' => !empty($date->end) ? $date->end->format($format) : ''
            ]);
            echo '<input type="checkbox" name="is_fullday" id="full-day" onchange="changeDateFields()" ' . ($date->is_fullday ? "checked" : "") . ' value="1"><label for="full-day">Full-Day?</label>';
            echo $this->Form->control('title');
            echo $this->Form->control('location_id', ['options' => $locations, 'empty' => true]);
            echo '<div class="input radio">';
            echo $this->Form->label('status');
            echo '<div>';
            echo $this->Form->radio('status', [
                \App\Model\Entity\Date::STATUS_BLOCKER => __('Blocker'),
                \App\Model\Entity\Date::STATUS_DEFAULT => __('Default'),
                \App\Model\Entity\Date::STATUS_UNCONFIRMED => __('Gig (unconfirmed)'),
                \App\Model\Entity\Date::STATUS_CONFIRMED => __('Gig (confirmed)'),
                \App\Model\Entity\Date::STATUS_CANCELED => __('Gig (cancelled)'),
            ], ['default' => 0]);
            echo '</div>';
            echo '</div>';
            echo $this->Form->control('text');
        ?>
    </fieldset>
    <?= $this->element('Forms/UserSelect') ?>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
