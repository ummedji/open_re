<?php
Assets::add_js((array('bootstrap.min.js',
    'jquery.mCustomScrollbar.concat.min.js',
    'jquery-listslider.js','bootstrap-select.min.js','bootstrap-datepicker.min.js'

)
));
echo Assets::js();
?>

<script type="text/javascript">
    $('.nav.nav-tabs').listslider({
        left_label: '<span class="bre_lf_arrow"></span>',
        right_label: '<span class="bre_rt_arrow"></span>'
    });
</script>
<script type="text/javascript">
    (function($){
        $(".slide_icon").click(function(e){
            $(".pr_title").toggleClass("li_title");
            $(".pr_slide_menu").toggleClass("side_menu_space");
            $(".pr_right_contain").toggleClass("inn_right_contain");
            /*$(".pr_footer").toggleClass("footer");*/
            $(".toggle_wieght_sp").toggleClass("wieght_sp");
            $(".left_contain_big").toggleClass("left_contain");

        });
        $(window).load(function(){

            $("a[rel='load-content']").click(function(e){
                e.preventDefault();
                var url=$(this).attr("href");
                $.get(url,function(data){
                    $(".content .mCSB_container").append(data); //load new content inside .mCSB_container
                    //scroll-to appended content
                    $(".content").mCustomScrollbar("scrollTo","h2:last");
                });
            });

            $(".content").delegate("a[href='top']","click",function(e){
                e.preventDefault();
                $(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
            });

        });
    })(jQuery);
</script>
<script>
 /*   $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready( function() {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = numFiles > 1 ? numFiles + ' files selected' : label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
    }); */

</script>
<script type="text/javascript">
    $(document).ready(function(){

        //Navigation Menu Slider
        $('#nav-expander').on('click',function(e){
            e.preventDefault();
            $('body').toggleClass('nav-expanded');
        });
        $('#nav-close').on('click',function(e){
            e.preventDefault();
            $('body').removeClass('nav-expanded');
        });

        // Initialize navgoco with default options
        $(".main-menu").navgoco({
            caret: '<span class="caret"></span>',
            accordion: false,
            openClass: 'open',
            save: true,
            cookie: {
                name: 'navgoco',
                expires: false,
                path: '/'
            },
            slide: {
                duration: 300,
                easing: 'swing'
            }
        });

    });
</script>

<script>
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    $(document).ready(function () {

        $('body [effect=tooltip]').tooltip();

    });
        /* $('.paging').click(function (e) {
         /!*  var page = $(this).attr("value");
         alert(page);*!/
         var param = $("#form_ddreport").serializeArray();
         param.push({name: "page_no", value: $(this).attr("value")});
         // console.log(param);
         $.ajax({
         type: 'POST',
         url: "<?php //echo base_url().'reports/device_data_detail_report';?>"  ,
         data: param,
         success: function(resp){
         $("#middle_container").html(resp);
         }
         });

         }
         );*/

        $(document).delegate(".report-box .pagination_link", "click", function (e) {
            var page = $(this).attr("value");
            alert(page);
            paginationCall(page);
        });

        $(document).delegate(".report-box #page", "focusout", function (e) {
            var page = $(this).attr("value");
            paginationCall(page);
        });

        $(document).delegate(".report-box .per_page", "change", function (e) {
            $("#page").attr("value", 1);
            submitForm();
        });

        $(document).delegate('.report-box body [effect=tooltip]', 'mouseenter mouseleave', function (event) {
            if (event.type == 'mouseenter') {
                $(this).tooltip('show');
            } else {
                $(this).tooltip('hide');
            }
        });


   // });

    function ajax_report(url, data, callback) {
        hideTooltip();
        ajaxLoaderOverlay($(".report-box"));
        $.ajax({
            url: url + "/" + $.now(),
            type: "POST",
            data: data,
            success: callback
        }).fail(function () {
            console.log('failed to retrieve data from server.');
        });
    }

    function settblResponse(response) {
        removeOverlay();
        $("#action").val('');
        $("#middle_container").hide().html(response).fadeIn("slow");
        $('.search-field-dropdown').trigger('change');
        attachTooltip();
    }

    function paginationCall(page) {
        if (page > 0) {
            $("#page").attr("value", page);
            submitForm();
        }
    }

    function submitForm() {

        var uri = $(location).attr('href');
        var lm = uri.split('/').reverse()[0];
        switch(lm)
        {
            case'daily_summary_reports':  val = $("#form_dsreport");break;
            case'device_connection_log': val = $("#form_dclreport");break;
            case'device_data_report': val = $("#form_ddreport");break;
            default  : val = $("#form_ntfdetails");break;
        }

        var parama = val.serializeArray();
        var pages = $("#admin_listing_form").serializeArray();
        var data= $.merge( $.merge( [], pages ), parama );
        var url = $("#admin_listing_form").attr("action");
        ajax_report(url, data, settblResponse);
    }

    function attachTooltip() {
        $('body [effect=tooltip]').tooltip();
    }

    function hideTooltip() {
        $('body [effect=tooltip]').tooltip('hide');
    }

    function ajaxLoaderOverlay(el) {
        var height = el.height();
        var width = el.width();
        var position = el.position();
        position.left;
        position.top;
        var overlay = $('#ajax_loader').css({
            'background': 'url(' + loaderImage + ') no-repeat scroll center center #CCCCCC',
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

    function removeOverlay() {
        $("#ajax_loader").removeAttr('style');
    }


</script>
</body>
</html>
