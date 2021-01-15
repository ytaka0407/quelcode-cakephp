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
        <pre><?php print_r($data); ?></pre>
    </div>
    <div class="row">
        <table>
            <?= $this->Form->create(null, ['type' => 'post', 'url' => ['controller' => 'Hello', 'action' => 'index']]) ?>
            <tr>
                <th>checkbox</th>
                <td><?= $this->Form->checkbox('Form1.check', ['id' => 'check1']) ?>
                    <?= $this->Form->label('check1', ['id' => 'チェックボックス']) ?></td>
            </tr>
            <tr>
                <th>RadioButton</th>
                <td><?= $this->Form->radio('Form1.radio', [
                        ['text' => 'male', 'value' => '男性'],
                        ['text' => 'female', 'value' => '女性']
                    ]) ?></td>
            </tr>
            <tr>
                <th>Select</th>
                <td>
                    <?= $this->Form->select('Form1.select', ['one' => '最初', 'two' => '2番目', 'three' => '真ん中', 'four' => '4番目', 'five' => '最後'], ['multiple' => true, 'empty' => true, 'size' => 5]) ?>
                </td>
            </tr>
            <th></th>
            <td><?= $this->Form->submit('submit') ?></td>
            </tr>
            <?= $this->Form->end() ?>
        </table>
    </div>
</body>

</html>
