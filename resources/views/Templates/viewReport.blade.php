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
                       <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Report : {{ $OD }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>Spending : ${{ $TotalAmount }}</h5>
                                </div>
                            </div> 
                            
                             <hr>
                             <p>Date Created : {{ $Order[0]->order_date }}</p>
                             @if($Order)
                                <div class="accordion" id="accordionExample">
                                @foreach($Order as $ord)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $ord->CID }}" aria-expanded="true" aria-controls="collapse{{ $ord->id }}">
                                        {{ $ord->anchor }}  <span style="font-weight:600 ;margin-left:10px"> {{ $ord->status }}</span>
                                    </button>
                                    </h2>
                                    <div id="collapse{{ $ord->CID }}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Targeted Text : {{ $ord->anchor }}</p>
                                        <p>Targeted URL : {{ $ord->url }}</p>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Complete URL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $ord->status }}</td>
                                                    <td>{{ $ord->responseURL }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                @endforeach
                                </div>
                             @endif

                             
  


                        </div>
                       </div>
                    </div>
                </div>

            </div>
            <!-- end container-fluid -->
           
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
