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
                    // echo $this->Form->select(
                    //     'user_type',
                    //     ['admin', 'user'],
                    //     ['empty' => 'user type']
                    // );
                    echo $this->Form->control('image_file',['type'=>'file' , 'required' => false]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <!-- <button type="button" onclick = saveUserajax()>Save by ajax</button> -->
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- <script>

    
    $('#saveajax').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        $.ajax({
            url: "http://localhost:8765/users/save",
            method: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(response) {
                alert("ajax data");     
            }
                });
            });

            
</script> -->

<script>
    $(document).ready(function(){      
  $("#saveajax").validate({
    rules: {
        name:{
            required: true,
            minlength : 3,
            text: true
        },
        email: {
            required : true,
            email : true,
            // remote:{ 
            //   url: "checkemail.php",
            //   type: "POST",
            //  },
        },
        password: {
            required : true,
        },
        image_file:{
            required : true,
        }

        
       
    },
    messages: {
        name: {
            required: "please enter name",
            minlength: "length atleast 3 characters",
            text: "please enter alphabets",
        },

        email: {
            required : "please enter email",
            email: "please enter valid email address",
            remote: "email exist",
        },
        password :{
            required: "please enter password",
        },
        image_file :{
            required: "please select file",
        }
        
    }, 

   submitHandler: function(form){

    $('#saveajax').on('submit', function(e) {
             e.preventDefault();
             
             var formData = new FormData(this);
             $.ajax({
                 url: "http://localhost:8765/users/save",
                 type: "POST",
                 cache: false,
                 data: formData,
                 processData: false,
                 contentType: false,
                 dataType: "JSON",
                 success: function(data) {
                    alert(data);
                    }
                });
     });
   } 

  });    

}); 

</script> 

