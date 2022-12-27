<li><?= $this->Html->link(
    __('Logs'),
    ['controller' => 'Logs', 'action' => 'index'],
    ['class' => $controller=='Logs' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Songs'),
    ['controller' => 'Songs', 'action' => 'index'],
    ['class' => $controller=='Songs' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Ideas'),
    ['controller' => 'Ideas', 'action' => 'index'],
    ['class' => $controller=='Ideas' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Dates'),
    ['controller' => 'Dates', 'action' => 'index'],
    ['class' => $controller=='Dates' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Files'),
    ['controller' => 'Files', 'action' => 'index'],
    ['class' => $controller=='Files' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Collections'),
    ['controller' => 'Collections', 'action' => 'index'],
    ['class' => $controller=='Collections' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Locations'),
    ['controller' => 'Locations', 'action' => 'index'],
    ['class' => $controller=='Locations' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
    __('Mails'),
    ['controller' => 'Mails', 'action' => 'index'],
    ['class' => $controller=='Mails' ? 'active' : '']
) ?></li>
