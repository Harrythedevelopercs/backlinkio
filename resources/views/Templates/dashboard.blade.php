@include('Templates.Header.header')
<!-- Begin page -->
<div id="wrapper">


@include('Templates.TopBar.topbar');

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start container-fluid -->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div>
                            <h4 class="header-title mb-3">Welcome !</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        


                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                        <div>
                            <div class="card-box widget-inline">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 widget-inline-box">
                                        <div class="text-center p-3">
                                            <h2 class="mt-2"><i class="text-primary mdi mdi-access-point-network mr-2"></i> <b>{{$paidorders}}</b></h2>
                                            <p class="text-muted mb-0">Orders</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 widget-inline-box">
                                        <div class="text-center p-3">
                                            <h2 class="mt-2"><i class="text-teal mdi mdi-airplay mr-2"></i> <b>0</b></h2>
                                            <p class="text-muted mb-0">Completed Orders </p>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 widget-inline-box">
                                        <div class="text-center p-3">
                                            <h2 class="mt-2"><i class="text-info mdi mdi-black-mesa mr-2"></i> <b>2</b></h2>
                                            <p class="text-muted mb-0">Pending Orders</p>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6">
                                        <div class="text-center p-3">
                                            <h2 class="mt-2"><i class="text-danger mdi mdi-cellphone-link mr-2"></i> <b>0</b></h2>
                                            <p class="text-muted mb-0">Draft Orders</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h5 class="mt-0 font-14 mb-3">Pending Orders</h5>
                            <div class="table-responsive">
                                <table class="table table-hover mails m-0 table table-actions-bar table-centered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Products</th>
                                        <th>Start Date</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    
                            

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
            <!-- end container-fluid -->



            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2017 - 2020 &copy; Simple theme by <a href="">Coderthemes</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- end content -->

    </div>
    <!-- END content-page -->

</div>
<!-- END wrapper -->


<!-- Right Sidebar -->
<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="mdi mdi-close"></i>
        </a>
        <h5 class="font-16 m-0 text-white">Theme Customizer</h5>
    </div>
    <div class="slimscroll-menu">

        <div class="p-4">
            <div class="alert alert-warning" role="alert">
                <strong>Customize </strong> the overall color scheme, layout, etc.
            </div>
            <div class="mb-2">
                <img src="assets/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-3">
                <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="assets/css/bootstrap-dark.min.css"
                       data-appStyle="assets/css/app-dark.min.css" />
                <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
            </div>

            <div class="mb-2">
                <img src="assets/images/layouts/rtl.png" class="img-fluid img-thumbnail" alt="">
            </div>
            <div class="custom-control custom-switch mb-5">
                <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="assets/css/app-rtl.min.css" />
                <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
            </div>

            <a href="https://1.envato.market/EK71X" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-download mr-1"></i> Download Now</a>
        </div>
    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
    <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Choose Demos
</a>

<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js')  }}"></script>

<script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>
</html>
