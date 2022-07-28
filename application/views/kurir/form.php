<!-- Large Size -->
<div class="modal fade" id="form_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <span class="text-danger pull-right">* (Wajib di isi)</span>

               <form class="form" method="post" novalidate="novalidate">
                    <input type="hidden" name="kurir_id" id="kurir_id">
                    <label for="email_address">Nama Kurir <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="kurir_nama" id="kurir_nama" class="form-control" placeholder="Masukan Nama Kurir" required="" >
                        </div>
                    </div>
                    <label for="email_address">Whatsapp <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="kurir_wa" id="kurir_wa" class="form-control" placeholder="Masukan No. Whatsapp" required="" >
                        </div>
                    </div>
                    <label for="email_address">No. Polisi <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="kurir_nopol" id="kurir_nopol" class="form-control" placeholder="Masukan No. Polisi" required="" >
                        </div>
                    </div>
                    <label for="email_address">Alamat <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" placeholder="Masukan alamat" name="kurir_alamat" maxlength="100" rows="4" id="kurir_alamat"></textarea>
                        </div>
                    </div>
                    <label for="password">KTP <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                           <input type="file" class="form-control" name="kurir_ktp" accept="images/*" required="">
                        </div>
                    </div>
                    <div class="alert alert-warning alert-upload" style="display: none;">
                        Kosongkan bila tidak mengubah file
                    </div>
               </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-save btn-link waves-effect">Simpan Perubahan</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>