<style>
    /*.maintools a{*/
        /*color: white;*/
    /*}*/
    </style>
    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light blue-soft" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        1349
                    </div>
                    <div class="desc">
                        New Feedbacks
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light red-soft" href="#">
                <div class="visual">
                    <i class="fa fa-trophy"></i>
                </div>
                <div class="details">
                    <div class="number">
                        12,5M$
                    </div>
                    <div class="desc">
                        Total Profit
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light green-soft" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        549
                    </div>
                    <div class="desc">
                        New Orders
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-light purple-soft" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number">
                        +89%
                    </div>
                    <div class="desc">
                        Brand Popularity
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- END DASHBOARD STATS -->
    <!--Start--->
    <div class="row">
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Customers</h4>
                    <div class="easypiechart" id="easypiechart-blue" data-percent="82" ><span class="percent">82%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Sales</h4>
                    <div class="easypiechart" id="easypiechart-orange" data-percent="55" ><span class="percent">55%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Profits</h4>
                    <div class="easypiechart" id="easypiechart-teal" data-percent="84" ><span class="percent">84%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>No. of Visits</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="46" ><span class="percent">46%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end--->
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet solid bordered grey-cararra">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart-o"></i>Site Visits
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_statistics_loading">
                        <img src="<?php echo Template::theme_url('assets/admin/layout/img/loading.gif'); ?>" alt="loading"/>
                    </div>
                    <div id="site_statistics_content" class="display-none">
                        <div id="site_statistics" class="chart">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet solid grey-cararra bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bullhorn"></i>Revenue
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_activities_loading">
                        <img src="<?php echo Template::theme_url('assets/admin/layout/img/loading.gif'); ?>" alt="loading"/>
                    </div>
                    <div id="site_activities_content" class="display-none">
                        <div id="site_activities" style="height: 228px;">
                        </div>
                    </div>
                    <div style="margin: 20px 0 10px 30px">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-success">
										Revenue: </span>
                                <h3>$13,234</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-info">
										Tax: </span>
                                <h3>$134,900</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-danger">
										Shipment: </span>
                                <h3>$1,134</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-sm label-warning">
										Orders: </span>
                                <h3>235090</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption maintools">
                        <a href="#" style="color: white;" data-original-title=""><i class="glyphicon glyphicon-user"></i> Signed up user summary</a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div style="overflow-y: scroll; height: 100px; ">
                        <table class="table table-striped">
                            <tbody><tr>
                                <td class="text-left">Active</td>
                                <td class="text-right">61</td>
                            </tr>
                            <tr>
                                <td class="text-left">Inactive</td>
                                <td class="text-right">28</td>
                            </tr>
                            <tr>
                                <td class="text-left"><b>Total</b></td>
                                <td class="text-right"><b>89</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="portlet box red">
                <div class="portlet-title">
                    <div class="caption maintools">
                        <a href="#"><i class="glyphicon glyphicon-usd"></i> Order Payment Summary</a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="slimScrollBar" style="overflow-y: scroll; height: 100px;">
                        <table class="table table-striped">
                            <tbody><tr>
                                <td class="text-left">Pending</td>
                                <td class="text-right">0</td>
                            </tr>
                            <tr>
                                <td class="text-left">Completed</td>
                                <td class="text-right">84</td>
                            </tr>
                            <tr>
                                <td class="text-left"><b>Total</b></td>
                                <td class="text-right"><b>84</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<!--            <div class="portlet box green">-->
<!--                <div class="portlet-title">-->
<!--                    <div class="caption maintools">-->
<!--                        <a href="http://localhost/open_numinedv1/trunk/admin/settings/users" data-original-title=""><i class="fa fa-gift"></i> User Registered Via</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="portlet-body form">-->
<!--                    <table class="table table-striped">-->
<!--                        <tbody><tr>-->
<!--                            <td class="text-left">Facebook</td>-->
<!--                            <td class="text-right">8</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left">Twitter</td>-->
<!--                            <td class="text-right">8</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left">Google</td>-->
<!--                            <td class="text-right">7</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left">Register With Form</td>-->
<!--                            <td class="text-right">66</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left"><b>Total</b></td>-->
<!--                            <td class="text-right"><b>89</b></td>-->
<!--                        </tr>-->
<!--                        </tbody></table>-->
<!--                </div>-->
<!--            </div>-->
            </div>
        <div class="col-md-4">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption maintools">
                        <a href="#" data-original-title=""><i class="glyphicon glyphicon-edit dash-app"></i> Schedule appointment summary</a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="slimScrollBar" style="overflow-y: scroll; height: 100px; ">
                        <table class="table table-striped">
                            <tbody><tr>
                                <td class="text-left">Confirm</td>
                                <td class="text-right">21</td>
                            </tr>
                            <tr>
                                <td class="text-left">Canceled</td>
                                <td class="text-right">3</td>
                            </tr>
                            <tr>
                                <td class="text-left"><b>Total</b></td>
                                <td class="text-right"><b>24</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption maintools">
                        <i class="glyphicon glyphicon-gift"></i>Inventory
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="slimScrollBar" style="overflow-y: scroll; height: 100px; ">
                        <table class="table table-striped">
                            <tbody><tr>
                                <td class="text-left"><a href="#">Rings</a></td>
                                <td class="text-right">169</td>
                            </tr>
                            <tr>
                                <td class="text-left"><a href="#">Diamonds</a></td>
                                <td class="text-right">165</td>
                            </tr>
                            <!--                 <tr>
                                                <td class="text-left"><b>Total</b></td>
                                                <td class="text-right"><b>89</b></td>
                                            </tr>-->
                            </tbody></table>
                    </div>
                </div>
            </div>
<!--            <div class="portlet box green">-->
<!--                <div class="portlet-title">-->
<!--                    <div class="caption maintools">-->
<!--                        <a href="http://localhost/open_numinedv1/trunk/admin/settings/users"  data-original-title=""><i class="fa fa-gift"></i>Signed up user summary</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="portlet-body form">-->
<!--                    <table class="table table-striped">-->
<!--                        <tbody><tr>-->
<!--                            <td class="text-left">Active</td>-->
<!--                            <td class="text-right">61</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left">Inactive</td>-->
<!--                            <td class="text-right">28</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left"><b>Total</b></td>-->
<!--                            <td class="text-right"><b>89</b></td>-->
<!--                        </tr>-->
<!--                        </tbody></table>-->
<!--                </div>-->
<!--            </div>-->
       </div>
        <div class="col-md-4">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption maintools">
                        <a href="#" data-original-title=""><i class="glyphicon glyphicon-shopping-cart"></i> Order Summary</a>
                    </div>
                </div>
                <div class="portlet-body form">

                    <div class="slimScrollBar" style="overflow-y: scroll; height: 100px; ">
                        <table class="table table-striped">
                            <tbody><tr>
                                <td class="text-left">Shipped</td>
                                <td class="text-right">3</td>
                            </tr>
                            <tr>
                                <td class="text-left">Pending</td>
                                <td class="text-right">80</td>
                            </tr>
                            <tr>
                                <td class="text-left"><b>Total</b></td>
                                <td class="text-right">84</td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption maintools">
                        <a href="#" data-original-title=""><i class="glyphicon glyphicon-send"></i> User Request</a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="slimScrollBar" style="overflow-y: scroll; height: 100px; ">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td class="text-left"><a href="#">Newsletter Subscriber</a></td>
                                <td class="text-right">8</td>
                            </tr>
                            <tr>
                                <td class="text-left"><a href="#">Custom Quote</a></td>
                                <td class="text-right">17</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<!--            <div class="portlet box green">-->
<!--                <div class="portlet-title">-->
<!--                    <div class="caption maintools">-->
<!--                        <a href="http://localhost/open_numinedv1/trunk/admin/settings/users"  data-original-title=""><i class="fa fa-gift"></i>Signed up user summary</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="portlet-body form">-->
<!--                    <table class="table table-striped">-->
<!--                        <tbody><tr>-->
<!--                            <td class="text-left">Active</td>-->
<!--                            <td class="text-right">61</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left">Inactive</td>-->
<!--                            <td class="text-right">28</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td class="text-left"><b>Total</b></td>-->
<!--                            <td class="text-right"><b>89</b></td>-->
<!--                        </tr>-->
<!--                        </tbody></table>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        </div>

    <!--start--->
    <div class="row">

        <div class="col-md-3 col-sm-6">

            <div class="social-box facebook">
                <i class="fa fa-facebook"></i>
                <ul>
                    <li>
                        <strong>89k</strong>
                        <span>friends</span>
                    </li>
                    <li>
                        <strong>459</strong>
                        <span>feeds</span>
                    </li>
                </ul>
            </div><!--/social-box-->

        </div><!--/col-->

        <div class="col-md-3 col-sm-6">

            <div class="social-box twitter">
                <i class="fa fa-twitter"></i>
                <ul>
                    <li>
                        <strong>973k</strong>
                        <span>followers</span>
                    </li>
                    <li>
                        <strong>1.792</strong>
                        <span>tweets</span>
                    </li>
                </ul>
            </div><!--/social-box-->

        </div><!--/col-->

        <div class="col-md-3 col-sm-6">

            <div class="social-box linkedin">
                <i class="fa fa-linkedin"></i>
                <ul>
                    <li>
                        <strong>500+</strong>
                        <span>contacts</span>
                    </li>
                    <li>
                        <strong>292</strong>
                        <span>feeds</span>
                    </li>
                </ul>
            </div><!--/social-box-->

        </div><!--/col-->

        <div class="col-md-3 col-sm-6">

            <div class="social-box google-plus">
                <i class="fa fa-google-plus"></i>
                <ul>
                    <li>
                        <strong>894</strong>
                        <span>followers</span>
                    </li>
                    <li>
                        <strong>92</strong>
                        <span>circles</span>
                    </li>
                </ul>
            </div><!--/social-box-->

        </div><!--/col-->

    </div>
<!--end--->










