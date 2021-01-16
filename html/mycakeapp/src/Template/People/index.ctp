<!DOCTYPE html>
<html>

<head>
    <?= $this->fetch('title') ?>
</head>

<body>
    <p>This is People table records</p>
    <table>
        <thead>
            <?= $this->Html->tableHeaders(['id', 'name', 'mail', 'age']) ?>
        </thead>
        <?php foreach ($data->toArray() as $obj) : ?>
        <tr>
            <td><?= h($obj->id) ?></td>
            <td>
                <?= h($obj->name); ?>
            </td>
            <td><?= h($obj->mail) ?></td>
            <td><?= h($obj->age) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
