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
                    <input type="hidden" name="kategori_id" id="kategori_id">
                    <label for="email_address">Nama Kategori <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="kategori_name" id="kategori_name" class="form-control" placeholder="Masukan Nama Kategori" required="" >
                        </div>
                    </div>
                    <label for="password">Icon <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                           <input type="file" class="form-control" name="kategori_icon" accept="images/*" required="">
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