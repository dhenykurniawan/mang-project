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
                    <input type="hidden" name="produk_id" id="produk_id">
                    <label for="email_address">Nama Produk <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="produk_nama" id="produk_nama" class="form-control" placeholder="Masukan Nama Produk" required="" >
                        </div>
                    </div>
                    <label for="email_address">Kategori <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                           <select name="kategori_id" class="select2" id="kategori_id">
                              <?php
                              foreach ($kategori_data as $kd):
                              ?>
                                <option value="<?php echo $kd['kategori_id']?>">
                                    <?php echo $kd['kategori_nama']?>        
                                </option>
                              <?php
                              endforeach;
                              ?>
                               
                           </select>
                        </div>
                    </div>
                    <label for="password">Produk Foto <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                           <input type="file" class="form-control" name="produk_gambar" accept="images/*" required="">
                        </div>
                    </div>
                     <div class="alert alert-warning alert-upload" style="display: none;">
                        Kosongkan bila tidak mengubah file
                    </div>

                    <label for="password">Produk Status <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                           <select name="produk_status" class="select2" id="produk_status">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                                
                           </select>
                        </div>
                    </div>


                    <label for="password">Produk Sameday <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                           <select name="produk_someday" class="select2" id="produk_someday">
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                           </select>
                        </div>
                    </div>


                    <label for="email_address">Deskripsi Singkat <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" placeholder="Masukan deskripsi singkat produk" name="produk_shortdesc" maxlength="100" rows="4" id="produk_shortdesc"></textarea>
                        </div>
                    </div>

                    <label for="email_address">Deskripsi</label>
                    <div class="form-group">
                        <div class="form-line">
                            <textarea class="form-control no-resize" placeholder="Masukan deskripsi produk" name="produk_desc" rows="4" id="produk_desc"></textarea>
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