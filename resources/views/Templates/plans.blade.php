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
                            <h4 class="header-title mb-3">Create New DA PLAN</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <div class="col-lg-12">

                        <div class="row">
                              <div class="col-md-10">
                                  <form class="form-horizontal">
                                      <div class="form-group row">
                                          <label class="col-md-3 col-form-label">Domain Authority</label>
                                          <div class="col-md-7">
                                              <input type="number" max="100" class="form-control" id="da-authority">
                                          </div>
                                          <div class="col-md-2">
                                              <button class="btn btn-block btn-danger " id="setDa">Add DA</button>
                                          </div>

                                      </div>

                                  </form>
                              </div>
                        </div>


                    </div>
                    <!-- end -->

                    <div class="col-lg-4">

                    </div>

                </div>
                <!-- end row -->
                <hr>
                <div class="row mt-5">
                    <div class="col-12">
                        <table id="daplans">
                                <thead>
                                    <tr>
                                        <td>DA</td>
                                        <td>Add DA Category</td>
                                    </tr>
                                </thead>
                            <tbody>
                             @if(count($DARECORDS) > 0)
                                 @foreach($DARECORDS as $DA)

                                     <tr>
                                         <td>{{ $DA['DA'] }}+ </td>
                                         <td>
                                         <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#demo-{{ $DA['DA'] }}" aria-expanded="false" aria-controls="collapseExample">
    Open {{ $DA['DA'] }}+  Category
  </button> 
                                            <div id="demo-{{ $DA['DA'] }}" class="collapse mt-2">
                                             <form>
                                                 <div class="row">
                                                     <div class="col-5"><input type="text" placeholder="Enter Category Name" id="cat_name-{{ $DA['id'] }}" class="form-control" /></div>
                                                     <div class="col-5"><input type="number" placeholder="Enter Category Amount" id="cat_price-{{ $DA['id'] }}" class="form-control" /></div>
                                                     <div class="col-2"><button class="btn btn-primary" id="add_category-{{ $DA['id'] }}" >+</button></div>
                                                 </div>
                                             </form>
                                             <hr>

                                             <table class="table table-bordered">
                                                 <thead>
                                                 <tr>
                                                     <td>Name</td>
                                                     <td>Price</td>
                                                     <td>Action</td>
                                                 </tr>
                                                 </thead>
                                                 <tbody>


                                                       @foreach($DA['Category'] as $cat)
                                                           <tr>
                                                               <td>
                                                                   {{ $cat->title }}
                                                               </td>
                                                               <td>
                                                                   ${{ $cat->price }}
                                                               </td>
                                                               <td>
                                                                   <div class="btn-group">
                                                                       <button class="btn btn-sm btn-danger">Delete Category</button>
                                                                   </div>
                                                               </td>
                                                           </tr>
                                                       @endforeach





                                                 </tbody>
                                             </table>
                                            </div>
                                         </td>
                                     </tr>


                                 @endforeach

                             @else
                                 <tr>
                                     <td>No Result Found</td>
                                 </tr>
                             @endif

                            </tbody>
                        </table>
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
                            2023 &copy; Backlink.io theme by <a href="">Bitswits</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

    $(document).ready(()=>{
        @if(count($DARECORDS) > 0)
            @foreach($DARECORDS as $DA)
                $("#add_category-{{ $DA['id'] }}").click((event)=>{
                    event.preventDefault();
                let cat_name = $("#cat_name-{{$DA['id']}}").val();
                let cat_price = $("#cat_price-{{$DA['id']}}").val();

                if(cat_name == "" && cat_price == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please Fill All The Fields',
                    })
                }
                else{
                    $.ajax({
                        url:'/da-cat-add-process/',
                        method:'POST',
                        data:{
                            "cat_Name":cat_name,
                            "cat_Price":cat_price,
                            "da_id":"{{$DA['id']}}",
                            "_token":"{{ csrf_token() }}"
                        },
                        beforeSend:(()=>{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'DA Category Adding Please Wait',
                                showConfirmButton: false,
                            })
                        }),
                        success:((response)=>{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'DA Category Added',
                                showConfirmButton: false,
                            });
                            window.location.reload()
                        })
                    });
            }
                })
            @endforeach
        @endif





        $('#setDa').click((event)=>{
            event.preventDefault();
            let DA = $("#da-authority").val();
            if(DA == ""){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Enter DA',
                })
            }
            else{
                $.ajax({
                    url:"/add-da-process/",
                    method:'POST',
                    data:{
                        "da": DA,
                        "_token": "{{ csrf_token() }}"
                    },
                    beforeSend:()=>{
                        $('#setDa').html(`<div class="spinner-border text-light" style="width: 1rem;height: 1rem" role="status"><span class="sr-only">Loading...</span></div>`)
                    },
                    success:(response)=>{
                        Swal.fire({
                            icon: 'success',
                            title: 'DA ADDED',
                            text: 'DA Added Please Add Categories & Prices',
                        });
                        window.location.reload()
                    }
                }).fail((response)=>{
                    console.log(response)
                })
            }
        })
    });

</script>

<script>
    $(document).ready( function () {
        $('#daplans').DataTable();
    } );
</script>

</body>
</html>
