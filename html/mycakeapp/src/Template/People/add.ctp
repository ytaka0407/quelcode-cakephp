<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset(); ?>
    <?= $this->fetch('title') ?>
</head>

<body>
    <p><?= $msg ?></p>
    <?= $this->Form->create($entity, ['type' => 'post', 'url' => ['controller' => 'People', 'action' => 'add']]) ?>
    <fieldset>
        <div>name:<?= $this->Form->error('People.name') ?></div>
        <div><?= $this->Form->text('People.name') ?></div>
        <div>mail:<?= $this->Form->error('People.mail') ?></div>
        <div><?= $this->Form->text('People.mail') ?></div>
        <div>age:<?= $this->Form->error('People.age') ?></div>
        <div><?= $this->Form->text('People.age') ?></div>

        <div>
            <?= $this->Form->submit('送信') ?>
        </div>
    </fieldset>
    <?= $this->Form->end() ?>
</body>

</html>
