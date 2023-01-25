<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php
            echo $this->Html->link(__('View Post'), ['controller'=>'Users', 'action' => 'postview', $comment->userid, $comment->postid ], ['class' => 'side-nav-item']);
            ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comment form content">
            <?= $this->Form->create($comment) ?>
            <fieldset>
                <legend><?= __('Edit Comment') ?></legend>
                <?php
                echo $this->Form->control('comment');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>