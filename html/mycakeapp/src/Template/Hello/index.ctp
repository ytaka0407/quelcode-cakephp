<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <?= $this->Html->charset(); ?>
</head>

<body>
    <header class="row">
        <h1><?= $title ?></h1>
    </header>
    <div class="row">
        <table>
            <?= $this->Form->create() ?>
            <tr>
                <th>name</th>
                <td><?= $this->Form->text('name') ?></td>
            </tr>
            <tr>
                <th>mail</th>
                <td><?= $this->Form->text('mail') ?></td>
            </tr>
            <tr>
                <th>age</th>
                <td><?= $this->Form->text('age') ?></td>
            </tr>
            <tr>
                <th></th>
                <td><?= $this->Form->submit('submit') ?></td>
            </tr>
            <?= $this->Form->end() ?>
        </table>
    </div>
</body>

</html>
