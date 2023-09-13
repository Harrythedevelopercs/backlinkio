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
                <div class="row">
                    <div class="col-12">
                        <div>
                            <h4 class="header-title mb-3">Create New Backlink Order</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-8">

                            <div class="row">
                                <div class="col-12">
                                    <form class="form-horizontal">
                                    <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example-email">Order Title</label>
                                            <div class="col-md-10">
                                                @if( count($CartItem) > 0 )
                                                    <a href="/clearorder/{{$CartItem[0]->orderId}}" style="color:red">Clear Old Order </a>
                                                    <input type="text" id="order_title" class="form-control" placeholder="Order Title" value="{{$CartItem[0]->orderId}}" disabled required>
                                
                                                @else
                                                    <input type="text" id="order_title" class="form-control" placeholder="Order Title" value="{{$OrderNumber}}" required>
                                                @endif
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Domain Authority</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id='domain-selector'>
                                                     <option value="0" selected>Select DA</option>
                                                    @if(count($DA) > 0)
                                                        @foreach($DA as $res)
                                                            <option value="{{$res->id}}">{{$res->DA}}+</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example-email">Anchor Text</label>
                                            <div class="col-md-10">
                                                <input type="text" id="anchor_text" class="form-control" placeholder="Anchor Text" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example-email">Destination URL</label>
                                            <div class="col-md-10">
                                                <input type="url" id="destination_url" class="form-control" placeholder="Destination URL" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="example-placeholder">Primary Category</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="changeprimary">
                                                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <button class="btn btn-primary" id="addtocart">Create Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>


                    </div>
                    <!-- end -->

                    <div class="col-lg-4">
                       <div class="card">
                         <div class="card-header">Details</div>
                         <div class="card-body">
                         <table class="table  table-hover">
                                <thead>
                                    <th>DA</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                </thead>
                                @if( count($CartItem) > 0 )
                                    @foreach($CartItem as $cart)
                                    <tr>
                                            <td>{{$cart->da}}+</td>
                                            <td>{{$cart->anchor}}</td>
                                            <td>${{$cart->category_price}}</td>
                                        </tr>
                                        
                                    @endforeach
                               @endif
                            </table>
                         </div>
                         <div class="card-footer">
                         <div class="row">
                            <div class="col-6"> Total : $ <span id="amount"> 
                                @if( count($CartItem) > 0 )
                                    @php
                                        $totalAmount = 0;
                                  
                                    foreach($CartItem as $cart){
                                        $totalAmount += $cart->category_price ;
                                    }
                                    echo $totalAmount;
                                    
                                    @endphp
                               @endif
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="btn-group">
                                @if( count($CartItem) > 0 )
                                    <a href="/select/payement/{{$CartItem[0]->orderId}}" class="btn btn-danger btn-sm">Checkout</a>
                                        <button class="btn btn-success btn-sm">Cart</button>
                                @else
                                      <a href="/select/payement/{{$OrderNumber}}" class="btn btn-danger btn-sm">Checkout</a>
                                    <button class="btn btn-success btn-sm">Cart</button>
                                @endif
                                
                                </div>
                            </div>
                         </div>   
                        </div>
                       </div>
                    </div>

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
 
        
        $("#domain-selector").on('change',(event)=>{
            event.preventDefault();
            let selectedValue = $("#domain-selector").val();
            $.ajax({
                url:'/da-plan-finder/',
                method:'GET',
                data:{
                    'da':selectedValue,
                },
                success:(Response)=>{
                    $("#changeprimary").html("");
                    Response.map(({id, title, price})=>{
                        $("#changeprimary").append(`<option value="${id}">${title} -- $${price}</option>`);
                    })
                }
            });
        });



        $("#addtocart").click((event)=>{
            event.preventDefault();
            let order_id = $("#order_title").val();
            let domain_power = $("#domain-selector").val();
            let Anchor_text = $("#anchor_text").val();
            let destination_url = $("#destination_url").val();
            let primary_category = $("#changeprimary").val();
            isValidUrl(destination_url);
           
            function isValidUrl(string) {
                try {
                    new URL(string);
                    $.ajax({
                url:'/order_category_finder/',
                method:'GET',
                data:{
                    'cat':primary_category,
                },
                success:(Response)=>{
                
                    $.ajax({
                        url:'/order_category_finder/',
                        method:'POST',
                        data:{
                            "order" : order_id,
                            "domain" : Response.DA,
                            "anchor" : Anchor_text,
                            "URL" : destination_url,
                            "cateogry" : Response.title,
                            "cateogry_price" : Response.price,
                            '_token':"{{ csrf_token() }}"
                        },
                        success:((Response2)=>{
                            let baseamount = $("#amount").html();
                            $("#amount").html("");
                            $("#order_list").append(`<li class="list-group-item">${Response.DA}+ | ${Response.title} | $${Response.price}</li>`);
                            let totalamount =  parseInt(baseamount) + parseInt(Response2);
                            console.log(totalamount)
                            $("#amount").html(`${totalamount }`);
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Item Added',
                                showConfirmButton: false,
                            });
                            window.location.reload();
                        })
                    })

                }

            });
                } catch (err) {
                    Swal.fire({
                                position: 'center-center',
                                icon: 'error',
                                title: 'Please Enter Proper URL',
                                showConfirmButton: false,
                    });
                }
            }

          

  
        });
        


    });
</script>


</body>
</html>
