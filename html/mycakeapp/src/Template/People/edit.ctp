<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset(); ?>
    <?= $this->fetch('title') ?>
</head>

<body>
    <?= $this->Form->create($entity, ['type' => 'post', 'url' => ['controller' => 'People', 'action' => 'update']]); ?>
    <?= $this->Form->hidden('People.id') ?>
    <div>name</div>
    <?= $this->Form->text('People.name') ?>
    <div>mail</div>
    <?= $this->Form->text('People.mail') ?>
    <div>age</div>
    <?= $this->Form->text('People.age') ?>
    <div><?= $this->Form->submit('送信') ?></div>
    <?= $this->Form->end() ?>
</body>

</html>
