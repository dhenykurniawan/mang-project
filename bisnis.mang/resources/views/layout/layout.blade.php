<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>MANG | Mau belanja ? di mang aja !!</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- <link rel="manifest" href="manifest.json" />!-->

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon180.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/favicon32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/favicon16.png') }}" sizes="16x16" type="image/png">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap"
        rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.6.0/font/bootstrap-icons.min.css">

    <!-- nouislider CSS -->
    <link href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}" rel="stylesheet">

    <!-- swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">

    <!-- style css for this template -->
    <link href="{{ asset('assets/css/style-blue.css') }}" rel="stylesheet" id="style">
     <!-- nouislider CSS -->
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet">

</head>

<body class="body-scroll" data-page="home">

    <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap mx-auto">
                    <div class="loader-cube1 loader-cube"></div>
                    <div class="loader-cube2 loader-cube"></div>
                    <div class="loader-cube4 loader-cube"></div>
                    <div class="loader-cube3 loader-cube"></div>
                </div>
                <p>Di Mang <br><strong>Belanja semakin mudah !</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <!-- Sidebar main menu -->
    <div class="sidebar-wrap  sidebar-overlay">
        <!-- Add pushcontent or fullmenu instead overlay -->
        <div class="closemenu text-opac">Close Menu</div>
        <div class="sidebar">
            @if(Session::has("user_data"))
                <div class="row mt-4 mb-3">
                    <!--<div class="col-auto">
                        <figure class="avatar avatar-60 rounded mx-auto my-1">
                            <img src="{{ asset('assets/img/user2.jpg') }}" alt="">
                        </figure>
                    </div>!-->
                    @php
                    $user_data = Session::get("user_data");
                    $user_data = json_decode($user_data,TRUE);
                    @endphp
                    <div class="col align-self-center ps-2">
                        <h6 class="mb-0">{{$user_data['customer_name']}}</h6>
                        <p class="text-opac">{{$user_data['customer_wa']}}</p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('index') }}">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                                <div class="col">Cari Produk</div>
                                <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                            </a>
                        </li>
                        @if(Session::has("user_data"))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-expanded="false">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-shop"></i></div>
                                    <div class="col">Order Saya</div>
                                    <div class="arrow"><i class="bi bi-plus plus"></i> <i
                                            class="bi bi-dash minus"></i>
                                    </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>

                                    <li>
                                        <!--    <a class="dropdown-item nav-link" href="product.html">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-card-list"></i></div>
                                            <div class="col">Draft</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a>!-->
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{route("order.process")}}">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-card-checklist"></i>
                                            </div>
                                            <div class="col">Proses</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <!--<a class="dropdown-item nav-link" href="payment.html">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-truck"></i></div>
                                            <div class="col">Sedang dikirim</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a>!-->
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{route("order.finish")}}">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-bag-check"></i></div>
                                            <div class="col">Selesai</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{route("order.cancel")}}">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-bag-x"></i></div>
                                            <div class="col">Cancel</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" href="{{route("order.history")}}">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-clock-history"></i>
                                            </div>
                                            <div class="col">Histori</div>
                                            <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.profile') }}" tabindex="-1">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-gear"></i></div>
                                    <div class="col">Akun Saya</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.logout') }}" tabindex="-1">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                                    <div class="col">Logout</div>
                                    <div class="arrow"><i class="bi bi-arrow-right"></i></div>
                                </a>
                            </li>

                        @else
                         <li class="nav-item">
                                <a class="nav-link" href="{{ route('auth.index') }}" tabindex="-1">
                                    <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-left"></i></div>
                                    <div class="col">Login / Daftar</div>

                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar main menu ends -->

    <!-- Begin page -->
    <main class="h-100 has-header has-footer">

        <!-- Header -->
        <header class="container-fluid header">
            <div class="row">
                <div class="col-auto align-self-center">
                    <button type="button" class="btn btn-link menu-btn text-color-theme">
                        <i class="bi bi-list size-24"></i>
                    </button>
                </div>
                <div class="col text-center">
                    <div class="logo-small">
                        <img src="{{ asset('assets/img/logo3.png') }}" alt="" class="img" style="width:135px;" >
                        <!--<h6>PINGKIFRESH<br><small>Fresh</small></h6>-->
                    </div>
                </div>
                <div class="col-auto align-self-center">

                    @php
                        $setting = Utility::getSetting();
                        $no_hp = $setting->setting_no_wa;
                    @endphp

                    <a target="__blank" href="https://api.whatsapp.com/send?phone={{$no_hp}}" class="link text-color-theme">
                        <i class="bi bi-whatsapp size-22"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        @yield("content")
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('index') }}">
                        <span>
                            <i class="nav-icon bi bi-shop"></i>
                            <span class="nav-text">Produk</span>
                        </span>
                    </a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'resep' ? 'active' : '' }}"
                        {{--href="{{ route('resep.index') }}"--}} href="javascript:;" onclick="alert('Fitur ini akan segera hadir. Yuk Belanja di MANG aja.. !!')">
                        <span>
                            <i class="nav-icon bi bi-receipt"></i>
                            <span class="nav-text">Resep</span>
                        </span>
                    </a>
                </li> -->
                <li class="nav-item center-item">
                    <a class="nav-link  {{ request()->segment(1) == 'cart' ? 'active' : '' }}"
                        href="{{ route('cart.index') }}">
                        <span>
                            <i class="nav-icon bi bi-cart"></i>
                            <span class="nav-text">Cart</span>
                           <span class="countercart" style="display: none;">0</span>
                        </span>
                    </a>
                </li>
               <!-- <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'konten' ? 'active' : '' }}"
                        {{--href="{{ route('konten.index') }}"--}} href="javascript:;" onclick="alert('Fitur ini akan segera hadir. Yuk belanja di MANG aja.. !!')">
                        <span>
                            <i class="nav-icon bi bi-newspaper"></i>
                            <span class="nav-text">Konten</span>
                        </span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link  {{ request()->segment(1) == 'auth' ||  request()->segment(1) == 'order' ? 'active' : '' }}"
                        href="{{ route('auth.index') }}">
                        <span>
                            <i class="nav-icon bi bi-person-circle"></i>
                            <span class="nav-text">Profil</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <!-- Footer ends-->

    <!-- filter menu -->
    <div class="filter">
        <div class="card shadow h-100">
            <div class="card-header">
                <div class="row">
                    <div class="col align-self-center">
                        <h6 class="mb-0">Filter Criteria</h6>
                        <p class="text-opac">2154 products</p>
                    </div>
                    <div class="col-auto px-0">
                        <button class="btn btn-link text-danger filter-close">
                            <i class="bi bi-x size-22"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body overflow-auto">
                <div class="mb-4">
                    <h6>Select Range</h6>
                    <div id="rangeslider" class="mt-4"></div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <div class="form-floating">
                            <input type="number" class="form-control" min="0" max="500" value="100" step="1"
                                id="input-select">
                            <label for="input-select">Minimum</label>
                        </div>
                    </div>
                    <div class="col-auto align-self-center"> to </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="number" class="form-control" min="0" max="500" value="200" step="1"
                                id="input-number">
                            <label for="input-number">Maximum</label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-4">
                    <select class="form-control" id="filtertype">
                        <option selected>Cloths</option>
                        <option>Electronics</option>
                        <option>Furniture</option>
                    </select>
                    <label for="filtertype">Select Shopping Type</label>
                </div>

                <div class="form-group floating-form-group active mb-4">
                    <h6 class="mb-3">Select Facilities</h6>

                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" id="men" checked>
                        <label class="form-check-label" for="men">Men</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" id="woman" checked>
                        <label class="form-check-label" for="woman">Women</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" id="Sport">
                        <label class="form-check-label" for="Sport">Sport</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" id="homedecor">
                        <label class="form-check-label" for="homedecor">Home Decor</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input type="checkbox" class="form-check-input" id="kidsplay">
                        <label class="form-check-label" for="kidsplay">Kid's Play</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Keyword">
                    <label for="input-select">Keyword</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-control" id="discount">
                        <option>10% </option>
                        <option>30%</option>
                        <option>50%</option>
                        <option>80%</option>
                    </select>
                    <label for="discount">Offer Discount</label>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-lg btn-default w-100 shadow-sm">Search</button>
            </div>
        </div>
    </div>
    <!-- filter menu ends-->

    <!-- event action toast messages -->
    <div class="position-fixed top-0 start-50 translate-middle-x p-3  z-index-999">
        <div id="toastprouctaddedtiny" class="toast bg-primary border-0 shadow hide mb-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <div class="row">
                    <div class="col text-white">
                        <p>Your product has been added to cart</p>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

        <div id="toastprouctadded" class="toast shadow hide mb-3" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto"><i class="bi bi-bag me-1"></i> Congtratulations!!!</strong>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <h6 class="mb-0">Your product has been added to cart</h6>
                <p class="text-opac">This position can be changed and applied as per desired location.</p>
            </div>
        </div>

        <div id="toastprouctaddedrich" class="toast border-0 shadow hide mb-3" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">
                    <i class="bi bi-basket text-color-theme rounded-circle me-1"></i>
                    Product added to cart
                </strong>
                <small>Just Now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="row gx-3">
                    <div class="col-auto">
                        <div class="avatar avatar-60 rounded page-bg p-2">
                            <img src="{{ asset('assets/img/product2.png') }}" alt="" class="mw-100">
                        </div>
                    </div>
                    <div class="col align-self-center">
                        <h6 class="mb-1 text-color-theme">Raybans Sunglasses</h6>
                        <p>
                            <span class="text-opac">Delivered on April 12</span>
                            <span class="float-end"><strong>$ 150</strong></span>
                        </p>
                    </div>
                    <div class="col-auto align-self-center">
                        <i class="text-opac bi bi-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- event action toast messages ends -->



    <!-- PWA app install toast message -->
    <!--<div class="position-fixed bottom-0 start-50 translate-middle-x  z-index-9">
        <div class="toast mb-3" role="alert" aria-live="assertive" aria-atomic="true" id="toastinstall"
            data-bs-animation="true">
            <div class="toast-header">
                <img src="assets/img/favicon32.png" class="rounded me-2" alt="...">
                <strong class="me-auto">Install PWA App</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="row">
                    <div class="col">
                        Click "Install" to install PWA app and experience as indepedent app.
                    </div>
                    <div class="col-auto align-self-center">
                        <button class="btn-default btn btn-sm" id="addtohome">Install</button>
                    </div>
                </div>
            </div>
        </div>
    </div>!-->

    <!-- Modal !-->

    <div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="form-floating mb-3 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="col-4 ps-0" style="cursor: pointer;">
                            <span class="form-check-label" data-forcheck="personal">Personal</span>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox">
                        </div>

                        <div class="col-4 ps-0" style="cursor: pointer;">
                            <span class="form-check-label" data-forcheck="bisnis">Bisnis</span>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3" id="input_name">
                    <input type="text" class="form-control " id="customer_name" placeholder="Masukan Nama Lengkap Anda" value="">
                    <label for="emailaddress">Nama Lengkap</label>
                    <span style="display: none;" class="text-danger" id="name-validate">Nama Lengkap tidak boleh kosong</span>
                </div>
                {{-- <div class="bisnis form-floating mb-3" style="display: none;">
                    <input type="text" class="form-control " id="no_ktp_owner" placeholder="Masukan Nama Owner" value="">
                    <label for="no_ktp_owner">Nomor KTP Owner</label>
                </div> --}}
                <div class="bisnis form-floating mb-3" style="display: none;">
                    <input type="text" class="form-control " id="nama_pic" placeholder="Masukan Nama Owner" value="">
                    <label for="nama_pic">Nama PIC/Penanggung Jawab</label>
                    <span style="display: none;" class="text-danger" id="nama_pic-validate">Nama PIC/Penanggung Jawab tidak boleh kosong</span>
                </div>
                <div class="bisnis form-floating mb-3" style="display: none;">
                    <input type="text" class="form-control " id="jenis_usaha" placeholder="Masukan Jenis Usaha Anda" value="">
                    <label for="jenis_usaha">Jenis Usaha</label>
                    <span style="display: none;" class="text-danger" id="jenis_usaha-validate">Jenis Usaha tidak boleh kosong</span>
                </div>
                <div class="bisnis form-floating mb-3" style="display: none;">
                    <textarea type="text" class="form-control " id="alamat_usaha" placeholder="Masukan Alamat Usaha Anda" value="" style="height: 100px;"></textarea>
                    <label for="alamat_usaha">Alamat Usaha</label>
                    <span style="display: none;" class="text-danger" id="alamat_usaha-validate">Alamat Usaha tidak boleh kosong</span>
                </div>
                <div class="bisnis form-floating mb-3" style="display: none;">
                    <input type="text" class="form-control " id="jam_operasional" placeholder="contoh: 09:00 - 17:00" value="09:00 - 17:00">
                    <label for="jam_operasional">Jam Operasional</label>
                    <span style="display: none;" class="text-danger" id="jam_operasional-validate">Jam Operasional tidak boleh kosong</span>
                </div>
                <div class="bisnis form-floating mb-3" style="display: none;">
                    <select class="form-select" id="jam_pengiriman">
                        <option value="">Pilih Jam pengiriman</option>
                        <option value="09:00 - 12:00">09:00 - 12:00</option>
                        <option value="12:00 - 15:00">12:00 - 15:00</option>
                        <option value="15:00 - 18:00">15:00 - 18:00</option>
                        <option value="18:00 - 21:00">18:00 - 21:00</option>
                    </select>
                    <span style="display: none;" class="text-danger" id="jam_pengiriman-validate">Jam pengiriman tidak boleh kosong</span>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control " id="customer_wa" placeholder="contoh : 081226377890" value="">
                    <label for="emailaddress">No Handphone/Whatsapp</label>
                    <span style="display: none;" class="text-danger" id="wa-validate">No Handphone/Whatsapp tidak boleh kosong</span>
                    <br /> <div class="alert alert-warning" role="alert"> Pastikan no whatsapp anda aktif,agar memudahkan admin untuk melakukan konfirmasi </div>
                </div>
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-default" onclick="login(this)">Submit</button>
              </div>
            </div>
          </div>
        </div>

    <!-- Required jquery and libraries -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

    <!-- swiper script -->
    <script src="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js') }}"></script>

    <!-- nouislider js -->
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/color-scheme.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>

    <script type="text/javascript">
        const formCheckLabel = $('.form-check-label')
        const formCheckInput = $('.form-check-input')
        const bisnisForm = $('.bisnis')
        let isBisnisFormInput = false

        $(document).ready(function() {
            formCheckLabel.click(function () {
                const forCheck = $(this).data('forcheck')
                if(forCheck == 'bisnis') {
                    isBisnisForm(true)
                } else {
                    isBisnisForm(false)
                }
            })

            formCheckInput.change(function () {
                if($(this).is(':checked')) {
                    isBisnisForm(true)
                } else {
                    isBisnisForm(false)
                }
            })
        })

        function isBisnisForm(state = false) {
            if(state === true) {
                bisnisForm.show()
                $('#input_name > label').text('Nama Owner')
                $('#input_name > span').text('Nama Owner tidak boleh kosong')
                formCheckInput.prop('checked', true)
                isBisnisFormInput = true
            } else {
                bisnisForm.hide()
                $('#input_name > label').text('Nama Lengkap')
                $('#input_name > span').text('Nama Lengkap tidak boleh kosong')
                formCheckInput.prop('checked', false)
                isBisnisFormInput = false
            }
        }

        $(document).ready(function(){
            change_counter_cart("{{ count(Cart::getAll()) }}");
        });

        function loading_span(){
            var html = `<div class="spinner-border text-danger" role="status"></div>`;
            return  html;
        }

        function delay(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }

        function change_counter_cart(total){
            if(total < 1) {
                $(".countercart").hide();
            }
            else{
                $(".countercart").show();
                $(".countercart").html(total);
            }
        }

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function login(t) {
            var customer_wa   = $("#customer_wa").val();
            var customer_name = $("#customer_name").val();

            var nama_pic        = $("#nama_pic").val();
            var jenis_usaha     = $("#jenis_usaha").val();
            var alamat_usaha    = $("#alamat_usaha").val();
            var jam_operasional = $("#jam_operasional").val();
            var jam_pengiriman  = $("#jam_pengiriman").val();

            $("#wa-validate").hide();
            $("#name-validate").hide();

            let error = false;
            if (customer_name == "") {
                $("#name-validate").show();
                error = true;
            }

            if (customer_wa == "") {
                $("#wa-validate").show();
                error = true;
            }

            if(isBisnisFormInput) {
                $("#nama_pic-validate").hide();
                $("#jenis_usaha-validate").hide();
                $("#alamat_usaha-validate").hide();
                $("#jam_operasional-validate").hide();
                $("#jam_pengiriman-validate").hide();

                if (nama_pic == "") {
                    $("#nama_pic-validate").show();
                    error = true;
                }

                if (jenis_usaha == "") {
                    $("#jenis_usaha-validate").show();
                    error = true;
                }

                if (alamat_usaha == "") {
                    $("#alamat_usaha-validate").show();
                    error = true;
                }

                if (jam_operasional == "") {
                    $("#jam_operasional-validate").show();
                    error = true;
                }

                if (jam_pengiriman == "") {
                    $("#jam_pengiriman-validate").show();
                    error = true;
                }
            }

            if(error) {
                return;
            }

            var form = new FormData();
            form.append("customer_wa", customer_wa);
            form.append("customer_name", customer_name);
            form.append("nama_pic", nama_pic);
            form.append("jenis_usaha", jenis_usaha);
            form.append("alamat_usaha", alamat_usaha);
            form.append("jam_operasional", jam_operasional);
            form.append("jam_pengiriman", jam_pengiriman);

            var html_default = $(t).html();
            var url = '{{ route('auth.login') }}';
            $.ajax({
                type: 'POST',
                data: form,
                contentType: false,
                processData: false,
                url: url,
                beforeSend: function() {
                    $(t).html(loading_span());
                },
                success: function(data) {
                    $(t).html(html_default);
                    window.location.reload();
                },
                error: function(data) {
                    $(t).html(html_default);
                    if (data.status == 401) {
                        $("#wa-validate").html("Format No Whatsapp salah format yang benar (08122334xx)");
                        $("#wa-validate").show();
                    }
                }
            });
        }

    </script>
    @yield("js");

</body>
</html>
