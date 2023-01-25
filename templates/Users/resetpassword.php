<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tableinfo $tableinfo
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tableinfo'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tableinfo form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <legend><?= __('update password') ?></legend>
                <?php
                    echo $this->Form->control('password');
                ?>
            </fieldset>
            <?= $this->Form->button(__('update')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
