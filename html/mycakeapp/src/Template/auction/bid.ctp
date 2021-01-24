<h1>「<?= $biditem->name ?>の情報」</h1>
<?= $this->Form->create($bidrequest) ?>
<fieldset>
    <legend>
        <?__('※入札を行う。')?>
    </legend>
    <?php
    echo $this->Form->hidden('biditem_id', ['value' => $bidrequest->biditems_id]);
    echo $this->Form->hidden('user_id', ['value' => $bidrequest->user_id]);
    echo $this->Form->control('price');
    ?>
</fieldset>
<?= $this->Form->button(__('submit')) ?>
<?= $this->Form->end() ?>
