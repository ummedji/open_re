<?php
Assets::add_js((array('bootstrap.min.js',
    'jquery.mCustomScrollbar.concat.min.js',
    'jquery-listslider.js','bootstrap-select.min.js','bootstrap-datepicker.min.js','jquery.validate.min.js','front_grid.js',
    'bootstrap-timepicker.js',

)
));
echo Assets::js();
?>
<script>
        $("#zoom_in_btn").click(function(){
            $("").show();
        });


</script>
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

        $(".zoom_in_btn").click(function(e){
            $(".zoom_out_btn").toggleClass("intro");
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

    $(document).on("keypress keyup blur",".allownumericwithdecimal",function (event) {
        //this.value = this.value.replace(/[^0-9\.]/g,'');
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

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

    });
</script>
<script type="text/javascript">
    $('#timepicker1').timepicker();
</script>

<div id="error_file_popup">

 </div>
<div id="success_file_popup">

</div>
</body>
</html>
