/**
 * Created by webclues on 5/25/2016.
 */
$(document).ready(function(){
    
    $("button#get_prespective_order").on("click",function(e){
        
        e.preventDefault();
        
        var from_date = $("input#form_date").val();
        var to_date = $("input#to_date").val();
        
        var login_user_id = $("input#login_customer_id").val();
        var login_user_role = $("input#login_customer_type").val();
        
        alert(from_date+"==="+to_date+"==="+login_user_id);
        
        $.ajax({
                type: 'POST',
                url: site_url+"ishop/get_prespective_order",
                data: {fromdate:from_date,todate:to_date,loginusertype:login_user_role,loginuserid:login_user_id},
                dataType : 'json',
                success: function(resp){
                    console.log(resp);
                 //   alert(resp);
                    $("div#middle_data_contailer").empty();
                    $("div#middle_data_contailer").append(resp);
                    
                }
            });
        
    });
    
});
   
   
   
