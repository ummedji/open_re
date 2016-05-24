//if (!('content' in CKEDITOR.instances)) {
//    CKEDITOR.replace('content');
//}
$(function() {
    var url = $("#action_url").val();
   // alert(url);
   
    $('#selectMailOption').delegate('input:radio', 'change', function(e) {
        var val = $(this).val();
         //alert(val);
        switch (val) {
            case 'SELECTED':
                ajax('get_all_users', '', 'sendMailContent');
                break;
           case 'Subscribed_user':
               $("#sendMailContent").html('');
               break;
            default :
                $("#sendMailContent").html('');
                break;
        }
    });
    $('#sendMailContent').delegate('#search_user', 'keyup', function(e) {
        var val = $(this).val();
        if (val !== '') {
        }
        ajax('get_all_users', {keyword: val}, 'user_email_list');
    });

    function ajax(action, data, target) {
        
        var request = $.ajax({
            url: url + '/' + action,
            data: data,
            type: 'GET'
        });
    //  alert(request);
        request.done(function(response) {
            $("#" + target).html(response);
        });
        request.fail(function() {
            console.log('Request Failed.');
        });
    }
});
