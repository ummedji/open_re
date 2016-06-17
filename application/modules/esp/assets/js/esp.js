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
        
        $.ajax({
                type: 'POST',
                url: site_url+"esp/get_user_level_data",
                data: {userid:user_id},
                success: function(resp){
                    console.log(resp);
                }
        });
        
        
    });
    
});