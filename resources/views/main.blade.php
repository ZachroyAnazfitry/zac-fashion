<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zac Fashion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Jquery JSON --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

  <!-- Material Dashboard CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/') }}/assets/css/material-dashboard?v=2.1.2.css">
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link rel="apple-touch-icon" href="{{ asset('frontend/') }}/assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/') }}/assets/img/favicon.ico">

    <link rel="stylesheet" href="{{ asset('frontend/') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/') }}/assets/css/templatemo.css">
    <link rel="stylesheet" href="{{ asset('frontend/') }}/assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('frontend/') }}/assets/css/fontawesome.min.css">

    {{-- toastr --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/') }}/assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/') }}/assets/css/slick-theme.css">

    {{-- Stripe SDK--}}
    <script src="https://js.stripe.com/v3/"></script>

    {{-- Icons for Actions column in datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@zac-fashion.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-764-0797</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
    
            <a class="navbar-brand text-success logo h1 align-self-center" href="/">
                Zac Fashion
            </a>
    
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            {{-- display Vendors from User table --}}
                            @php
                                $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
                            @endphp

                            <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                                <ul class="dropdown-menu">
                                    {{-- for All category --}}
                                    <li><a class="dropdown-item" href="{{ url('/category/details/all') }}">All</a></li>
                                    @foreach ($categories as $category)
                                        @php
                                            $products = App\Models\Products::where('category_id', '=', $category->id)->get();
                                        @endphp 
                                        <li><a class="dropdown-item" href="{{ url('category/details/'.$category->id.'/'.$category->category_slug) }}">{{  Str::ucfirst($category->category_name)  }}<span class="badge rounded-circle bg-primary text-white mx-2">{{ count($products) }}</span></a>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">

                            {{-- display Vendors from User table --}}
                            @php
                                $vendors = App\Models\User::where('status','active')->where('role', 'vendor')->orderBy('name', 'ASC')->get();
                            @endphp

                            <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                                <ul class="dropdown-menu">
                                    @foreach ($vendors as $vendor)
                                        <li><a class="dropdown-item" href="{{ url('/vendor/details/'.$vendor->id) }}">{{  Str::ucfirst($vendor->name)  }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    {{-- show if user not login --}}
                    @auth

                     {{-- Wishlist --}}
                      <a class="nav-icon position-relative text-decoration-none" href="{{ route('customer.wishlist') }}">
                        <i class="fa fa-fw fa-heart text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="countWishlist"></span>
                    </a>

                    {{-- mini cart --}}
                    <div class="dropdown" >
                        <a class="nav-link dropdown-toggle nav-icon position-relative text-decoration-none" href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="cartCount"></span>
                        </a>

                        <ul class="dropdown-menu dropdown-cart" id="miniCart">
                            {{-- <li>
                                <span class="item">
                                <span class="item-left">
                                    <img src="http://www.prepbootstrap.com/Content/images/template/menucartdropdown/item_1.jpg" alt="" />
                                    <span class="item-info">
                                        <span>Name</span>
                                        <span>Price: </span>
                                    </span>
                                </span>
                                <span class="item-right">
                                    <button class="btn btn-danger  fa fa-close"></button>
                                </span>
                            </span>
                            </li> --}}
                             
                          
                        </ul> 
                                                
                        
                    </div>

                    {{-- <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">7</span>
                    </a> --}}
                    <a class="nav-icon position-relative text-decoration-none" href="{{ route('customer.profile') }}">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        {{-- <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span> --}}
                    </a>
                    <a href="{{ route('customer.logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class=" me-sm-1"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a>
                    @endauth
                    {{-- show if user not login --}}
                    @if(!auth()->check())
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('login') }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                    @endif
                    {{-- <a class="nav-icon position-relative text-decoration-none" href="{{ route('login') }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a> --}}
                    <!-- Button trigger modal -->
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button> --}}
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Customer Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" role="form" class="text-start" action="{{ route('login') }}">
                                        @csrf
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required autofocus autocomplete="username" >
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                        required >
                                    </div>
                                    <div class="form-check form-switch d-flex align-items-center mb-3">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember me</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success w-100 my-4 mb-2">Sign in</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        Forgot your password?
                                        <a href="{{ route('password.request') }}" class="text-primary text-gradient font-weight-bold">Reset password</a>
                                    </p>
                                    <p class="mt-4 text-sm text-center">
                                        Don't have an account?
                                        <a href="{{ route('customer.register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                    </form>
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                </div>

                                <hr>

                                <div class="row" style="text-align: center">
                                    <div class="col">
                                        <a href="{{ route('vendor.login') }}"><button style="width: auto; margin: 20px 0 20px 10px" type="button" class="btn btn-success">Are you a Vendor?</button></a>

                                    </div>
                                    <div class="col">
                                        <a href="{{ route('login') }}"><button style="width: auto; margin: 20px 0 20px 10px;" style="align-content: right" type="button" class="btn btn-info">Are you an Admin?</button></a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    {{-- <a href="{{ route('customer.logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class=" me-sm-1"></i>
                        <span class="d-sm-inline d-none">Logout</span>
                    </a> --}}
                </div>
            </div>
    
        </div>
    </nav>
    <!-- Close Header -->

    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


   
    <main>
          
        {{-- @include('main-landing-page') --}}

        @yield('main_content')
    
   </main>

   

  


    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zay Shop</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            123, 48020 Selangor.
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">010-764-0797</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@zcorporation.com</a>
                        </li>
                    </ul>
                </div>

                {{-- Display category name data from Category table --}}
                @php
                    $categories = App\Models\Category::all();
                @endphp

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        @foreach ($categories as $category)
                            <li><a class="text-decoration-none" href="">{{ Str::ucfirst($category->category_name) }}</a></li>
                        @endforeach

                        {{-- <li><a class="text-decoration-none" href="#">Luxury</a></li>
                        <li><a class="text-decoration-none" href="#">Sport Wear</a></li>
                        <li><a class="text-decoration-none" href="#">Men's Shoes</a></li>
                        <li><a class="text-decoration-none" href="#">Women's Shoes</a></li>
                        <li><a class="text-decoration-none" href="#">Popular Dress</a></li>
                        <li><a class="text-decoration-none" href="#">Gym Accessories</a></li>
                        <li><a class="text-decoration-none" href="#">Sport Shoes</a></li> --}}
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="{{ route('vendor.login') }}">Become A Vendor</a></li>
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                        <div class="input-group-text btn-success text-light">Subscribe</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Company Name 
                            | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="{{ asset('frontend/') }}/assets/js/jquery-1.11.0.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/') }}/assets/js/templatemo.js"></script>
    <script src="{{ asset('frontend/') }}/assets/js/custom.js"></script>
    <!-- End Script -->
    
    {{-- jquery --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    {{-- sweetalert --}}
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    @if(Session::has('message'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
        toastr.success("{{ session('message') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
        toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
        toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
        toastr.warning("{{ session('warning') }}");
    @endif
  </script>

  <!-- Start Slider Script -->
  <script src="{{ asset('frontend/') }}/assets/js/slick.min.js"></script>
  <script>
      $('#carousel-related-product').slick({
          infinite: true,
          arrows: false,
          slidesToShow: 4,
          slidesToScroll: 3,
          dots: true,
          responsive: [{
                  breakpoint: 1024,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3
                  }
              },
              {
                  breakpoint: 600,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 3
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 3
                  }
              }
          ]
      });
  </script>
  <!-- End Slider Script -->

  
  {{-- Jquery JSON --}}
  <script>

    // protect again csrf
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

    // eye cart
    function productView(id) {
        
        // alert(id); // testing

        $.ajax({
            type: 'GET',
            url: 'product/view/modal/' + id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
            }
        })
    };

    // add to cart
    function addToCart(id) {

        // alert(id); // testing
        // event.preventDefault(); // prevent page reload

        var products_name = $('#products_name').text();
        // var productId = id;
        var price = $('#price').text();
        var color = $('#color').text();
        // var size = $('#size').text();
        var quantity = $('.quantity').val();
        var vendor_id = $('#vendor_id').text();


        console.log(price);
        console.log(color);
        console.log(quantity);
        console.log(vendor_id);

        $.ajax({
            type: 'POST',
            url: '/cart/data/store/'+ id,
            dataType: 'json',
            data:{
                _token: '{{ csrf_token() }}',
                products_name:products_name,
                // size:size,
                quantity:quantity,
                color:color, 
                price: price,
                vendor_id: vendor_id,

            },
            success: function(data) {
                // console.log(data);

                // sweetalert
                const Toastr = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    // title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toastr.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
                } else {
                    Toastr.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
            }
            },
            error: function(data){
                var errors = data.responseJSON;
                console.log(errors);
            },
           
        });

    }
</script>
  {{-- End of Jquery JSON --}}

  {{-- mini cart Jquery --}}
  <script>
    function miniCart() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url:'/cart/data/show',
            success:function (response) {
                // console.log(response);

                // display in blade
                var miniCart = ""

                // cartCount
                $('#cartCount').text(response.cartQuantity);

                // retrieve response as json objects and each() method for looping
                $.each(response.carts, function(key,value){
                    miniCart += ` 
                                        <li>
                                            <span class="item">
                                            <span class="item-left">
                                                <img src="/${value.options.picture}" alt="" style="width:50px;height:50px" />
                                                <span class="item-info">
                                                    <span>${value.name}</span>
                                                    <span>Price:RM${value.price}</span>
                                                    <span>Quantity: ${value.qty}</span>
                                                </span>
                                            </span>
                                            <span class="item-right">
                                                <button class="btn btn-danger fa fa-close" type="submit" id="${value.rowId}" onclick="cartRemove(this.id)" ></button>
                                            </span>
                                        </span>
                                        </li>
                                        <hr>
                                        <li class="divider"></li>
                                        <li><a class="text-center" href="{{ route('mycart') }}">View Cart</a></li> 
                                        
                                    
                                     `
                                    
                });

                // pass it
                $('#miniCart').html(miniCart);
            }
        })   
    }

    miniCart();

    // remove cart function
    function cartRemove(rowId) {
        $.ajax({
            type: "GET",
            url: '/cart/data/remove/' + rowId,
            dataType:'json',
            success: function(data) {
                miniCart();
                // console.log(data);

                // sweetalert
                const Toastr = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    icon: 'success',
                    // title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toastr.fire({
                    type: 'success',
                    title: data.success,
                    })
                } else {
                    Toastr.fire({
                    type: 'error',
                    title: data.error,
                    })
            }
            },
            error: function(data){
                var errors = data.responseJSON;
                console.log(errors);
            },
            
        });
    }
</script>

{{-- Wishlist function --}}
<script type="text/javascript">
    
    function wishlist(product_id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/wishlist/"+ product_id,
            headers: {
                "Accept": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            success: function(data) {
                getWishlist();
                // console.log(data);

                // sweetalert
                const Toastr = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    // title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toastr.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
                } else {
                    Toastr.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
            }
            },
            error: function(data){
                var errors = data.responseJSON;
                console.log(errors);
            },

        })
    }
</script>

{{-- Wishlist data --}}
<script type="text/javascript">
    
    function getWishlist() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/get/wishlist/",
            headers: {
                "Accept": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            success: function(response) {

                // for count
                $('#countWishlist').text(response.wishcount);

                // create empty variable
                var rows = ""

                // access
                $.each(response.wishlist, function(key, value) {

                    rows += 
                    `
                    <tr>
                        <td width="45%">
                            <div class="display-flex align-center">
                                <div class="img-product">
                                    <img src="/${value.product.picture}" alt="" class="mCS_img_loaded">
                                </div>
                                <div class="name-product">
                                    ${value.product.products_name}
                                </div>
                            </div>
                        </td>
                        <td width="15%" class="price">
                            ${value.product.discount_price == null ? `<h3>RM${value.product.price}</h3>` : `<h3>RM${value.product.price}</h3>`}
                        </td>
                        <td width="15%"><span class="in-stock-box">
                            ${value.product.quantity > 0 ? `<span class="in-stock-box">In Stock</span>` : `<h3><span class="out-stock-box">Out of Stock</span></h3>`}
                            </span></td>
                        <td width="15%"><button class="round-black-btn small-btn">Add to Cart</button></td>
                        <td width="10%" class="text-center"><a type="submit" onclick="removeWishlist(this.id)" id="${value.id}" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                    `
                });
                $('#wishList').html(rows);  
            }
        })   
    }

    getWishlist();

// remove wishlist
function removeWishlist(id) {

    $.ajax({
            type: "GET",
            url: '/wishlist/remove/' + id,
            dataType:'json',
            success: function(data) {
                getWishlist()  
                // console.log(data);

                // sweetalert
                const Toastr = Swal.mixin({
                    toast:true,
                    position: 'top-end',
                    icon: 'success',
                    // title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toastr.fire({
                    type: 'success',
                    title: data.success,
                    })
                } else {
                    Toastr.fire({
                    type: 'error',
                    title: data.error,
                    })
            }
            },
            
        });
    
}

</script>

{{-- Cart page --}}
<script>
    function cart() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url:'/cart-page',
            success:function (response) {
                // console.log(response);

                // display in blade
                var rows = ""

                $.each(response.carts, function(key,value){
                    rows += ` 
                         <tr>
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="#"><img src="/${value.options.picture}" alt="Product"></a>
                                    <div class="product-info">
                                        <h4 class="product-title"><a href="#">${value.name}</a></h4><span><em>Size:</em> S</span><span><em>Color:</em> ${value.options.color}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg text-medium">x ${value.qty}</td>
                            <td class="text-center text-lg text-medium">RM${value.price}</td>
                            <td class="text-center"><a class="remove-from-cart" type="submit" id="${value.rowId}" onclick="cartRemove(this.id)" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        `
                                    
                });

                // pass it
                $('#cartPage').html(rows);
            }
        })   
    }

    cart();

    function cartRemove(id) {

$.ajax({
        type: "GET",
        url: '/cart/remove/' + id,
        dataType:'json',
        success: function(data) {
            cart(); 
            miniCart(); 
            // console.log(data);

            // sweetalert
            const Toastr = Swal.mixin({
                toast:true,
                position: 'top-end',
                icon: 'success',
                // title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 3000
            })
            if ($.isEmptyObject(data.error)) {
                Toastr.fire({
                type: 'success',
                title: data.success,
                })
            } else {
                Toastr.fire({
                type: 'error',
                title: data.error,
                })
        }
        },
        
    });

}
</script>

</body>

</html>