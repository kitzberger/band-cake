<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->css(WWW_ROOT . 'css/pdf.css') ?>

    <?= $this->fetch('css') ?>
</head>
<body>

<div class="pdf">
    <?= $this->fetch('content') ?>
</div>

</body>
</html>
