
$(document).ready(function(){    
var csrfToken = $('meta[name="csrfToken"]').attr('content');

$('select').on('change', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
        }
    });
    
    var data = $(this).val();
    $.ajax({
        url: "http://localhost:8765/users/getuser",
        data: {'status':data},
        type: "json",
        method: "get",
        success:function(response){
            // code will work in case of json retun from the ajax start here
            res = JSON.parse(response);
            var tabel_html = '<table><thead><tr><th>id</th><th>name</th><th>email</th><th>created_at</th><th>user_type</th><th>status</th><th>Actions</th></tr></thead>';
            tabel_html += '<tbody>';
            $.each(res, function (key, val) {
                    tabel_html += '<tr><td>'+val.id+'</td><td>'+val.name+'</td><td>'+val.email+'</td><td>'+val.created_at+'</td><td>'+val.user_type+'</td><td>'+val.status+'</td><td class="actions"></td></tr>';
                
            })
            tabel_html +='</tbody>';
            tabel_html +='</table>';
            $('.table-responsive').html(tabel_html);
             // code will work in case of json retun from the ajax end here
             
            // code will work in case cakephp element render start here \
            // $('.table-responsive').html(response);
            // code will work in case cakephp element render end here 
        }
    });
});
});

