$(document).ready(function(){
    
	var date = new Date();
	var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
	var lastDay = new Date(date.getFullYear(), date.getMonth(), 0);
	    
    lastDay.setDate(lastDay.getDate());
    
    $( "#from_month" ).datepicker({
      format: "yyyy-mm",
      endDate:lastDay,
      showOn: "button",
      buttonImage: site_url+"/public/themes/default/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date",
      autoclose: true
    });
    
    
    $("a#view_impact_entry").on("click",function(){
        
        var selected_month = $("input#from_month").val();
        
        $.ajax({
        type: 'POST',
        url: site_url+"esp/get_forecast_impact_data",
        data: {selectedmonth:selected_month},
        success: function(resp){
            
            alert(resp);
          //  $("input#forecast_value_"+rel_attr_val).val(resp);
            
        }
    });
        
    });
    
    
});

$(document).on("change","select.employee_data",function(){
    
});
