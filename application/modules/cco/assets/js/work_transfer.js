$(document).on("change","#cco_data",function(e){
    $.ajax({
        type: 'POST',
        url: site_url+"cco/get_allocated_work",
        data: {cco:this.value},
        success: function(resp){
        }
    });
});
