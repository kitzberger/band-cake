<li><?= $this->Html->link(
    __('Users'),
    ['controller' => 'Users', 'action' => 'index'],
    ['class' => $controller=='Users' ? 'active' : '']
) ?></li>
<li><?= $this->Html->link(
                  __('Shares'),
                  ['controller' => 'Shares', 'action' => 'index'],
                  ['class' => $controller=='Shares' ? 'active' : '']
              ) ?></li>
<li><?= $this->Html->link(
                  __('Comments'),
                  ['controller' => 'Comments', 'action' => 'index'],
                  ['class' => $controller=='Comments' ? 'active' : '']
              ) ?></li>
<li><?= $this->Html->link(
                  __('Votes'),
                  ['controller' => 'Votes', 'action' => 'index'],
                  ['class' => $controller=='Votes' ? 'active' : '']
              ) ?></li>
