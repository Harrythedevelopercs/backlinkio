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
                            <h4 class="header-title mb-3">Orders </h4>
                        </div>
                    </div>
                </div>
             

               
                

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="mt-0  mb-3">Pending Order </h4>
                            <div class="mb-4 mt-5 ">
                                <table id="data-table-pen" class="table table-hover ">
                                    <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                        <th>Order Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($pendingOrders) > 0)
                                    @foreach($pendingOrders as $ord)
                                        <tr>
                                            <td>{{ $ord->orderId }}</td>
                                            <td>{{ $ord->order_date }}</td>
                                            <td><div class="btn-group">
                                                <a href="/backlink/admin/order/viewreport/{{ $ord->orderId }}" class="btn btn-dark" >View</a>
                                                <a class="btn btn-danger" >Cancel Order</a>
                                            </div></td>
                                            <td>{{ $ord->status }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="mt-0  mb-3">Completed Order </h4>
                            <div class="">
                                <table id="data-table-com" class="table table-hover ">
                                    <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                        <th>Order Status</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($completedOrders) > 0)
                                    @foreach($completedOrders as $ord)
                                        <tr>
                                            <td>{{ $ord->orderId }}</td>
                                            <td>{{ $ord->order_date }}</td>
                                            <td><div class="btn-group">
                                                <a href="/backlink/admin/order/viewreport/{{ $ord->orderId }}" class="btn btn-dark" >View</a>
                                                <a class="btn btn-success" >Print</a>
                                            </div></td>
                                            <td>{{ $ord->status }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            

            </div>
            <!-- end container-fluid -->



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
        $('#data-table-pen').DataTable();
        $('#data-table-com').DataTable();
    } );
</script>

</body>
</html>
