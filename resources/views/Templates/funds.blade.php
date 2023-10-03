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
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h2>Funds</h2>
                            <form action="/fundsprocess" method="post" class="mt-4">
                                <div class="row">
                                    <div class="col-6">
                                        @csrf
                                        <input type="number" name="amount" id="amount" class="form-control" placeholder="10">
                                    </div>
                                    <div class="col-6">
                                        <input type="submit" value="Add funds" id="submit" class="btn btn-danger">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


            <!-- Footer Start -->
            <footer class="footer mt-5">
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



<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js')  }}"></script>

<script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

$(document).ready( function () {
        $('#data-table').DataTable();
    } );
</script>

</body>
</html>
