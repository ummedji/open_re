var forecast_validators = $("#add_forecast").validate({
    //ignore:'.ignore',
    rules: {
        from_month:{
            required: true
        },
        to_month:{
            required: true
        },
        employee_data:{
            required: true
        },
        pbg_data:{
            required: true
        }
    }
});

$(document).ready(function(){
    
    $( "#from_month" ).datepicker({
      format: "yyyy-mm",
      showOn: "button",
      buttonImage: site_url+"/public/themes/default/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      autoclose: true
        
        
    });
    
    $( "#to_month" ).datepicker({
      format: "yyyy-mm",
      showOn: "button",
      buttonImage: site_url+"/public/themes/default/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      autoclose: true
    });
    
    $("button#exeute").on("click",function(){
        
        
        var $valid = $("#add_forecast").valid();
        if(!$valid) {

            forecast_validators.focusInvalid();
            return false;
        }
        else
        {
            var user_id = $("input#login_user_id").val();
            $("div#user_level_data div.form-group").remove();
            $("div#pbg_data").empty();

            $("div.forecast_data").empty();
            
            get_user_level_data(user_id);
            
            var from_value = $("input#from_month").val();
            var to_value = $("input#to_month").val();
            
           // alert("INNN");
            
             $.ajax({
                type: 'POST',
                url: site_url+"esp/get_monthly_select_data",
                data: {frommonth:from_value,tomonth:to_value},
                success: function(resp){
                    
                   // console.log(resp);
                    
                    var res_html = '<select class="selectpicker" id="selected_month_data" name="selected_month_data" multiple>';
                 //   res_html += '<option value="">Select Data</option>';
                    if(resp != ""){
                        var monthdata = $.parseJSON(resp);
                        
                        for(var k=0;k<monthdata.length;k++){
                            res_html += '<option vaue="'+monthdata[k]+'">'+monthdata[k]+'</option>'
                        }
                        //alert(res_html);
                    }
                    
                    res_html += '</option>';
                    
                     $("div#middle_filter").html(res_html);
                    
                    $("select#selected_month_data").selectpicker('refresh');
                    
                }

            });
            
        }
        
    });
    
    
    $("#year_data").datepicker( {
	    format: " yyyy", // Notice the Extra space at the beginning
	    autoclose: true,
	    viewMode: "years", 
    	minViewMode: "years"
	}).on('changeDate', function (ev) {
	
		var user_id = $("input#login_user_id").val();
        $("div#user_level_data div.form-group").remove();
        $("div#pbg_data").empty();
        $("div.forecast_data").empty();
        get_user_level_data(user_id);
		
	});

	

});

$(document).on("change","select.employee_data",function(){
        
    var user_id = $(this).val();
    
  //  alert($(this).parent().parent().parent().nextAll().find("div.form-group").html());
    
   // $(this).parent().nextAll("div.form-group").remove();
    
    $(this).parent().parent().nextAll().remove();
    
    $("div#pbg_data").empty();
    $("div.forecast_data").empty();
    get_user_level_data(user_id);

});

$(document).on("change","select.pbg_data",function(){
        
    var pbg_id = $(this).val();
    get_pbg_product_sku_data(pbg_id);

});


$(document).on("click","#save_data",function(e){
    
    e.preventDefault();
    
    var param = $("#add_forecast").serializeArray();
    
    var $valid = $("#add_forecast").valid();
    if(!$valid) {

        forecast_validators.focusInvalid();
        return false;
    }
    else
    {
    
        $.ajax({
            type: 'POST',
            url: site_url+"esp/add_forecast",
            data: param,
            //dataType : 'json',
            success: function(resp){
                var message = "";
                //alert(resp);
                if(resp != 0){
                    $("input#forecast_id").val(resp);
                    message += 'Data added successfully.';
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
                           // location.reload()
                        }
                    });
            }
        });
        return false;
   }

});



$(document).on("click","button.freeze_data",function(e){
    
    e.preventDefault();

    var parent_data = $(this).parent();

    var forecast_id = $("input#forecast_id").val();
    var text_data = $(this).text();

    var pbg_id = $("select.pbg_data").val();

   // var freeze_date = $("select#selected_month_data").val();

    var freeze_date = $(this).attr("rel");
    
    //alert(forecast_id+"==="+freeze_date+"===="+text_data);
    
   // alert(freeze_date);
   // return false;
    if(freeze_date == null){
        
       $('<div></div>').appendTo('body')
        .html('<div><b>Please Select month to freeze data.</b></div>')
        .dialog({
            appendTo: "#success_file_popup",
            modal: true,
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: true,
            close: function (event, ui) {
                $(this).remove();
            }
        });

       return false;   
        
    }
    else
    {
       
        var login_user_child_status = "";
        
        if(text_data == "Freeze")
        {
                //CHECK FOR LOCK OF DATA FOR THAT MONTH IF LOCKED THAN MAKE IT FREEZE IF LOGIN USER IS NOT LOWEST USER
            
            $.ajax({
                type: 'POST',
                url: site_url+"esp/check_login_user_level_status",
            //    data: {forecastid:forecast_id,freezedate:freeze_date},
                success: function(resp){
                    login_user_child_status = resp;
                },
                async:false
            });
            
            if(login_user_child_status == 1){
                
                //CHECK FOR SELECTED MONTH DATA LOCKED OR NOT
                
                var login_user_lock_status = "";
                
                $.ajax({
                    type: 'POST',
                    url: site_url+"esp/check_login_user_lock_status",
                    data: {forecastid:forecast_id,freezedate:freeze_date},
                    success: function(resp){
                        login_user_lock_status = resp;
                    },
                    async:false
                });
            
                if(login_user_lock_status != 1){
                    
                     $('<div></div>').appendTo('body')
                        .html('<div><b>Please lock data before freezing data for selected months.</b></div>')
                        .dialog({
                            appendTo: "#success_file_popup",
                            modal: true,
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });

                    return false;
                }
                
                
            }
            
        }
        
        var lock_status = "";
        $.ajax({
            type: 'POST',
            url: site_url+"esp/get_forecast_lock_status",
            data: {forecastid:forecast_id,freezedate:freeze_date},
            success: function(resp){
                lock_status = resp;
                
            },
            async:false
        });
        
        if(lock_status == 1){

            $('<div></div>').appendTo('body')
            .html('<div><b>Selected months are locked by Senior employees.So No data is Freeze or unfreezed.</b></div>')
            .dialog({
                appendTo: "#success_file_popup",
                modal: true,
                zIndex: 10000,
                autoOpen: true,
                width: 'auto',
                resizable: true,
                close: function (event, ui) {
                    $(this).remove();
                }
            });

            return false;
        }
        else{
            
        $.ajax({
            type: 'POST',
            url: site_url+"esp/update_forecast_freeze_status",
            data: {forecastid:forecast_id,textdata:text_data,freezedate:freeze_date},
            success: function(resp){
                //alert(resp);
                var message = "";
                if(resp == 1){

                    if(text_data == "Freeze"){
                      //  $("div#freeze_area").html('<button rel ="'+freezedate+'" type="submit" class="btn btn-primary" id="freeze_data">Unfreeze</button>');

                        parent_data.html('<button rel ="'+freeze_date+'" type="submit" class="btn btn-primary freeze_data" id="freeze_data">Unfreeze</button>');

                         message += 'Data freezed successfully.';

                        get_pbg_product_sku_data(pbg_id);

                    }
                    else{
                     //   $("div#freeze_area").html('<button rel ="'+freezedate+'" type="submit" class="btn btn-primary" id="freeze_data">Freeze</button>');

                        parent_data.html('<button rel ="'+freeze_date+'" type="submit" class="btn btn-primary freeze_data" id="freeze_data">Freeze</button>');

                         message += 'Data Unfreezed successfully.';

                        get_pbg_product_sku_data(pbg_id);

                        $("input.forecast_qty").removeAttr("readonly");
                        $("select.assumption_data").removeAttr("disabled");
                        $("input.probablity_data").removeAttr("readonly");
                        
                        $("select").selectpicker('refresh');

                    }

                }
                else{

                    message += 'Data not freezed.';
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
                        }
                    });

            }
         });
            
        }
    }
    
    return false;

});


$(document).on("focusout",".forecast_qty",function(){
    
    var rel_attr_val = $(this).attr("rel");
    var forecast_data = $(this).val();
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/get_forecast_value_data",
        data: {relattrval:rel_attr_val,forecastdata:forecast_data},
        success: function(resp){
            
            $("input#forecast_value_"+rel_attr_val).val(resp);
            
        }
    });
    
});

$(document).on("click","a.lock_data",function(){
    
    var parent_data = $(this);
    
    var text_data = $(this).find("input.lock_status_data").val();
    
    var month_val = $(this).attr("rel");
    var forecast_id = $("input#forecast_id").val();
       
    var pbg_id = $("select.pbg_data").val();
    
    // alert(parent_data.parent().parent().html());
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/set_forecast_lock_data",
        data: {textdata:text_data,monthval:month_val,forecastid:forecast_id},
        success: function(resp){
            
            if(resp == 1){
                
                if($.trim(text_data) == "Lock"){
                    parent_data.parent().html("<a style='cursor:pointer;' rel='"+month_val+"' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock' /></a>");
                    
                   get_pbg_product_sku_data(pbg_id);
                    
                }
                else{
                     parent_data.parent().html("<a style='cursor:pointer;' rel='"+month_val+"' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a>");
                    
                    get_pbg_product_sku_data(pbg_id);
                }
                
            }
            
        }
    });
    
});

var date_array = "";

$(document).on("focusout","select#selected_month_data",function(){ 
    //var date_array = $(this).val();
    date_array = $(this).val();
    
    setTimeout(function(){
       alert(date_array);
    }, 2000);
   
});



//alert(date_array);


function get_user_level_data(user_id){
    
    $.ajax({
                type: 'POST',
                url: site_url+"esp/get_user_level_data",
                data: {userid:user_id},
                success: function(resp){
                    if(resp != ""){
                        $("div#user_level_data").append(resp);
                        
                         $("select").selectpicker('refresh');
                    }
                    else{
                        
                        $.ajax({
                            type: 'POST',
                            url: site_url+"esp/get_pbg_data",
                            data: {userid:user_id},
                            success: function(res){
                               $("div#pbg_data").html(res); 
								  $("select").selectpicker('refresh');
                            }
                        });
                        
                    }
                }
        });
    
}

function get_pbg_product_sku_data(pbg_id){
    
    if($("input#year_data").length > 0){
    	
    	var year_data = $("input#year_data").val();
    	
    	var from_month = year_data+"-01-01";
    	var to_month = year_data+"-12-01";
    	
    }else{
    	
    	var from_month = $("input#from_month").val();
    	var to_month = $("input#to_month").val();
    
    }
    
    if($("select.employee_data").length > 0){
        var employee_business_code = $("#user_level_data select.employee_data:last").val();
    }
    else{
        //LOGIN USER DATA
        var employee_business_code = $("input#login_user_id").val();
    }
    
    //GET USER BUSINESS CODE
    
    var business_code = "";
    
     $.ajax({
        type: 'POST',
        url: site_url+"esp/get_business_code",
        data: {forecast_user_id:employee_business_code},
        success: function(res){
            business_code = res;
        },
         async:false
    });
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/get_pbg_sku_data",
        data: {pbgid:pbg_id,frommonth:from_month,tomonth:to_month,businesscode:business_code},
        success: function(res){
           // console.log(res);
            $("div.forecast_data").empty();
           $("div.forecast_data").html(res); 
          // alert("sasa");
           $('select').selectpicker('refresh');
           
        }
    });
    
}




var budget_upload_validators = $("#upload_budget_data").validate({
    rules: {
        upload_file_data: {
            required: true
        }
    }
});


$(document).on('submit', '#upload_esp_forecast_data', function (e) {

    e.preventDefault();

    var file_data = new FormData(this);
    var dir_name = "esp_forecast";


    var header_array = [];



    /* var $valid = $("#upload_target_data").valid();
     if(!$valid) {
     budget_upload_validators.focusInvalid();
     return false;
     }
     else {

     */


    $.ajax({
        url: site_url+"esp/upload_forecast_data", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: file_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {

            $.each( data, function( key, value ) {

                if(key =="fileerror"){

                    $('<div></div>').appendTo('body')
                        .html('<div>'+value+'</div>')
                        .dialog({
                            appendTo: "#success_file_popup",
                            modal: true,
                            title: 'Save Data',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            buttons:{
                                close: function (event, ui) {
                                    $(this).remove();
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }

                        });

                    return false;
                }


                if(key == "error"){

                    var value_data = JSON.stringify(value);

                    var error_message = "";

                    var t_data = "<table><thead>";

                    $.each( value, function( key5, des_value5 ) {

                        if(key5 == "header"){

                            t_data += "<tr>";
                            $.each( des_value5, function( key2, header_desc_value ){
                                $.each( header_desc_value, function( key6, header_desc_value6 ){
                                    t_data += "<th style='text-align:center;'>"+header_desc_value6+"<span class='rts_bordet'></span></th>";
                                    header_array.push(header_desc_value6);
                                });
                            });
                            t_data += "<th style='text-align:center;'>Error Description</th></tr>";

                            header_array.push(header_desc_value6);

                            t_data += "</thead><tbody>";
                        }
                    });


                    $.each( value, function( key1, des_value ) {

                        if(key1 != "header"){

                            t_data += "<tr>";
                            var des_data = des_value.split("~");

                            $.each( des_data, function( key3, desc_data ){
                                t_data += "<td style='border:1px solid;text-align:center;' data-title='"+header_array[key3]+"'>"+desc_data+"</td>";
                            });

                            t_data += "</tr>";
                        }
                    });
                    t_data += "</tbody></table>";


                    $('<div id="no-more-tables"></div>').appendTo('body')
                        .html('<div>'+t_data+'</div>')
                        .dialog({
                            appendTo: "#success_file_popup",
                            modal: true,
                            title: 'The following data is incorrect Kindly upload correct data.',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            buttons: {
                                Download: function () {

                                    if(value != "No data found"){

                                        var file_name = "";

                                        $.ajax({
                                            url: site_url+"ishop/create_data_xl", // Url to which the request is send
                                            type: "POST",             // Type of request to be send, called as method
                                            data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs
                                            success: function(data)   // A function to be called if request succeeds
                                            {
                                                file_name = data;
                                            },
                                            dataType:'html',
                                            async:false
                                        });

                                        window.open(site_url+"assets/uploads/Uploads/"+dir_name+"/"+file_name,'_blank' );
                                    }
                                    $(this).dialog("close");
                                },
                                Decline: function () {
                                    $(this).dialog("close");
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
                }
                else
                {
                    $('<div></div>').appendTo('body')
                        .html('<div><h4><b>The file is correct. Please click on save button.</b></h4></div>')
                        .dialog({
                            appendTo: "#success_file_popup",
                            modal: true,
                            title: 'Save Data',
                            zIndex: 10000,
                            autoOpen: true,
                            width: 'auto',
                            resizable: true,
                            buttons: {
                                Save: function () {


                                    $.ajax({
                                        url: site_url+"esp/upload_xl_forecast_data", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {val:value,dirname:dir_name}, // Data sent to server, a set of key/value pairs
                                        success: function(data1)   // A function to be called if request succeeds
                                        {
                                            var obj = jQuery.parseJSON(data1);

                                            $.each( obj, function( key1, value1 ) {

                                                if (key1 == "error"){

                                                    $('<div></div>').appendTo('body')
                                                        .html('<div>' + value1 + '</div>')
                                                        .dialog({
                                                            appendTo: "#success_file_popup",
                                                            modal: true,
                                                            title: 'Save Data',
                                                            zIndex: 10000,
                                                            autoOpen: true,
                                                            width: 'auto',
                                                            resizable: true,
                                                            buttons: {
                                                                close: function (event, ui) {
                                                                    $(this).remove();
                                                                }
                                                            },
                                                            close: function (event, ui) {
                                                                $(this).remove();
                                                            }

                                                        });

                                                    return false;
                                                }
                                                else {

                                                    $('<div></div>').appendTo('body')
                                                        .html('<div>' + value1 + '</div>')
                                                        .dialog({
                                                            appendTo: "#success_file_popup",
                                                            modal: true,
                                                            title: '',
                                                            zIndex: 10000,
                                                            autoOpen: true,
                                                            width: 'auto',
                                                            resizable: true,
                                                            buttons: {
                                                                close: function (event, ui) {
                                                                    $(this).remove();
                                                                    location.reload();
                                                                }
                                                            },
                                                            close: function (event, ui) {
                                                                $(this).remove();
                                                                location.reload();
                                                            }

                                                        });

                                                    //  location.reload();
                                                    return false;
                                                }
                                            });

                                        }
                                    });
                                    $(this).dialog("close");
                                },
                                Decline: function () {
                                    $(this).dialog("close");
                                }
                            },
                            close: function (event, ui) {
                                $(this).remove();
                            }
                        });
                }

            })
        },
        dataType: 'json'
    });
    // }
    return false;
});