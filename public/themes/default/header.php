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
    Assets::add_css(array('bootstrap.min.css', 'style.css','green.css','hover.css','jquery.mCustomScrollbar.css',
        'bootstrap-select.min.css','bootstrap-datepicker.min.css','calendar.css'));
    //Assets::add_js('bootstrap.min.js');
    $inline  = '$(".dropdown-toggle").dropdown();';
    $inline .= '$(".tooltips").tooltip();';
    Assets::add_js($inline, 'inline');
    ?>

    <!-- Custom Fonts -->
    <link href="<?php echo Template::theme_url('font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
</head>
<body>