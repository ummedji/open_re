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
            
            $("div.impact_entry_data").html(resp);
            
        }
    });
        
    });
    
    
});

$(document).on("submit","#impact_entry",function(e){
    
    e.preventDefault();
    
    var param = $("#impact_entry").serializeArray();

	 $.ajax({
                type: 'POST',
                url: site_url+"esp/add_impact_entry",
                data: param,
                success: function(resp){
                	
                	message = "";
                	
                	if(resp == 1){
                		message += "Impact data add successfully.";
                	}
                	else{
                		message += "Impact data not add successfully.";
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
            
                	location.reload();
                	
                }
                
             });

    
});
