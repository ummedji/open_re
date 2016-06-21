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
    
    $("a#exeute").on("click",function(){
        
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
    
   // $(this).parent().nextAll("div.form-group").remove();
   // $("div#pbg_data").empty();
    get_pbg_product_sku_data(pbg_id);

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

function get_user_level_data(user_id){
    
    $.ajax({
                type: 'POST',
                url: site_url+"esp/get_user_level_data",
                data: {userid:user_id},
                success: function(resp){
                    if(resp != ""){
                        $("div#user_level_data").append(resp);
                    }
                    else{
                        
                        $.ajax({
                            type: 'POST',
                            url: site_url+"esp/get_pbg_data",
                            data: {userid:user_id},
                            success: function(res){
                               $("div#pbg_data").html(res); 
                            }
                        });
                        
                    }
                }
        });
    
}

function get_pbg_product_sku_data(pbg_id){
    
    var from_month = $("input#from_month").val();
    var to_month = $("input#to_month").val();
    
    if($("select.employee_data").length > 0){
        var employee_business_code = $("#user_level_data select.employee_data:last").val();
    }
    else{
        //LOGIN USER DATA
        var employee_business_code = $("input#login_user_id").val();
    }
    
   // alert(employee_business_code);
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/get_pbg_sku_data",
        data: {pbgid:pbg_id,frommonth:from_month,tomonth:to_month},
        success: function(res){
            console.log(res);
            $("div.forecast_data").empty();
           $("div.forecast_data").html(res); 
        }
    });
    
}