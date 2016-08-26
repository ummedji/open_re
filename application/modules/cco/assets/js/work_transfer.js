$(document).on("change","#cco_data",function(e){
    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_allocated_work",
        data: {cco:this.value},
        success: function(resp){
            $('#cco_work_details').html(resp);
        }
    });
});

$(document).on("click","#alot_transfer",function(e){

    var cco_id = $('select#cco_data').val();

    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_cco_allocated_work",
        data: {cco_id:cco_id},
        success: function(resp){
            $('#cco_work_transfer_details').html(resp);
        }
    });
});

$(document).on('submit','#work_trf',function(){

    var param = $("#work_trf").serializeArray();

    console.log(param);
    //return false;
    $('.save_btn button').attr('disabled','disabled');
    $.ajax({
        type: 'POST',
        url: site_url + "cco/add_work_transfer_data",
        data: param,
        //dataType : 'json',
        success: function (resp) {
            var message = "";
            if(resp == 1){

                message += 'Data Inserted successfully.';
            }
            else{

                message += 'Data not Inserted.';
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
                        location.reload()
                    }
                });
            return false;
        }

    });
    return false;
});

$(document).on('click', 'div#cco_work_details input.check_checked', function() {

    if($(this).is(":checked"))
    {
        $("div.double-arrow").css("display","inline-block");
    }
    else
    {
        if($("div#cco_work_details tbody.tbl_body_row tr td:nth-child(2) input.check_checked:checked").length <= 0) {
            $("div.double-arrow").css("display","none");
        }
    }
});

$(document).on('click', 'div#cco_work_transfer_details input.cco_id', function() {

    if($(this).is(":checked"))
    {
        $("div.transfer_btn").css("display","inline-block");
    }
});

$(document).on('click','button#cancel_data',function(){
    location.reload();
});
