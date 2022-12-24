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
        <div class='fc-event' data-start-time="15:00" data-stop-time="19:00">Probe 15 Uhr</div>
        <div class='fc-event' data-start-time="16:00" data-stop-time="20:00">Probe 16 Uhr</div>
        <div class='fc-event' data-start-time="17:00" data-stop-time="21:00">Probe 17 Uhr</div>
        <div class='fc-event' data-start-time="18:00" data-stop-time="22:00">Probe 18 Uhr</div>
    </div>
</div>
