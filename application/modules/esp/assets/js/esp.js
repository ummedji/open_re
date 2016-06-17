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
        get_user_level_data(user_id);
        
    });
    
});

$(document).on("change","select.employee_data",function(){
        
        var user_id = $(this).val();
        $(this).parent().nextAll("div.form-group").remove();
        get_user_level_data(user_id);
    
        
        
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
                }
        });
    
}