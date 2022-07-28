
@foreach($data as $d)
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
                            <span class="float-end" style="cursor: pointer;" onclick="delete_cart(this,'{{$d['produk_id']}}')">
                                <i class="bi bi-trash-fill text-danger"></i>
                            </span>
                           
                        </p>
                        <h6 class="text-color-theme">{{$d['produk_nama']}}</h6>
                        <div class="row">
                            <div class="col">
                                <p class="mb-0">Rp. {{number_format(Utility::get_harga_produk($d))}}<br><small class="text-opac">{{$d['produk_shortdesc']}}</small>
                                </p>
                            </div>
                            <div class="col-auto">
                                <div class="counter-number" >
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle btn-min-chart" data-produk="{{json_encode($d)}}">
                                        <i class="bi bi-dash size-22"></i>
                                    </button>
                                    <span class="qty-chart">{{$d['produk_qty']}}</span>
                                    <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle btn-add-chart" data-produk="{{json_encode($d)}}">
                                        <i class="bi bi-plus size-22"></i>
                                    </button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach