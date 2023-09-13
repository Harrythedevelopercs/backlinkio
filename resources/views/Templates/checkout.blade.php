@include('Templates.Header.header')
<!-- Begin page -->


<div id="wrapper">


    <!-- Topbar Start -->
    @include('Templates.TopBar.topbar');
    <!-- end Topbar -->


    <div class="content-page">
        <div class="content">

            <!-- Start container-fluid -->
            <div class="container-fluid">

                <!-- start  -->
                <form action="/charge/{{$ODI}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                <div class="row">

                    <div class="col-12 mb-3 p-3" style="background-color:#e1e1e1">
                    <div>
                        <h4 class="header-title mb-3">Order Details</h4>
                        <div class="order-detail">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>DA</th>
                                    <th>Target URL</th>
                                    <th>Anchor Text</th>
                                    <th>Price</th>
                                </thead>
                                @if(count($checkout) > 0)
                                    @foreach($checkout as $items)
                                        <tr>
                                            <td>{{$items->orderId}}</td>
                                            <td>{{$items->da}}+</td>
                                            <td>{{$items->url}}</td>
                                            <td>{{$items->anchor}}</td>
                                            <td>${{$items->category_price}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>${{$sum}}</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    </div>

                    <div class="col-12 p-3" style="background-color:#e1e1e1">
                        <div>
                            <h4 class="header-title mb-3">Payment Details</h4>
                        </div>
                        <div class="form-section">
                            <div class="form-group">
                                <label>Payment Method</label>
                                <select class="form-control">
                                    <option value="0">Stripe</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="customer-email" required placeholder="Enter Your Personal Email"/>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="customer-fname" required placeholder="Enter Your First Name For Billing"/>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="customer-lname" required placeholder="Enter Your Last Name For Billing"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" name="submit" value="Proceed"/>
                            </div>

                            
                        </div>
                    </div>
       
                </div>
                </form>
                <!-- end row -->

                <div class="row">
                    
                    <!-- end -->

                  

                </div>
                <!-- end row -->

                <!-- end row -->

            </div>
            <!-- end container-fluid -->



            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2023 &copy; Simple theme by <a href="">Coderthemes</a>
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script src="{{ asset('assets/js/vendor.min.js')  }}"></script>

<script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(()=>{
 
      


    });
</script>



</body>
</html>
