<script type="text/javascript">
    $(document).ready(function () {
        $('#saveForm').submit(function(){
            //serialize form data
            var formData = $(this).serialize();
            //get form action
            var formUrl = $(this).attr('action');
            
            $.ajax({
                type: 'POST',
                url: formUrl,
                data: formData,
                success: function(data,textStatus,xhr){
                        alert(data);
                },
                error: function(xhr,textStatus,error){
                        alert(textStatus);
                }
            });	
                
            return false;
        })
    });
</script>