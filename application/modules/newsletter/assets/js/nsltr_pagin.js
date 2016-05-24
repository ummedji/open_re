$(document).ready(function(){
    j_pagination();
});

$(document).ajaxComplete(function(){
    j_pagination();
});

function j_pagination()
{
    $('.pagination li:last-child a').removeAttr('style');
    $('#data').after('<div id="nsltr_pagin" class="pagination pagination-right"><ul></ul></div>');
    var rowsShown = 10;

    var rowsTotal = $('#data tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nsltr_pagin ul').append('<li><a href="#" rel="'+i+'">'+pageNum+'</a></li> ');
    }
    $('#data tbody tr').hide();
    $('#data tbody tr').slice(0, rowsShown).show();
    $('#nsltr_pagin ul li:first').addClass('disabled');
    $('#nsltr_pagin a').bind('click', function(){

        $('#nsltr_pagin ul li.disabled').removeClass('disabled');
        $(this).closest('li').addClass('disabled');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
            css('display','table-row').animate({opacity:1}, 300);
    });
}