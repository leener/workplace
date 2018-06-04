<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>Metronic | UI Features - Tiles</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="__STATIC__/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="__STATIC__/admin/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="__STATIC__/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="__STATIC__/admin/css/style-metro.css" rel="stylesheet" type="text/css"/>

    <link href="__STATIC__/admin/css/style.css" rel="stylesheet" type="text/css"/>

    <link href="__STATIC__/admin/css/style-responsive.css" rel="stylesheet" type="text/css"/>

    <link href="__STATIC__/admin/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="__STATIC__/admin/css/uniform.default.css" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <link rel="shortcut icon" href="__STATIC__/admin/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

<!-- BEGIN HEADER -->

{include file="public/nav"}

<!-- END HEADER -->

<!-- BEGIN CONTAINER -->

<div class="page-container row-fluid">

    <!-- BEGIN SIDEBAR -->

    {include file="public/siderbar"}

    <!-- END SIDEBAR -->

    <!-- BEGIN PAGE -->

    <div class="page-content">

        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <div id="portlet-config" class="modal hide">

            <div class="modal-header">

                <button data-dismiss="modal" class="close" type="button"></button>

                <h3>portlet Settings</h3>

            </div>

            <div class="modal-body">

                <p>Here will be a configuration form</p>

            </div>

        </div>

        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <!-- BEGIN PAGE CONTAINER-->

        <div class="container-fluid">

            <!-- BEGIN PAGE HEADER-->

            <div class="row-fluid">

                <div class="span12">

                    <!-- BEGIN STYLE CUSTOMIZER -->

                    <div class="color-panel hidden-phone">

                        <div class="color-mode-icons icon-color"></div>

                        <div class="color-mode-icons icon-color-close"></div>

                        <div class="color-mode">

                            <p>THEME COLOR</p>

                            <ul class="inline">

                                <li class="color-black current color-default" data-style="default"></li>

                                <li class="color-blue" data-style="blue"></li>

                                <li class="color-brown" data-style="brown"></li>

                                <li class="color-purple" data-style="purple"></li>

                                <li class="color-grey" data-style="grey"></li>

                                <li class="color-white color-light" data-style="light"></li>

                            </ul>

                            <label>

                                <span>Layout</span>

                                <select class="layout-option m-wrap small">

                                    <option value="fluid" selected>Fluid</option>

                                    <option value="boxed">Boxed</option>

                                </select>

                            </label>

                            <label>

                                <span>Header</span>

                                <select class="header-option m-wrap small">

                                    <option value="fixed" selected>Fixed</option>

                                    <option value="default">Default</option>

                                </select>

                            </label>

                            <label>

                                <span>Sidebar</span>

                                <select class="sidebar-option m-wrap small">

                                    <option value="fixed">Fixed</option>

                                    <option value="default" selected>Default</option>

                                </select>

                            </label>

                            <label>

                                <span>Footer</span>

                                <select class="footer-option m-wrap small">

                                    <option value="fixed">Fixed</option>

                                    <option value="default" selected>Default</option>

                                </select>

                            </label>

                        </div>

                    </div>

                    <!-- END BEGIN STYLE CUSTOMIZER -->

                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                    {include file="public/breadcrumb"}

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <!-- BEGIN PAGE CONTENT-->

            {__CONTENT__}


            <!-- END PAGE CONTENT-->

        </div>

        <!-- END PAGE CONTAINER-->

    </div>

    <!-- END PAGE -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->

{include file="public/footer"}

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="__STATIC__/admin/js/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="__STATIC__/admin/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="__STATIC__/admin/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="__STATIC__/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="__STATIC__/admin/js/excanvas.min.js"></script>

<script src="__STATIC__/admin/js/respond.min.js"></script>

<![endif]-->

<script src="__STATIC__/admin/js/jquery.slimscroll.min.js" type="text/javascript"></script><!------滚动条------->

<script src="__STATIC__/admin/js/jquery.blockui.min.js" type="text/javascript"></script><!------弹框------->

<script src="__STATIC__/admin/js/jquery.cookie.min.js" type="text/javascript"></script><!------cookie------->

<script src="__STATIC__/admin/js/jquery.uniform.min.js" type="text/javascript" ></script><!------表单美化------->

<!-- END CORE PLUGINS -->

<script src="__STATIC__/admin/js/app.js"></script>

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();

    });
</script>



</html>