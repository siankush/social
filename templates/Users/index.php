<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<html>
   <head>
    <title></title>
</head> 
<body>
<div class="users index content">
<?php  echo $this->Form->select(
                        'status',
                    ['Inactive','active'],['empty' => '(choose one)']);
                     ?>
   
<?= $this->Html->link(__('Add'), ['controller' => 'Users' ,'action' => 'save'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>


<?= $this->element('flash/tablelist'); ?>


    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

</body>
</html>
