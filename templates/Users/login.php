<?php
use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= Configure::read('App.titleShort') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('bandcake.css') ?>
</head>
<body class="home">
    <?= $this->Flash->render() ?>
    <header>
        <div class="header-image">
            <h1><?= Configure::read('App.titleFull') ?></h1>
            <div class="home-login-form">
                <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
                <fieldset>
                    <legend><?= __('Please enter your username and password') ?></legend>
                    <?= $this->Form->control('username', ['autofocus']) ?>
                    <?= $this->Form->control('password') ?>
                    <?= $this->Form->control('redirect', ['type' => 'hidden', 'value' => $redirect]) ?>
                </fieldset>
                <?= $this->Form->button(__('Login')); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </header>
</body>
</html>
