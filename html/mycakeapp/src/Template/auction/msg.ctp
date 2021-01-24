<?php if (!empty($bidinfo)) : ?>
<h2>商品「<?= $bidinfo->biditem->name ?>」</h2>
<h3>※メッセージ情報</h3>
<h6>※メッセージを送信する</h6>
<?php endif; ?>
<?= $this->Form->create($bidmsg) ?>
<?= $this->Form->hidden('bidinfo_id', ['value' => $bidinfo->id]) ?>
<?= $this->Form->hidden('user_id', ['value' => $authuser['id']]) ?>
<?= $this->Form->textarea('message', ['row' => 2]); ?>
<?= $this->Form->button('submit') ?>
<?= $this->Form->end(); ?>
<table cellpadding="0" cellspacing="0" ?>
    <thead>
        <tr>
            <th scope="col">送信者</th>
            <th class="main" scope="col">メッセージ</th>
            <th scope="col">送信時間</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($bidmsgs)) : ?>
        <?php foreach ($bidmsgs as $msg) : ?>
        <tr>
            <td><?= h($msg->user->username) ?></td>
            <td><?= h($msg->message) ?></td>
            <td><?= h($msg->created) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
