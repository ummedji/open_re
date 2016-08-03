<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'Reach Expansion');
        ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php e(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php e(isset($meta_author) ? $meta_author : ''); ?>">

    <?php
    Assets::add_css(array('bootstrap.min.css', 'style.css', 'green.css', 'hover.css', 'jquery.mCustomScrollbar.css',
        'bootstrap-select.min.css', 'bootstrap-datepicker.min.css', 'calendar.css', 'bootstrap-timepicker.min.css', 'select2.min.css', 'jquery.rateyo.css','jquery-ui.css'));
    //Assets::add_js('bootstrap.min.js');
    $inline = '$(".dropdown-toggle").dropdown();';
    $inline .= '$(".tooltips").tooltip();';
    Assets::add_js($inline, 'inline');
    ?>

    <!-- Custom Fonts -->
    <link href="<?php echo Template::theme_url('font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet"
          type="text/css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <?php echo Assets::css(); ?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
    <script src="<?php echo Template::theme_url('js/jquery.min.js'); ?>"></script>
    <script type="text/javascript">
        window.loaderImage = "<?php echo Template::theme_url("images/ajax_loader.gif"); ?>";
        window.base_url = "<?php echo base_url(); ?>";
        window.site_url = "<?php echo site_url(); ?>";
    </script>

    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        function isIE()
        {
            var ua = window.navigator.userAgent;
            // Test values; Uncomment to check result ?
            // IE 10
            // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';
            // IE 11
            // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';
            // IE 12 / Spartan
            // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';
            // Edge (IE 12+)
            // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

            var msie = ua.indexOf('MSIE ');
            if (msie > 0) {
                // IE 10 or older => return version number
                return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
            }

            var trident = ua.indexOf('Trident/');
            if (trident > 0) {
                // IE 11 => return version number
                var rv = ua.indexOf('rv:');
                return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
            }

            var edge = ua.indexOf('Edge/');
            if (edge > 0) {
                // Edge (IE 12+) => return version number
                return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
            }
            // other browser
            return false;
        }

        var ie_ver = isIE();
        var date_format = '<?php if(!is_null(@constant("js_date"))) { echo js_date; } else { echo "yyyy-mm-dd"; }?>';
    </script>
</head>
<body>