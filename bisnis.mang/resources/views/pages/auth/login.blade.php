@extends('layout/layout')

@section('content')
<div class="row h-100">
    <div class="col-12 mx-auto text-center">
        <div class="row h-100">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto align-self-center">
                <h2 class="text-center mb-4">Login / Daftar</h2>
                <div class="card card-light shadow-sm mb-4">
                    <div class="card-body">
                        <form class=" was-validated">
                            <div class="form-floating mb-3">
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
                        </form>
                        <div class="d-grid">
                            <a href="javascript:;" class="btn btn-lg btn-default shadow-sm" onclick="login(this)">Login / Daftar </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection
