<!-- Large Size -->
<div class="modal fade" id="form_modal"  role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <span class="text-danger pull-right">* (Wajib di isi)</span>

               <form class="form" method="post" novalidate="novalidate">
                    <input type="hidden" name="sj_id" id="sj_id">
                    <label for="email_address">Kurir <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <select name="kurir_id" class="select2" id="kurir_id">
                                <?php
                                foreach ($data_kurir as $dk):
                                ?>
                                    <option value="<?php echo $dk['kurir_id']?>"><?php echo $dk['kurir_nama']?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <label for="email_address">Untuk Tanggal <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date"  name="sj_tanggal" id="sj_tanggal" class="form-control"required="" >
                        </div>
                    </div>
                     <label for="email_address">Keterangan </label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" placeholder="Masukan Keterangan" name="sj_keterangan" rows="2" id="sj_keterangan"></textarea>
                        </div>
                    </div>

                    <label for="email_address">Order <span class="text-danger">*</span></label>
                    <div class="row_order">
                      
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                             <button type="button" class="btn btn-sm btn-primary pull-right btn_tambah_order">Tambah Order</button>
                        </div>
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