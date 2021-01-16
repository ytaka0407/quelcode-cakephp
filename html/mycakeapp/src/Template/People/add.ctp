<!DOCTYPE html>

<head>
    <?= $this->Html->charset(); ?>
    <?= $this->fetch('title') ?>
</head>

<body>
    <?= $this->Form->create($entity, ['type' => 'post', 'url' => ['controller' => 'People', 'action' => 'create']]) ?>
    <div>name</div>
    <div><?= $this->Form->text('People.name') ?></div>
    <div>mail</div>
    <div><?= $this->Form->text('People.mail') ?></div>
    <div>age</div>
    <div><?= $this->Form->text('People.age') ?></div>
    <div>
        <?= $this->Form->submit('送信') ?>
    </div>
    <?= $this->Form->end() ?>
</body>
