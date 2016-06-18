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
    
    $.ajax({
        type: 'POST',
        url: site_url+"esp/get_pbg_sku_data",
        data: {pbgid:pbg_id,frommonth:from_month,tomonth:to_month},
        success: function(res){
            console.log(res);
            $("div#forecast_data").empty();
           $("div#forecast_data").html(res); 
        }
    });
    
}