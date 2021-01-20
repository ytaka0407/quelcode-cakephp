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
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('mail') ?></th>
            <th><?= $this->Paginator->sort('age') ?></th>
            <th>message</th>
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
            <td>
                <?php foreach ($obj->messages as $item) : ?>
                <?= h($item->message); ?><br>
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('|<<' . '最初へ') ?>
            <?= $this->Paginator->prev('<' . '前へ') ?>
            <?= $this->Paginator->next('>' . '次へ') ?>
            <?= $this->Paginator->last('>>|' . '最後へ') ?>
        </ul>
    </div>

</body>

</html>
