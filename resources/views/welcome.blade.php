@include('Templates.logheader')

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4 mt-3">
                            <a href="/">
                                <span><img src=" {{ asset('assets/images/logo-dark.png') }}" alt="" height="30"></span>
                            </a>

                        </div>
                        <form  class="p-2">
                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" id="emailaddress"  placeholder="john@deo.com">
                            </div>
                            <div class="form-group">
                                <a href="page-recoverpw.html" class="text-muted float-right">Forgot your password?</a>
                                <label for="password">Password</label>
                                <input class="form-control" type="password"  id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-4 pb-3">
                                <div class="custom-control custom-checkbox checkbox-primary">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary btn-block" id="_loginButton"> Sign In </button>
                            </div>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
                <div class="row mt-4">
                    <div class="col-sm-12 text-center">
                        <p class="text-muted mb-0">Don't have an account? <a href="/register" class="text-dark ml-1"><b>Sign Up</b></a></p>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src=" {{ asset('assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src=" {{ asset('assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(()=>{

        function isValidEmailAddress(emailAddress) {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            return pattern.test(emailAddress);
        };

        $('#_loginButton').click((event)=>{
            event.preventDefault();

            const Email = $("#emailaddress").val();
            const Password = $("#password").val();
            if( Email != "" && Password != ""){

                    if( !isValidEmailAddress( Email ) ) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please Enter Correct Email',
                        })
                    } else {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url:"/login-process/",
                            method:"POST",
                            data:{
                                'email':Email,
                                'password':Password,
                                '_token':"{{ @csrf_token() }}"
                            },
                            beforeSend:()=> {
                                $('#_registerButton').html("<span>Loading Please Wait</span>");
                                $('#_registerButton').attr('disabled');
                            },
                            success:(response)=>{
                                if(response == "202"){
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'User Found Redirecting To Dashboard',
                                        showConfirmButton: false,
                                        timer: 2500
                                    })
                                    window.location.href = '/backlink/dashboard/'
                                }else{
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: response,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    $('#_registerButton').html("<span>Sign In </span>");
                                }
                            }
                        }).fail((xhr, status, error)=>{
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Gone Wrong',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            console.log(error);
                        });
                    }


            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Fill All The Fields',
                })
            }
        });
    });
</script>

</body>

</html>
