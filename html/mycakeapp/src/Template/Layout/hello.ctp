<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->Charset() ?>
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->css('hello') ?>
    <?= $this->Html->script('hello') ?>
</head>

<body>
    <header class="head row">
        <h1><?= $this->fetch('title') ?></h1>
    </header>
    <div class="content row">
        <?= $this->fetch('content') ?>
    </div>
    <footer class="foot row">
        <h5>copyright 2021 yui</h5>
    </footer>
</body>

</html>
