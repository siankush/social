<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

    <!-- <style>
        .imgfile{
            max-width: 60px;
        }
     </style>   
     -->
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div id="message"></div>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user,['id'=>'saveajax','enctype'=>'multipart/form-data']) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->select(
                        'user_type',
                        ['admin', 'user'],
                        ['empty' => 'user type']
                    );
                    echo $this->Form->control('image_file',['type'=>'file' , 'required' => false]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <button type="button" onclick = saveUserajax()>Save by ajax</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function saveUserajax(){
        // alert('cakephp');
        $.ajax({
            
            method: 'POST',
            url: 'http://localhost:8765/users/saveUserajax',
            data: $('#saveajax').serialize(),
            success:function(result){              
                $("#message").html('data is inserted');
             },
        });
    }
</script>
    
