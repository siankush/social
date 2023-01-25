<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

use Cake\Controller\Controller;

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <?= $this->Html->link(__('New Post'), ['action' => 'postadd', $user->id], ['class' => 'button float-right']) ?>
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($user->created_at) ?></td>
                </tr>
            </table>
            <h3><?= h("Your Post's..") ?></h3>
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('title') ?></th>
                        <th><?= $this->Paginator->sort('body') ?></th>
                        <th><?= $this->Paginator->sort('created_at') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user->post as $post) : ?>
                        <tr>
                            <td><?= h($post->id) ?></td>
                            <td><?= h($post->title) ?></td>
                            <td><?= h($post->body) ?></td>
                            <td><?= h($post->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'postview', $post->id, $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'postedit', $post->id, $user->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'postdelete', $post->id, $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>