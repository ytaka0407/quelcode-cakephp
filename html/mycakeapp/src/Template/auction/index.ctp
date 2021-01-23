<h2>ミニオークション!</h2>
<h3>※出品されている商品</h3>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th class="mail" scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->paginator->sort('finished') ?></th>
            <th scope="col"><?= $this->Paginator->sort('endtime') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($auction as $biditem) : ?>
        <tr>
            <td><?= h($biditem->name); ?></td>
            <td><?= h($biditem->finished ? 'Finished' : ''); ?></td>
            <td><?= h($biditem->endtime); ?></td>
            <td clss="actions" )>
                <?= $this->Html->Link(__('View'), ['action' => 'view', $biditem->id]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<<' . __('first')) ?>
        <?= $this->paginator->prev('<' . __('prvious')) ?>
        <?= $this->Paginator->next(__('next') . '>') ?>
        <?= $this->paginator->last(__('last') . '>>') ?>
    </ul>
</div>
