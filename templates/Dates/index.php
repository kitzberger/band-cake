<div class="dates index large-9 medium-8 columns content">
    <h3>
        <?= __('Dates') ?>
        <small>
            <?= $this->Html->link('<i class="fi-page-add"></i> ' . __('New'), ['controller' => 'Dates', 'action' => 'add'], ['escape' => false]) ?>
        </small>
    </h3>
    <?= $this->element('sword', ['sword' => $sword]) ?>

    <?php
        if (empty($sword)) {
            echo $this->element('Dates/calendar');
            echo $this->element('Dates/filter');
            echo $this->element('Dates/list');
        } else {
            echo $this->element('Dates/filter');
            echo $this->element('Dates/list');
            echo $this->element('Dates/calendar');
        }
    ?>
</div>
