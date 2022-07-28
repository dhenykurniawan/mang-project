<!-- Large Size -->
<div class="modal fade" id="modal_harga"  role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <span class="text-danger pull-right">* (Wajib di isi)</span>
               <form class="form_harga" method="post" novalidate="novalidate">
                    <input type="hidden" name="produk_id" id="produk_id_harga">
                    <label for="email_address">Harga Beli <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="harga_beli" id="harga_beli" class="form-control" placeholder="Masukan Harga Beli" required="" >
                        </div>
                    </div>
                    <label for="email_address">Harga Jual <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Masukan Harga Jual" required="" >
                        </div>
                    </div>
                    <label for="email_address">Harga Promo</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" name="harga_promo" id="harga_promo" class="form-control" placeholder="Masukan Harga Promo" >
                        </div>
                    </div>
                    <label for="email_address">Keterangan <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" placeholder="Masukan Keterangan" name="harga_desc" maxlength="100" rows="4" id="harga_desc"></textarea>
                        </div>
                    </div>
               </form>
               <h2>History Harga</h2>
               <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover  dataTable table_harga">
                        <thead>
                            <tr>
                                <th width="30">Harga Beli</th>
                                <th width="30">Harga Jual</th>
                                <th width="30">Harga Promo</th>
                                <th width="50">Keterangan</th>
                                <th width="50">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-save-harga btn-link waves-effect">Simpan Perubahan</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>