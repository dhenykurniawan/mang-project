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
                <a href="javascript:;" class="wizard-link active">
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

        <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">Pengiriman ke</h5>
            </div>
            <div class="col-auto pe-0 align-self-center">
                <a href="{{ route('cart.form_address') }}" class="link text-color-theme">
                    <i class="bi bi-plus"></i>
                    Tambah Alamat

                </a>
            </div>
        </div>
        <div class="row mb-2">
           
            @foreach($address_data as $ad)

                @php
                $address_utama = "";
                $checked = "";
                if($ad['address_utama']==1){
                    $address_utama = "Utama";
                    $checked = "checked";
                }

                @endphp

                 <div class="col-12 col-md-6 col-lg-3">
                    <div class="card shadow-sm product mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col align-self-center">
                                    <h5 class="mb-0">{{$ad['kelurahan_name']}}<br>
                                        <span class="text-opac small">{{$address_utama}}</span>
                                    </h5>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="form-check">
                                        <input class="form-check-input address_radio" type="radio" name="address" id="address1" {{$checked}} value="{{$ad['address_id']}}">
                                        <label class="form-check-label" for="address1">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    {{$ad['address_detail']}}, {{ucwords(strtolower($ad['kelurahan_name']))}}, {{ucwords(strtolower($ad['kecamatan_name']))}},<br>{{ucwords(strtolower($ad['kota_name']))}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-auto align-self-center">
                                <a href="{{ route('cart.form_address') }}?edit={{$ad['address_id']}}" class="btn btn-link text-color-theme"><i
                                        class="bi bi-pencil "></i>
                                    <span class="size-18">Ubah Alamat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
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
                <a href="javascript:;" class="btn btn-default btn-lg shadow-sm btn_confirm">Selanjutnya</a>
            </div>
        </div>

    </div>
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.address_radio').change(function() {
                var val = $(this).val();
                get_ongkir(val);
            });
            if(($(".address_radio:checked").val()!=null)) {
                get_ongkir($(".address_radio:checked").val());
            }
            

            $(".btn_confirm").click(function(){
                var redirect =  "{{ route('cart.confirm') }}";
                var address_id = $(".address_radio:checked").val();
                if(address_id==null){
                    alert("Anda belum memilih alamat");
                    return;
                }
                var form = new FormData();
                form.append("address_id",address_id);
                var url = '{{route('cart.store_confirm')}}';
                var html_default  = $(".btn_confirm").html();
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
                        $(".btn_confirm").html(html_default);
                        window.location.href = redirect;
                    },
                    error:function(data){
                        console.log(data);
                        $(".btn_confirm").html(html_default);
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

    </script>
@endsection

@endsection
