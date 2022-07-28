@extends('layout/layout')
@section('content')

    <div class="main-container container">

        <!-- search -->
        <div class="row mb-4">
            <div class="col">
                <div class="form-floating">
                    <input type="text" class="form-control is-valid" id="produk_nama"
                        placeholder="Cari kebutuhan belanjamu disini">
                    <label for="search">Cari kebutuhan belanjamu disini</label>
                    <button type="button" class="btn btn-link tooltip-btn d-block text-color-theme">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-auto" style="display: none;">
                <button class="btn btn-lg btn-theme shadow-sm filter-btn">
                    <i class="bi bi-filter size-22"></i>
                </button>
            </div>
        </div>


        <!-- offerslides -->
        <div class="swiper-container offerslides mb-3">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($slide as $s)
                    <div class="swiper-slide">
                        <img src="{{FileManager::get("slide/",$s['slide_file'])}}" style="border-radius:15px;">
                    </div>
                @endforeach


            </div>
            <div class="swiper-pagination pagination-offerslides"></div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <h5 class="mb-0">Kategori</h5>
            </div>

        </div>

        <!-- categories -->
        <div class="swiper-container categoriesswiper mb-3">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <!-- <div class="swiper-slide " style="cursor: pointer;" onclick="change_kategori(this,'')">
                    <div class="card shadow-sm card-kategori bg-kategori-" style="background-color: #0cc900;">
                        <div class="card-body shadow-sm">
                            <img src="assets/img/kat_all.png" alt="">
                        </div>
                    </div>
                    <p class="categoryname"><b style="color:##ff0000; " class="text-category color-category-">Semua</b></p>
                </div> -->
                @foreach($kategori as $k)
                    <div class="swiper-slide" style="cursor: pointer;" onclick="change_kategori(this,'{{$k['kategori_id']}}')">
                        <div class="card shadow-sm card-kategori bg-kategori-{{$k['kategori_id']}}">
                            <div class="card-body">
                                <img src="{{FileManager::get("kategori/",$k['kategori_icon'])}}" height="40" alt="">
                            </div>
                        </div>
                        <p class="categoryname"><b class="text-category color-category-{{$k['kategori_id']}}">{{$k['kategori_nama']}}</b></p>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Products -->
        <div class="row mb-3">
            <div class="col">
                <h5 class="mb-0">Produk</h5>
            </div>
            <!--<div class="col-auto">
                            <a href="#" class="link text-color-theme">View All <i class="bi bi-chevron-right"></i></a>
                        </div>!-->
        </div>

        <div class="row data-produk">

        </div>
         <div class="row mb-3">
            <div class="col align-self-center d-grid">
                <a href="javascript:;" class="btn btn-danger btn-more btn-sm shadow-sm text-white btn-gradient">Lainnya</a>
            </div>
        </div>

    </div>
     <div class="position-fixed top-0 start-50 translate-middle-x p-3  z-index-999">
          <div id="toast_add_cart" class="toast bg-success border-0 shadow hide mb-3" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-body">
                    <div class="row">
                        <div class="col text-white">
                            <p>Produk Berhasil dimasukan kedalam keranjang</p>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@section('js')
    <script type="text/javascript">
        var kategori_id = "1";
        var page = 1;
        var variant = null;

        $(document).ready(function() {
            get_produk(true);
            $(".btn-more").click(function(){
                page++;
                get_produk(false);
            });
             $("#produk_nama").keyup(delay(function (e) {
                get_produk(true);
            }, 500));

        });

         $(document).on("click",".btn-add-chart",function() {
            var parent = $(this).parent();
            var qty_chart = parseInt(parent.children(".qty-chart").html());
            qty_chart += 1;
            var data_produk = $(this).data("produk");
            add_cart(data_produk,qty_chart);
            parent.children(".qty-chart").html(qty_chart);
            variant = $(this).parents('.col-auto').siblings().children('[name="variant"]').val();
        });

        let harga_jual = 0
        $(document).on("change", "[name='variant']", function() {
            const selected = $(this).find('option:selected')
            const harga_jual_format = selected.data('jual-format')

            harga_jual = selected.data('jual')

            $(this).closest('.card-body').find('span.harga-jual').text(harga_jual_format);
        });

        $(document).on("click",".btn-min-chart",function() {
            var parent = $(this).parent();
            var qty_chart = parseInt(parent.children(".qty-chart").html());
            qty_chart -= 1;
            var data_produk = $(this).data("produk");
            variant = $(this).parents('.col-auto').siblings().children('[name="variant"]').val();

            if (qty_chart > 0) {
                parent.children(".qty-chart").html(qty_chart);
                add_cart(data_produk, qty_chart);
            }
            else{
                parent.hide();
                parent.parent().children(".btn-show-qty").show();
                delete_cart(data_produk);
            }
        });

        $(document).on("click",".btn-show-qty", async function() {
            const login = await check_login()
            if(!login) {
                return
            }

            var parent = $(this).parent();
            $(this).hide();
            $('#toast_add_cart').toast('show');
            var data_produk = $(this).data("produk");
            variant = $(this).parents('.col-auto').siblings().children('[name="variant"]').val();
            add_cart(data_produk, 1);
            parent.children(".counter-number").show();
        });

        async function check_login() {
            var url = '{{ route('auth.get_user_data') }}';

            let dataLogin = false
            await $.ajax({
                type:'POST',
                data: null,
                contentType: false,
                processData: false,
                url: url,
                beforeSend: function() {
                    //
                },
                success: function(data) {
                    if(!data.login) {
                        $("#modal_login").modal("show");
                    }

                    dataLogin = data.login;
                },
                error: function(data) {
                    //
                }
            });

            return dataLogin
        }

        function change_kategori(t,idx) {
            kategori_id = idx;
            $(".card-kategori").css("background-color","");
            $(".text-category").css("color","black");

            $(".bg-kategori-"+idx).css("background-color","#0cc900");
            $(".color-category-"+idx).css("color","#ff0000");

            get_produk(true);
        }

        function add_cart(d,qty) {
            var form = new FormData();
            form.append("produk_id", d.produk_id);
            form.append("produk_nama", d.produk_nama);
            form.append("produk_shortdesc",d.produk_shortdesc);
            form.append("harga_jual", harga_jual == 0 ? d.harga_jual : harga_jual);
            form.append("harga_promo", d.harga_promo);
            form.append("produk_gambar", d.produk_gambar);
            form.append("produk_someday", d.produk_someday);
            form.append("produk_qty", qty);

            if(variant === undefined) {
                variant = null;
            }

            form.append("variant", variant);

            var url = '{{ route('cart.store') }}';
            $.ajax({
                type: 'POST',
                data: form,
                contentType: false,
                processData: false,
                url: url,
                beforeSend: function() {

                },
                success: function(data) {
                   change_counter_cart(data.total);
                },
                error: function(data) {
                    //
                }
            });
        }

         function delete_cart(d){
            var form = new FormData();
            form.append("produk_id",d.produk_id);

            var url = '{{ route('cart.delete') }}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function() {

                },
                success:function(data) {
                    change_counter_cart(data.total);
                },
                error:function(data) {
                    //
                }
            });
        }

        function get_produk(new_page){
            var form = new FormData();
            if(new_page){
                page = 1;
            }
            form.append("pages",page);
            form.append("kategori_id",kategori_id);
            form.append("produk_nama",$("#produk_nama").val());

            var url = '{{ route('home.get_produk') }}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    if(new_page) {
                        $(".data-produk").html(loading_span());
                        $(".btn-more").fadeOut(100);
                    }
                    $(".btn-more").html("Loading...");
                },
                success:function(data){
                    $(".btn-more").html("Tampilkan Produk Lainnya");
                    if(new_page){
                        $(".data-produk").html(data);
                        if (data.length > 0) {
                            $(".btn-more").fadeIn(500);
                        }
                        else{
                            $(".data-produk").html("Produk belum tersedia");
                        }
                    }else{
                        $(".data-produk").append(data);
                    }

                    var jum_data = $(".data-produk").children().length;
                    if (jum_data < (8 * page)) {
                        $(".btn-more").hide();
                    }else{
                        $(".btn-more").show();
                    }
                },
                error:function(data){
                    console.log(data);
                    $(".btn-more").html("Lainya");
                }
            });
        }

    </script>
@endsection

@endsection
