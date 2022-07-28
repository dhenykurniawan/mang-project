@php
$index = 0;
@endphp
@foreach($data as $d)
 @php
 $index++;
 @endphp
 <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#flush-collapseOne{{$index}}" aria-expanded="true" aria-controls="flush-collapseOne">
       <b class="{{$text_class}}">No ORDER : {{$d['order_id']}}</b>
    </button>

    </h2>
    <div id="flush-collapseOne{{$index}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
    data-bs-parent="#accordionFlushExample">
    <div class="accordion-body text-opac">
         <div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">{{count($d['tr_produk'])}} produk</h5>
            </div>

        </div>
        <div class="row mb-2">
           @foreach($d['tr_produk'] as $tr)
             <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm product mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="text-center avatar-90 avatar">
                                        <img src="{{FileManager::get("produk/",$tr['produk']['produk_gambar'])}}" alt="" height="100" width="110">
                                    </figure>
                                </div>
                                <div class="col ps-0">
                                    <p class="mb-0">
                                        @if($tr['produk']['produk_someday'] > 0)
                                            <small class="text-opac text-primary">
                                                <i><b>Sameday Delivery</b></i>
                                            </small>
                                        @endif
                                    </p>
                                    <h6 class="text-color-theme">{{$tr['produk']['produk_nama']}}</h6>
                                    <div class="row">
                                        <div class="col">
                                            <p class="mb-0">{{number_format($tr['trp_hargajual'])}}<br><small class="text-opac">{{$tr['produk_shortdesc']}}</small>
                                            </p>
                                        </div>
                                        <div class="col-auto">
                                            Jumlah : {{$tr['trp_qty']}}
                                        </div>
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
                                <h5 class="mb-0">{{$d['order_kelurahan']}}<br>
                                   <!-- <span class="text-opac small">Utama</span>!-->
                                </h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                               {{$d['order_alamat']}}, {{ucwords(strtolower($d['order_kelurahan']))}}, {{ucwords(strtolower($d['order_kecamatan']))}},<br>{{ucwords(strtolower($d['order_kota']))}}
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
                                    <input class="form-check-input" type="radio" name="order_payment_method" id="order_payment_method" @if($d['order_payment_method']=="cod") checked="checked"  @endif  value="cod" disabled="">
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
                                    <input class="form-check-input" type="radio" name="order_payment_method" id="order_payment_method_t"  value="transfer" @if($d['order_payment_method']=="transfer") checked="checked"  @endif  disabled="">
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
                <h5 class="mb-0">Tanggal Pengiriman</h5>
            </div>
        </div>

        <div class="row mb-2">
           
            <div class="col-12 col-md-6 col-lg-4">
                <a href="javascript:;" class="card shadow-sm mb-3 product text-normal">
                    <div class="card-body">
                        <div class="row">
                            <div class="col align-self-center">
                                <p><small class="text-opac">Tanggal : {{date('d/m/Y', strtotime($d['order_tanggal']." 00:00:00")) }} </small></p>
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
            <div class="col-auto">Rp. {{number_format($d['order_subtotal'])}}</div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <p>Ongkos Kirim</p>
            </div>

            @php
            $ongkir = "Rp. ".number_format($d['order_ongkir']);
            @endphp

            <div class="col-auto">Rp. {{number_format($d['order_ongkir'])}}</div>
        </div>

      

        <div class="row fw-bold mb-4">
            <div class="mb-3 col-12">
                <div class="dashed-line"></div>
            </div>
            <div class="col">
                <p>Total</p>
            </div>
            <div class="col-auto">Rp. {{number_format($d['order_total'])}}</div>
        </div>


    </div>
    </div>
    </div>

@endforeach