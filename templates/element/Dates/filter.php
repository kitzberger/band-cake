<ul class="button-group button-group-dates">
    <li><a href="#" class="tiny button" data-status="<?= \App\Model\Entity\Date::STATUS_DEFAULT ?> ">Default</a></li>
    <li>&nbsp;&nbsp;</li>
    <li><a href="#" class="tiny button warning" data-status="<?= \App\Model\Entity\Date::STATUS_UNCONFIRMED ?> " >Unconfirmed</a></li>
    <li><a href="#" class="tiny button success" data-status="<?= \App\Model\Entity\Date::STATUS_CONFIRMED ?> " >Confirmed</a></li>
    <li><a href="#" class="tiny button alert" data-status="<?= \App\Model\Entity\Date::STATUS_CANCELED ?> " >Canceled</a></li>
    <li>&nbsp;&nbsp;</li>
    <li><a href="#" class="tiny button blocker" data-status="<?= \App\Model\Entity\Date::STATUS_BLOCKER ?> ">Blocker</a></li>
</ul>
