function call_camp_open(cid, ajx_url, divId)
{
    var test = ajx_url+'/'+cid;


    ajaxLoaderOverlay2($("#mydiv"));

    $.ajax({
        url: test,
        type: 'GET',
        success: function(data) {
            console.log(data);
            //called when successful
            $('#mydiv').html(data);

            removeOverlay2();
        },
        error: function(e) {
            //called when there is an error
            //console.log(e.message);
        }
    });

}

function ajaxLoaderOverlay2(el){

//    $("#ajax_loader").addClass("ajax_loader");

    var height = el.height();

    var width = el.width();

    var position = el.position();position.left;position.top;

    var overlay = $('#ajax_loader2').css({

        'background': 'url('+loaderImage+') no-repeat scroll center center #CCCCCC',

        'display': "block",

        'height': height,

        'width': width,

        'opacity': 0.7,

        'top': position.top,

        'left': position.left,

        'position': 'absolute',

        'z-index': 5

    });

}


function removeOverlay2(){

    $("#ajax_loader2").removeAttr( 'style' );

}