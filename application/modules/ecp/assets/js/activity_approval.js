$(document).ready(function(){
    $('#month').datepicker({
        format: "yyyy-mm",
        autoclose: true
    })
});

/*
$('#month').on('change',function(){
    alert('in');
    var months = $(this).val();

    $.ajax({
        type: 'POST',
        url: site_url+'ecp/activity_planning_edit_view',
        data: {id:id},
        success: function(resp){
            $('#middle_container_product').html(resp);
            $('.selectpicker').selectpicker('refresh');
        }
    });
    return false;
});
*/

$(document).on('change', 'select#approval_status', function () {
   var status_id = $('option:selected', this).val();
   var planning_id = $('option:selected', this).attr('attr-id');

    $.ajax({
        type: 'POST',
        url: site_url+"ecp/change_status_activity",
        data: {status_id:status_id,planning_id:planning_id},
        dataType : 'json',
        success: function(resp){

            var message = "";
            if(resp != 0){
                message += 'Data Update successfully.';
            }
            else{

                message += 'Data not Updated.';
            }
            $('<div></div>').appendTo('body')
                .html('<div><b>'+message+'</b></div>')
                .dialog({
                    appendTo: "#success_file_popup",
                    modal: true,
                    zIndex: 10000,
                    autoOpen: true,
                    width: 'auto',
                    resizable: true,
                    close: function (event, ui) {
                        $(this).remove();
                        location.reload();
                    }
                });
        }
    });

});

$(document).on('click', '.edit_i', function () {
    var id = $(this).attr('prdid');
   // alert(id) ;
    $.ajax({
        type: 'POST',
        url: site_url+'ecp/activity_planning_edit_view',
        data: {id:id},
        success: function(resp){
            $('#middle_container_product').html(resp);
            $('.selectpicker').selectpicker('refresh');
        }
    });
    return false;
});