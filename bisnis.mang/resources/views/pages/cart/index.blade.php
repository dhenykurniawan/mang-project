@extends('layout/layout')
@section('content')

    <div class="main-container container top-20">
        <!-- wizard links -->
        <div class="row justify-content-between wizard-wrapper mb-4 shadow-sm">
            <div class="col">
                <a href="javascript:;" class="wizard-link active">
                    <i class="bi bi-bag shadow-sm"></i>
                    <span class="wizard-text">Produk</span>
                </a>
            </div>
            <div class="col">
                <a href="javascript:;" class="wizard-link">
                    <i class="bi bi-geo-alt shadow-sm"></i>
                    <span class="wizard-text">Alamat</span>
                </a>
            </div>
            <div class="col">
                <a href="javascript:;" class="wizard-link">
                    <i class="bi bi-check-circle shadow-sm"></i>
                    <span class="wizard-text">Konfirmasi</span>
                </a>
            </div>
        </div>

        <!-- cart items -->
        <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0 cart_count">6 produk di keranjang</h5>
            </div>
            <div class="col-auto pe-0 align-self-center">
                <a href="{{ route('index') }}" class="link text-color-theme">Belanja Lagi
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>

        <div class="row mb-2 list_produk"></div>

        <!-- pricing -->
        <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">Pembayaran</h5>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <p>Subtotal</p>
            </div>
            <div class="col-auto cart_subtotal">Rp. 20,000</div>
        </div>

        <div class="row fw-bold mb-4">
            <div class="mb-3 col-12">
                <div class="dashed-line"></div>
            </div>
            <div class="col">
                <p>Total</p>
            </div>
            <div class="col-auto cart_total">Rp. 30,000</div>
        </div>

        <!-- Button -->
        <div class="row mb-3">
            <div class="col align-self-center d-grid">
                <a href="javascript:;" class="btn btn-default btn-lg shadow-sm" onclick="next_step1(this)">Selanjutnya</a>
            </div>
        </div>

    </div>
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            get_data(true);
            $('#customer_wa').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                    event.preventDefault(); //stop character from entering input
                }
            });
        });

        $(document).on('blur', '.catatan', function () {
            const catatan = $(this).val();
            const data_produk = $(this).data("produk");
            if(catatan != '') {
                add_cart(data_produk, data_produk.produk_qty, catatan)
            }
        });

         $(document).on("click", ".btn-add-chart",function() {
            var parent = $(this).parent();
            var qty_chart = parseInt(parent.children(".qty-chart").html());
            qty_chart += 1;
            var data_produk = $(this).data("produk");
            add_cart(data_produk, qty_chart, data_produk.catatan);
            parent.children(".qty-chart").html(qty_chart);
        });

        $(document).on("click",".btn-min-chart",function() {
            var parent = $(this).parent();
            var qty_chart = parseInt(parent.children(".qty-chart").html());
            qty_chart -= 1;
            var data_produk = $(this).data("produk");
            if (qty_chart > 0) {
                parent.children(".qty-chart").html(qty_chart);
                add_cart(data_produk, qty_chart, data_produk.catatan);
            }
        });

        function next_step1(t){
            var url_next = "{{ route('cart.address') }}";
            var form = new FormData();
            var html_default = $(t).html();
            var url = '{{route('auth.get_user_data')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    $(t).html(loading_span());
                },
                success:function(data){
                   $(t).html(html_default);
                   if(!data.login){
                        $("#modal_login").modal("show");
                   }
                   else{
                        window.location.href=url_next;
                   }
                },
                error:function(data){
                     $(t).html(html_default);
                    console.log(data);

                }
            });
        }

        function add_cart(d, qty, catatan = null) {
            var form = new FormData();
            form.append("produk_id", d.produk_id);
            form.append("produk_nama", d.produk_nama);
            form.append("produk_shortdesc", d.produk_shortdesc);
            form.append("harga_jual", d.harga_jual);
            form.append("harga_promo", d.harga_promo);
            form.append("produk_gambar", d.produk_gambar);
            form.append("produk_someday", d.produk_someday);
            form.append("produk_qty", qty);
            form.append("catatan", catatan);

            var url = '{{route('cart.store')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){

                },
                success:function(data){
                   console.log(data);
                   change_counter_cart(data.total);
                   get_data(false);
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function delete_cart(t,produk_id){
            var form = new FormData();
            form.append("produk_id",produk_id);

            var url = '{{route('cart.delete')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    $(t).html(loading_span());
                },
                success:function(data){
                   console.log(data);
                   change_counter_cart(data.total);
                   $(t).parent().parent().parent().parent().parent().parent().remove();

                   if(data.total<1){
                    window.location.reload();
                   }
                   else{
                    get_data(false);
                   }
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function get_data(produk){
            var form = new FormData();
            var url = '{{route('cart.get_data')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    $(".cart_count").html(loading_span());
                    $(".cart_subtotal").html(loading_span());
                    $(".cart_total").html(loading_span());
                },
                success:function(data){
                   //$(".list_produk").html(data);
                   $(".cart_count").html(data.total+" produk di keranjang");
                   $(".cart_subtotal").html(data.subtotal);
                   $(".cart_total").html(data.total_rupiah);
                   if(produk){
                        get_produk();
                   }
                },
                error:function(data){
                    $(".cart_count").html("");
                    $(".cart_subtotal").html("");
                    $(".cart_total").html("");

                    console.log(data);
                }
            });
        }

        function get_produk(){
            var form = new FormData();
            var url = '{{route('cart.get_produk')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    $(".list_produk").html("<center>"+loading_span()+"</center>");
                },
                success:function(data){
                   $(".list_produk").html(data);
                },
                error:function(data){
                    $(".list_produk").html("");
                    console.log(data);
                }
            });
        }
    </script>
@endsection

@endsection
