<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset(); ?>
    <?= $this->fetch('title') ?>
</head>

<body>
    <p>以下のレコードを削除しますか？</p>
    <div>id:<?= $entity['id'] ?></div>
    <div>name:<?= $entity['name'] ?></div>
    <div>mail:<?= $entity['mail'] ?></div>
    <div>age:<?= $entity['age'] ?></div>
    <?= $this->Form->create(
        $entity,
        [
            'type' => 'post',
            'url' => [
                'controller' => 'People',
                'action' => 'destroy'
            ]
        ]
    ) ?>
    <?= $this->Form->hidden('People.id') ?>
    <?= $this->Form->submit('削除する') ?>
    <?= $this->Form->end() ?>
</body>

</html>
