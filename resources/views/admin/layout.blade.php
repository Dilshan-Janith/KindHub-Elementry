<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from coderthemes.com/adminto/layouts/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Nov 2019 04:35:37 GMT -->
<head>
        <meta charset="utf-8" />
        <title>KindHub Elementry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link href="{{ asset('plugins/images/favicon.ico') }}"  rel="shortcut icon" />

        <!--Morris Chart-->
        <link href="{{ asset('plugins/libs/morris-js/morris.css') }}" rel="stylesheet" />

        <!-- App css -->
        <link href="{{ asset('plugins/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!-- User box -->
                    <div class="user-box text-center">
                        <p class="text-muted">Admin Head</p>
                        <ul class="list-inline">
                            {{-- <li class="list-inline-item">
                                <a href="#" class="text-muted">
                                    <i class="mdi mdi-settings"></i>
                                </a>
                            </li> --}}

                            <li class="list-inline-item">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i>
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <router-link tag="a" to="/dashboard">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard </span>
                                </router-link>
                            </li>

                            <li>
                                <router-link tag="a" to="/class">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Class Room </span>
                                </router-link>
                            </li>

                            <li>
                                <router-link tag="a" to="/student">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Student </span>
                                </router-link>
                            </li>

                            <li>
                                <router-link tag="a" to="/teacher">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Teacher </span>
                                </router-link>
                            </li>

                            {{-- <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-invert-colors"></i>
                                    <span> User Interface </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-cards.html">Cards</a></li>
                                    <li><a href="ui-draggable-cards.html">Draggable Cards</a></li>
                                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                                    <li><a href="ui-material-icons.html">Material Design Icons</a></li>
                                    <li><a href="ui-font-awesome-icons.html">Font Awesome</a></li>
                                    <li><a href="ui-dripicons.html">Dripicons</a></li>
                                    <li><a href="ui-themify-icons.html">Themify Icons</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-notification.html">Notification</a></li>
                                    <li><a href="ui-range-slider.html">Range Slider</a></li>
                                    <li><a href="ui-components.html">Components</a>
                                    <li><a href="ui-sweetalert.html">Sweet Alert</a>
                                    <li><a href="ui-treeview.html">Tree view</a>
                                    <li><a href="ui-widgets.html">Widgets</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="mdi mdi-share-variant"></i>
                                    <span> Multi Level </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="javascript: void(0);">Level 1.1</a>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" aria-expanded="false">Level 1.2
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-third-level nav" aria-expanded="false">
                                            <li>
                                                <a href="javascript: void(0);">Level 2.1</a>
                                            </li>
                                            <li>
                                                <a href="javascript: void(0);">Level 2.2</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> --}}
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <router-view></router-view>
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                               2016 - 2019 &copy; Adminto theme by <a href="#">Coderthemes</a>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
		<script src="{{ asset('plugins/js/vendor.min.js') }}"></script>

        <!-- knob plugin -->
		<script src="{{ asset('plugins/libs/jquery-knob/jquery.knob.min.js') }}"></script>

        <!--Morris Chart-->
		<script src="{{ asset('plugins/libs/morris-js/morris.min.js') }}"></script>
		<script src="{{ asset('plugins/libs/raphael/raphael.min.js') }}"></script>

        <!-- Dashboard init js-->
		<script src="{{ asset('plugins/js/pages/dashboard.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('plugins/js/app.min.js') }}"></script>

		<script src="/js/app.js"></script>

    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/dark/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Nov 2019 04:35:37 GMT -->
</html>
