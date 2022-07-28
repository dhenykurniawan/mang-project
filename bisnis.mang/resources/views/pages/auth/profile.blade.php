@extends('layout/layout')
@section('content')

    <div class="main-container container">
        <!-- profile picture -->

        <!-- wallet info -->
        <div class="row">
            <div class="col-12">
                <div class="card card-theme shadow-sm mb-4">
                    <div class="card-body">
                        <div class="card card-light mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <!--<div class="col-auto">
                                        <figure class="avatar avatar-80 rounded mx-auto">
                                            <img src="{{ asset('assets/img/user2.jpg') }}" alt="">
                                        </figure>
                                    </div>!-->
                                    <div class="col align-self-center">
                                        <h5 class="mb-0">{{$user_data['customer_name']}}</h5>
                                        <p class="text-opac">{{$user_data['customer_wa']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-auto align-self-center">
                                <i class="bi bi-bag size-32"></i>
                            </div>
                            <div class="col align-self-center">
                                <h2 class="mb-0">{{$total_order}} <small>ORDER</small></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col btn_proses"  style="cursor: pointer;">
                                <div class="card shadow-sm product">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-50 rounded bg-primary text-white">
                                                    <i class="bi bi-card-checklist"></i>
                                                </div>
                                            </div>
                                            <div class="col ps-0 align-self-center">
                                                <span class="small text-opac mb-0">Order Diproses</span>
                                                <p class="mb-1">{{$total_order_proses}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col btn_selesai" style="cursor: pointer;">
                                <div class="card shadow-sm product">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-50 rounded bg-success text-white">
                                                    <i class="bi bi-bag-check"></i>
                                                </div>
                                            </div>
                                            <div class="col ps-0 align-self-center">
                                                <span class="small text-opac mb-0">Order Selesai</span>
                                                <p class="mb-1">{{$total_order_selesai}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col btn_cancel" style="cursor: pointer;">
                                <div class="card shadow-sm product">
                                    <div class="card-body" >
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-50 rounded bg-danger text-white">
                                                    <i class="bi bi-bag-x"></i>
                                                </div>
                                            </div>
                                            <div class="col ps-0 align-self-center">
                                                <span class="small text-opac mb-0">Order Cancel</span>
                                                <p class="mb-1">{{$total_order_cancel}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <h5 class="mb-0">Profil Saya </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-light shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating  mb-3">
                                    <input type="text" name="customer_name" class="form-control" value="{{$user_data['customer_name']}}" placeholder="Masukan Nama"
                                        id="names">
                                    <label for="names">Nama </label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating   mb-3">
                                    <input type="text" name="customer_wa" class="form-control" value="{{$user_data['customer_wa']}}" placeholder="Masukan No Whatsapp"
                                        id="surnames">
                                    <label for="surnames">Whatsapp</label>
                                </div>
                            </div>

                            @if($user_data['customer_nama_pic'])
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control " id="nama_pic" placeholder="Masukan Nama Owner" value="{{ $user_data['customer_nama_pic'] }}">
                                    <label for="nama_pic">Nama PIC/Penanggung Jawab</label>
                                </div>
                            </div>
                            @endif

                            @if($user_data['customer_jenis_usaha'])
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control " id="jenis_usaha" placeholder="Masukan Jenis Usaha Anda" value="{{ $user_data['customer_jenis_usaha'] }}">
                                    <label for="jenis_usaha">Jenis Usaha</label>
                                </div>
                            </div>
                            @endif

                            @if($user_data['customer_alamat_usaha'])
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating mb-3">
                                    <textarea type="text" class="form-control " id="alamat_usaha" placeholder="Masukan Alamat Usaha Anda" style="height: 100px;">{{ $user_data['customer_alamat_usaha'] }}</textarea>
                                    <label for="alamat_usaha">Alamat Usaha</label>
                                </div>
                            </div>
                            @endif

                            @if($user_data['customer_jam_operasional'])
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control " id="jam_operasional" placeholder="contoh: 09:00 - 17:00" value="{{ $user_data['customer_jam_operasional'] }}">
                                    <label for="jam_operasional">Jam Operasional</label>
                                </div>
                            </div>
                            @endif

                            @if($user_data['customer_jam_pengiriman'])
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control " id="jam_pengiriman" placeholder="contoh: 09:00 - 17:00" value="{{ $user_data['customer_jam_pengiriman'] }}">
                                    <label for="jam_pengiriman">Jam Pengiriman</label>
                                    {{-- <select class="form-select" id="jam_pengiriman">
                                        <option value="09:00 - 12:00">09:00 - 12:00</option>
                                        <option value="12:00 - 15:00">12:00 - 15:00</option>
                                        <option value="15:00 - 18:00">15:00 - 18:00</option>
                                        <option value="18:00 - 21:00">18:00 - 21:00</option>
                                    </select> --}}
                                </div>
                            </div>
                            @endif
                           <!-- <div class="col-12 col-md-12 col-lg-12">
                                <div class="form-group form-floating  mb-3">
                                    <input type="text" class="form-control" name="customer_email" value="{{$user_data['customer_email']}}" placeholder="Masukan Alamat Email">
                                    <label for="emailphone">Email</label>
                                </div>
                            </div> -->

                           <!-- <div class="col-12 col-md-12 col-lg-12">
                                <button class="btn btn-default btn-lg shadow-sm pull-right" style="width: 100%;">Simpan
                                </button>

                            </div>!-->

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- address  -->
        <!--<div class="row mb-3">
            <div class="col align-self-center">
                <h5 class="mb-0">Alamat</h5>
            </div>
            <div class="col-auto pe-0 align-self-center">
                <a href="{{ route('cart.form_address') }}" class="link text-color-theme">
                    <i class="bi bi-plus"></i>
                    Tambah Alamat

                </a>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm product mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col align-self-center">
                                <h5 class="mb-0">Rumah<br>
                                    <span class="text-opac small">Utama</span>
                                </h5>
                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('cart.form_address') }}" class="btn btn-link text-color-theme"><i
                                        class="bi bi-trash "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                Perum Komplek indah no 36, Jelegong, Rancekek,<br>Kab. Bandung - 30394
                            </div>
                          </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-auto align-self-center">
                            <a href="{{ route('cart.form_address') }}" class="btn btn-link text-color-theme"><i
                                    class="bi bi-pencil "></i>
                                <span class="size-18">Ubah Alamat</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card shadow-sm product mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col align-self-center">
                                <h5 class="mb-0">Kantor<br>
                                    <span class="text-opac small"></span>
                                </h5>
                            </div>
                            <div class="col-auto align-self-center">
                                <a href="{{ route('cart.form_address') }}" class="btn btn-link text-color-theme"><i
                                        class="bi bi-trash "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                Perum Cibiru indah no 36, Jelegong, Panyilekan,<br>Kota - 30394
                            </div>
                      </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-auto align-self-center">
                            <a href="{{ route('cart.form_address') }}" class="btn btn-link text-color-theme"><i
                                    class="bi bi-pencil "></i>
                                <span class="size-18">Ubah Alamat</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>!-->
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn_proses").click(function() {
            window.location.href = "{{route('order.process')}}";
        });

         $(".btn_selesai").click(function(){
            window.location.href = "{{route('order.finish')}}";
        });

         $(".btn_cancel").click(function(){
            window.location.href = "{{route('order.cancel')}}";
        });
    });
</script>

@endsection
