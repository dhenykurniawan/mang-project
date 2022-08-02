@extends('layout/layout')

@section('content')
    <div class="main-container container top-20">
        <!-- wizard links -->
        <div class="row justify-content-between wizard-wrapper mb-4 shadow-sm">
            <div class="col">
                <a href="{{ route('cart.index') }}" class="wizard-link filled">
                    <i class="bi bi-bag shadow-sm"></i>
                    <span class="wizard-text">Produk</span>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('cart.address') }}" class="wizard-link filled">
                    <i class="bi bi-geo-alt shadow-sm"></i>
                    <span class="wizard-text">Alamat</span>
                </a>
            </div>
            <div class="col">
                <a href="javascript:;" class="wizard-link active">
                    <i class="bi bi-check-circle shadow-sm"></i>
                    <span class="wizard-text">Konfirmasi</span>
                </a>
            </div>
        </div>

        <!-- cart items -->
        <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">{{count($produk)}} produk</h5>
            </div>

        </div>
        <div class="row mb-2">
           @foreach($produk as $d)
                 <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm product mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="text-center avatar-90 avatar">
                                        <img src="{{FileManager::get("produk/",$d['produk_gambar'])}}" alt="" height="100" width="110">
                                    </figure>
                                </div>
                                <div class="col ps-0">
                                    <p class="mb-0">
                                        @if($d['produk_someday'] > 0)
                                            <small class="text-opac text-primary">
                                                <i><b>Sameday Delivery</b></i>
                                            </small>
                                        @endif
                                    </p>
                                    <h6 class="text-color-theme">{{$d['produk_nama']}}</h6>
                                    <div class="row">
                                        <div class="col">
                                            <p class="mb-0">
                                                Rp. {{number_format(Utility::get_harga_produk($d))}}
                                                <br>
                                                <small class="text-opac">{{$d['produk_shortdesc']}}</small>
                                                @if($d['variant'] !== 'null')
                                                    <br>
                                                    <small class="text-opac">Variant : {{ $d['variant'] }}</small>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-auto">
                                            Jumlah : {{$d['produk_qty']}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form-group form-floating mt-3">
                                        <input type="text" name="catatan" class="form-control border bg-light" value="{{ $d['catatan'] }}" disabled>
                                        <label for="jam_pengiriman">Catatan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           @endforeach
        </div>

        <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">Pengiriman ke</h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm product mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col align-self-center">
                                <h5 class="mb-0">{{$data['kelurahan_name']}}<br>
                                     @php
                                        $address_utama = "";
                                        if($data['address_utama']==1){
                                            $address_utama = "Utama";
                                        }
                                    @endphp
                                    <span class="text-opac small">{{$address_utama}}</span>
                                </h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                               {{$data['address_detail']}}, {{ucwords(strtolower($data['kelurahan_name']))}}, {{ucwords(strtolower($data['kecamatan_name']))}},<br>{{ucwords(strtolower($data['kota_name']))}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">Metode Pembayaran</h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-4">
                <a href="javascript:;" class="card shadow-sm mb-3 product text-normal">
                    <div class="card-body">
                        <div class="row">

                            <div class="col align-self-center">
                                <p>COD<br><small class="text-opac">(Cash On Delivery)</small></p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="order_payment_method" id="order_payment_method"  checked value="cod">
                                    <label class="form-check-label" for="order_payment_method">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="javascript:;" class="card shadow-sm mb-3 product text-normal">
                    <div class="card-body">
                        <div class="row">

                            <div class="col align-self-center">
                                <p>Transfer</p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="order_payment_method" id="order_payment_method_t"  value="transfer">
                                    <label class="form-check-label" for="order_payment_method_t">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-primary mt-2" role="alert" style="font-size:14px;">
                          Metode Pembayaran Transfer bisa dikirim ke: <br />
                          BCA : <span onclick="copyToClipboard('3462366105')">3462366105</span><br/>
                          BRI : <span onclick="copyToClipboard('300101046569534')">300101046569534</span><br/>
                          </i><br />
                          Atas Nama Rivan <br/>
                          <span class="text-danger" style="font-size: 12px;font-style: italic;">Klik pada nomor rekening untuk menyalin</span>

                        </div>
                    </div>

                </a>
            </div>

        </div>

         <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">Dikirim Kapan</h5>
            </div>
        </div>

        <div class="row mb-2">
             <div class="col-12 col-md-6 col-lg-4">
                <a href="javascript:;" class="card shadow-sm mb-3 product text-normal">
                    <div class="card-body">
                        <div class="row">

                            @php
                            $class_text = "text-danger";
                            $text = "Tidak Tersedia";
                            $checked = "disabled";
                            if($someday){
                                $class_text = "text-success";
                                $text = "Tersedia";
                                $checked = "checked";
                            }

                            @endphp

                            <div class="col align-self-center">
                                <p>Hari Ini<br>
                                    <small class="text-opac {{$class_text}}">{{$text}}</small>
                                    <small class="text-opac">{{$someday_keterangan}}</small>
                                </p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="order_tanggal" id="order_tanggal" {{$checked}}  value="{{date("Y-m-d")}}" >
                                    <label class="form-check-label" for="order_tanggal">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="javascript:;" class="card shadow-sm mb-3 product text-normal">
                    <div class="card-body">
                        <div class="row">
                             @php
                                $checked = "";
                                if(!$someday){
                                    $checked = "checked";
                                }
                            @endphp
                            <div class="col align-self-center">
                                <p>Besok<br><small class="text-opac">Tanggal : {{date('d/m/Y', strtotime("+1 day", time())) }} </small></p>
                            </div>
                            <div class="col-auto align-self-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="order_tanggal" id="order_tanggal" {{$checked}} value="{{date('Y-m-d', strtotime("+1 day", time())) }}">
                                    <label class="form-check-label" for="order_tanggal">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
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
            <div class="col-auto txt-subtotal">Rp. 0</div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <p>Ongkos Kirim</p>
            </div>
            <div class="col-auto txt-ongkir">Rp. 0</div>
        </div>

        <div class="row fw-bold mb-4">
            <div class="mb-3 col-12">
                <div class="dashed-line"></div>
            </div>
            <div class="col">
                <p>Total</p>
            </div>
           <div class="col-auto txt-total">Rp. 0</div>
        </div>

        <!-- Button -->
        <div class="row mb-3">
            <div class="col align-self-center d-grid">
                <a href="javascript:;" class="btn btn-default btn-lg btn_confirm shadow-sm">Konfirmasi</a>
            </div>
        </div>

    </div>

     <div class="position-fixed top-0 start-50 translate-middle-x p-3  z-index-999">
          <div id="toast_copy" class="toast bg-success border-0 shadow hide mb-3" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-body">
                    <div class="row">
                        <div class="col text-white">
                            <p>Nomor rekening berhasil disalin</p>
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
        $(document).ready(function() {
            var address_id = "{{$data['address_id']}}";
            get_ongkir(address_id);
            $(".btn_confirm").click(function(){
                var form = new FormData();
                var redirect = "{{ route('cart.done') }}";
                form.append("order_payment_method",$("input[name='order_payment_method']:checked").val());
                form.append("order_tanggal",$("input[name='order_tanggal']:checked").val());
                var html_default = $(".btn_confirm").html();
                var url = '{{route('order.store')}}';
                $.ajax({
                    type:'POST',
                    data:form,
                    contentType:false,
                    processData: false,
                    url:url,
                    beforeSend:function(){
                      $(".btn_confirm").html(loading_span());
                    },
                    success:function(data){
                        console.log(data);
                      $(".btn_confirm").html(html_default);
                      window.location.href = redirect;
                    },
                    error:function(data){
                        $(".btn_confirm").html(html_default);
                         window.location.href = "{{ route('cart.index') }}";
                        console.log(data);
                    }
                });
            });
        });

        function get_ongkir(address_id){
            if(address_id.length>0){
                var form = new FormData();
                form.append("address_id",address_id);
                var url = '{{route('cart.get_ongkir')}}';
                $.ajax({
                    type:'POST',
                    data:form,
                    contentType:false,
                    processData: false,
                    url:url,
                    beforeSend:function(){
                       $(".txt-subtotal").html(loading_span());
                       $(".txt-ongkir").html(loading_span());
                       $(".txt-total").html(loading_span());
                    },
                    success:function(data){
                        $(".txt-subtotal").html(data.subtotal);
                        if(data.ongkir<1){
                            $(".txt-ongkir").html(`(<s>${data.kelurahan_ongkir}</s>)`+` `+`Rp. 0`);
                        }
                        else{
                            $(".txt-ongkir").html(data.kelurahan_ongkir);
                        }
                        $(".txt-total").html(data.total_rupiah);
                    },
                    error:function(data){
                        console.log(data);
                    }
                });

            }
        }
        function copyToClipboard(text) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(text).select();
          document.execCommand("copy");
          $('#toast_copy').toast('show');
          $temp.remove();
        }
    </script>
@endsection

@endsection
