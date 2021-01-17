<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset(); ?>
    <?= $this->fetch('title') ?>
</head>

<body>
    <p>This is People table records</p>
    <table>
        <thead>
            <?= $this->Html->tableHeaders(['id', 'name', 'mail', 'age', '']) ?>
        </thead>
        <?php foreach ($data->toArray() as $obj) : ?>
        <tr>
            <td><?= h($obj->id) ?></td>
            <td>
                <a
                    href="<?= $this->Url->build(['controller' => 'People', 'action' => 'edit']); ?>?id=<?= h($obj->id) ?>">
                    <?= h($obj->name); ?>
                </a>
            </td>
            <td><?= h($obj->mail) ?></td>
            <td><?= h($obj->age) ?></td>
            <td><a
                    href="<?= $this->Url->build(['controller' => 'People', 'action' => 'delete']); ?>?id=<?= h($obj->id) ?>">delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
