<div id="calendar-wrap" class="row">
    <div id="calendar"
         class="columns small-12 medium-10 large-10 no-padding-on-small"
         data-current-user="<?= $currentUser['id'] ?>"
         data-url-add="<?= $this->Url->build(['controller' => 'Dates', 'action' => 'add'])?>"
         data-url-view="<?= $this->Url->build(['controller' => 'Dates', 'action' => 'view'])?>"
         data-csrf-token="<?= $_csrfToken ?>";
         data-events='<?php
            $dateArray = [];
            foreach ($dates as $date) {
                $begin = $date->begin ? Cake\I18n\FrozenTime::parse($date->begin) : null;
                $end = $date->end ? Cake\I18n\FrozenTime::parse($date->end) : null;
                $dateArray[] = [
                    'title' => $date->title,
                    'start' => $begin,
                    'end' => $end,
                    'status' => 0,
                    'url' => $this->Url->build(['controller' => 'Dates', 'action' => 'view', $date->id]),
                    'color' => $this->element('Dates/status', ['date' => $date, 'mode' => 'hex']),
                ];
            }
            echo json_encode($dateArray, JSON_HEX_APOS);
        ?>'>
    </div>
    <div id="external-events" class="columns medium-2 hide-for-small-only">
        <h4><?= __('Date templates') ?></h4>
        <p>These items can be drag'n'dropped into the calendar</p>
        <?php
            foreach ([16,17,18,19] as $begin) {
                $end = $begin+4;
                echo '<div class="fc-event" data-start-time="' . $begin . ':00" data-stop-time="' . $end . ':00">';
                echo __('Rehearsal at {0}pm', $begin);
                echo '</div>';
            }
        ?>
    </div>
</div>
