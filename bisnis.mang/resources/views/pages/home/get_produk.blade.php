
@foreach($data as $d)
    <div class="col-6 col-md-4 col-lg-3" >
        <div class="card shadow-sm product mb-4">
            <div class="card-body">
                <figure class="text-center ">
                    <img src="{{FileManager::get("produk/",$d['produk_gambar'])}}" height="109" width="123">
                </figure>
                <p class="mb-1">
                    @if($d['produk_someday'] > 0)
                        <small class="text-opac text-primary">
                            <i><b>Sameday Delivery</b></i>
                        </small>
                    @endif
                    <!--<small class="float-end"><span class="text-opac">4.5</span>
                        <i class="bi bi-star-fill text-warning"></i>
                    </small>!-->

                </p>
                <a href="javascript:;" class="text-normal">
                    <h6 class="text-color-theme">{{$d['produk_nama']}}</h6>
                </a>

                <div class="row">
                    <div class="col">
                        <p class="mb-0">
                            @if($d['harga_promo'] > 0)
                                <s>Rp. {{ number_format($d['harga_jual']) }} </s>
                            <br>
                            @endif
                            Rp. <span class="harga-jual">{{ number_format(Utility::get_harga_produk($d)) }}</span>
                            <br>
                            <small class="text-opac">{{ $d['produk_shortdesc'] }}</small>
                        </p>
                    </div>
                </div>

                <div class="row {{ count($d->variants) > 0 ? 'justify-content-between' : 'float-end' }}">
                    @if (count($d->variants) > 0)
                        @php
                            $user_data = json_decode(Session::get("user_data"));
                        @endphp
                        <div class="col-auto">
                            <select name="variant" class="form-select">
                                @foreach ($d->variants as $variant)
                                    <option
                                        data-jual="{{ $user_data && !is_null(@$user_data->customer_jenis_usaha) ? $variant->produk_variant_harga_jual_bisnis : $variant->produk_variant_harga_jual }}"
                                        data-jual-format="{{ number_format($user_data && !is_null(@$user_data->customer_jenis_usaha) ? $variant->produk_variant_harga_jual_bisnis : $variant->produk_variant_harga_jual) }}"
                                        {{ $loop->first ? 'selected' : '' }} value="{{ $variant->produk_variant_nama }}"
                                        >
                                        {{ $variant->produk_variant_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($buy)
                        <div class="col-auto">
                            @php
                                $display_plus    = "";
                                $display_counter = "none;";
                                $qty = 1;
                                $produk_data = Cart::getOne($d['produk_id']);

                                if(count($produk_data) > 0) {
                                    $qty = $produk_data['produk_qty'];
                                    $display_plus    = "none;";
                                    $display_counter = "";
                                }
                            @endphp
                            <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-gradient btn-show-qty text-white" data-produk="{{ json_encode($d) }}" style="display: {{ $display_plus }}">
                                <i class="bi bi-cart" style="font-size: 12px; margin: 0;"></i>
                            </button>

                            <div class="counter-number" style="display: {{ $display_counter }};">
                                <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle shadow btn-min-chart text-white bg-danger" data-produk="{{ json_encode($d) }}">
                                    <i class="bi bi-x size-22"></i>
                                </button>
                                {{-- <span class="qty-chart">{{ $qty }}</span>
                                <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle btn-add-chart" data-produk="{{ json_encode($d) }}">
                                    <i class="bi bi-plus size-22"></i>
                                </button> --}}
                            </div>
                        </div>
                    @else
                    <div class="col-auto">
                        <div class="alert alert-warning mt-3" role="alert">
                            {{$buy_keterangan}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
