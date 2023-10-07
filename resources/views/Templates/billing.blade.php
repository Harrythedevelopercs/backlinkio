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

                            <div class="row">
                                <div class="col-6">
                                <div>   
                                   <h4>Balance</h4>
                                   <h2>${{ ($amount / 100) }}</h2>
                                    <div class="mt-5 mt-2 ">
                                        <a href="/addfunds" class="btn btn-danger btn-sm">Add Funds</a>
                                       
                                    </div>
                                </div>
                                </div>
                                <div class="col-6">
                                   <div class="container">
                                    <h5>Spending</h5>
                                    <h1>${{$paidorderssum}}</h1>
                                    <hr>
                                    <h6>Last Transaction : ${{ $lastorder->amount }} </h6>
                                    <h6>Last Transaction Date: {{ $lastorder->payment_created }} </h6>
                                   </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <!-- end container-fluid -->
           
            <div class="container-fluid">

<div class="row mt-3 mb-4">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="mt-0  mb-3">Billing History </h4>
            <div class="row">
                <div class="col-12">
                   <table class="table table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Amount</th>
                            <th>Order Created</th>
                            <th>Order Status</th>
                            <th>Order Action</th>
                        </tr>
                    </thead>
                     @if(count($orders) > 0)
                        @foreach($orders as $ord)
                            <tr>
                                <td>{{ $ord->order_id }}</td>
                                <td>${{ $ord->amount }}</td>
                                <td>{{ $ord->payment_created }}</td>
                                <td>{{ $ord->payment_status }}</td>
                                <td><a class="btn btn-success btn-dark btn-sm">View Details</a></td>
                            </tr>
                        @endforeach
                     @endif
                   </table>
                </div>
            </div>

        </div>
    </div>
</div>

</div>


<div class="container-fluid">

<div class="row mt-3 mb-4">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="mt-0  mb-3">Funds History </h4>
            <div class="row">
                <div class="col-12">
                   <table class="table table-bordered" id="data-table_funds">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Order Status</th>
                            <th>Credit</th>
                            <th>Debit</th>
                        </tr>
                    </thead>
                     @if(count($fundsreport) > 0)
                        @foreach($fundsreport as $funds)
                            <tr>
                                @if($funds->status == "Funds Added")
                                    <td style="background-color:#6fe76f">{{ $funds->status }}</td>
                                @elseif($funds->status == "Funds Debit")
                                    <td  style="background-color:#ff6d7b">{{ $funds->status }}</td>
                                @endif
                                <td>{{  $funds->date }}</td>
                                <td>{{  $funds->stripe_ref }}</td>
                                @if($funds->status == "Funds Added")
                                    <td>${{  ( $funds->amount / 100 ) }}+</td>
                                    <td></td>
                                @elseif($funds->status == "Funds Debit")
                                    <td></td>
                                    <td>${{  ( $funds->amount / 100 ) }}-</td>
                                @endif
                            </tr>
                        @endforeach
                     @endif
                   </table>
                </div>
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
                            2017 - 2020 &copy; Simple theme by <a href="">Backlinkio</a>
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
        $('#data-table_funds').DataTable();
    } );
</script>

</body>
</html>
