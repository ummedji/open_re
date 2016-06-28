$(document).ready(function(){
    
    $("#year_data").datepicker( {
	    format: " yyyy", // Notice the Extra space at the beginning
	    autoclose: true,
	    viewMode: "years", 
    	minViewMode: "years"
	}).on('changeDate', function (ev) {
	
		$("div.budget_data").empty();
	
		$("a#lock_data").attr("rel",$.trim($(this).val()));
	
		var user_id = $("input#login_user_id").val();
        $("div#user_level_data div.form-group").remove();
        $("div#pbg_data").empty();
        get_user_level_data(user_id);
		
	});

});

$(document).on("change","select.employee_data",function(){
        
    var user_id = $(this).val();
    $(this).parent().nextAll("div.form-group").remove();
    $("div#pbg_data").empty();
    get_user_level_data(user_id);

});

$(document).on("change","select.pbg_data",function(){
        
    var pbg_id = $(this).val();
    get_pbg_product_sku_data(pbg_id);

});

$(document).on("click","button#freeze_data",function(e){
    
    e.preventDefault();
   
    var budget_id = $("input#budget_id").val();
    var text_data = $(this).text();
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/update_budget_freeze_status",
        data: {budgetid:budget_id,textdata:text_data},
        success: function(resp){
            
            var message = "";
            if(resp == 1){
                
                if(text_data == "Freeze"){
                    $("div#freeze_area").html('<button type="submit" class="btn btn-primary" id="freeze_data">Unfreeze</button>');
                    
                     message += 'Data freezed successfully.';
                    
                }
                else{
                    $("div#freeze_area").html('<button type="submit" class="btn btn-primary" id="freeze_data">Freeze</button>');
                    
                     message += 'Data Unfreezed successfully.';
                    
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
    
    return false;

});


$(document).on("focusout",".budget_qty",function(){
    
    var rel_attr_val = $(this).attr("rel");
    var budget_data = $(this).val();
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/get_budget_value_data",
        data: {relattrval:rel_attr_val,budgetdata:budget_data},
        success: function(resp){
            
            $("input#budget_value_"+rel_attr_val).val(resp);
            
        }
    });
    
});



$(document).on("click","table.inner_main",function(){
    
    alert("qwq");
    
    var month_val = $(this).find("input#month_data").val();
    
    var user_level_form_data = $(this).find("form#user_data_form").serializeArray();
    
    alert(user_level_form_data+"==="+month_val);
    console.log(user_level_form_data+"==="+month_val);
    
  /*  $.ajax({
        type: 'POST',
        url: site_url+"esp/get_budget_value_data",
        data: {relattrval:rel_attr_val,budgetdata:budget_data},
        success: function(resp){
            
            $("input#budget_value_"+rel_attr_val).val(resp);
            
        }
    });
    */
    
});

$(document).on("click","a.lock_data",function(){
    
    var parent_data = $(this);
    
    var text_data = $("input#lock_status_data").val();
    
    var year_val = $(this).attr("rel");
    var budget_id = $("input#budget_id").val();
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/set_budget_lock_data",
        data: {textdata:text_data,yearval:year_val,budgetid:budget_id},
        success: function(resp){
            
            if(resp == 1){
                
                if($.trim(text_data) == "Lock"){
                    $("div#lock_area").html("<a style='cursor:pointer;' rel='"+year_val+"' href='javascript:void(0);' class='lock_data' ><i class='fa fa-unlock-alt' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Unlock /></a>");
                }
                else{
                     $("div#lock_area").html("<a style='cursor:pointer;' rel='"+year_val+"' href='javascript:void(0);' class='lock_data' ><i class='fa fa-lock' aria-hidden='true'></i><input type='hidden' name='lock_status' id='lock_status_data' class='lock_status_data' value='Lock' /></a>");
                }
                
            }
            
        }
    });
    
});

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
        url: site_url+"esp/get_pbg_sku_budget_data",
        data: {pbgid:pbg_id,frommonth:from_month,tomonth:to_month,businesscode:business_code},
        success: function(res){
           // console.log(res);
            $("div.budget_data").empty();
           $("div.budget_data").html(res); 
          // alert("sasa");
           $('select').selectpicker('refresh');
           
        }
    });
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/show_budget_lock",
        data: {pbgid:pbg_id,frommonth:from_month,tomonth:to_month,businesscode:business_code,login_user_id : employee_business_code},
        success: function(res){
            $("div#lock_area").html(res);
        }
    });
    
}