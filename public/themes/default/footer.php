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
    $(document).on('change', '.btn-file :file', function() {
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
    });

</script>

</body>
</html>
