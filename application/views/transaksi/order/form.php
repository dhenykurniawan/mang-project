<!-- Large Size -->
<div class="modal fade" id="form_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                

               <form class="form" method="post" novalidate="novalidate">
                    <input type="hidden" name="order_id" id="order_id">
                    <div class="row">
                        <div class="col-sm-6"> 
                            <label for="email_address">Atas Nama <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="order_nama" id="order_nama" class="form-control" placeholder="Masukan Nama" required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="email_address">Whatsapp <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="order_wa" id="order_wa" class="form-control" placeholder="Masukan No. Whatsapp" required="" >
                                </div>
                            </div>
                        </div>
                       <div class="col-sm-6">
                            <label for="email_address">Provinsi <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="order_provinsi" id="order_provinsi" class="form-control select2">
                                      <?php
                                      foreach ($data_provinsi as $dp):
                                      ?>
                                        <option value="<?php echo $dp['provinsi_id']?>"><?php echo $dp['provinsi_name']?></option>
                                      <?php
                                      endforeach;
                                      ?>
                                    </select>     
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="email_address">Kota <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="order_kota" id="order_kota" class="form-control select2">
                                       <?php
                                      foreach ($data_kota as $dk):
                                      ?>
                                        <option value="<?php echo $dk['kota_id']?>"><?php echo $dk['kota_name']?></option>
                                      <?php
                                      endforeach;
                                      ?>
                                    </select>     
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="email_address">Kecamatan <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="order_kecamatan" id="order_kecamatan" class="form-control select2">
                                    </select>     
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="email_address">Kelurahan <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select name="order_kelurahan" id="order_kelurahan" class="form-control select2">
                                    </select>     
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12">
                             <label for="email_address">Alamat <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize" placeholder="Masukan alamat" name="order_alamat" rows="2" id="order_alamat"></textarea>
                                    </div>
                                </div>
                        </div>
                         <div class="col-sm-4">
                            <label for="email_address">Untuk Tanggal <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="date"  name="order_tanggal" id="order_tanggal" class="form-control"required="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                                <label for="email_address">Metode Pembayaran <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <select name="order_payment_method" id="order_payment_method" class="form-control">
                                           <option value="cod">COD</option>
                                           <option value="transfer">Transfer</option>
                                       </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col-sm-4">
                                <label for="email_address">Status <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <select name="order_status" id="order_status" class="form-control">
                                           <option value="draft">Draft</option>
                                          <!-- <option value="approved-admin">Approved Admin</option>!-->
                                           <option value="cancel-admin">Cancel Admin</option>
                                           <option value="finish">Finish</option>
                                          <!-- <option value="cancel-user">Cancel User</option>!-->
                                           <!--<option value="reorder">Reorder</option>
                                           <option value="refund">Refund</option>
                                           <option value="ongoing">Ongoing</option>
                                           <option value="approved-user">Approved User</option>!-->

                                       </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <label for="email_address">Produk <span class="text-danger">*</span></label>
                    
                    <div class="row_produk">
                      
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                             <button type="button" class="btn btn-sm btn-primary pull-right btn_tambah_produk">Tambah Produk</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                             <label  for="email_address">Subtotal <span class="text-danger">*</span></label>
                              <input type="text" name="order_subtotal" class="form-control order_subtotal"  readonly="" value="0" >
                        </div>
                        <div class="col-sm-3">
                             <label  for="email_address">Diskon (Rp)</label>
                              <input  type="text" name="order_diskon" class="form-control order_diskon"  value="0" >
                        </div>
                        <div class="col-sm-3">
                             <label  for="email_address">Ongkir (Rp)</label>
                              <input  type="text" name="order_ongkir" class="form-control order_ongkir"  value="0" >
                        </div>
                         <div class="col-sm-3">
                             <label for="email_address">Total <span class="text-danger">*</span></label>
                              <input type="text" name="order_total" class="form-control order_total"  readonly="" value="0" >
                        </div>
                        <div class="col-sm-12">
                        <br />
                        <label for="email_address">Bonus</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea class="form-control no-resize" name="bonus" rows="2" id="bonus" disabled></textarea>
                                </div>
                            </div>
                    </div>
                         <div class="col-sm-12">
                            <br />
                             <label for="email_address">Keterangan</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea class="form-control no-resize" placeholder="Masukan keterangan" name="order_keterangan" rows="2" id="order_keterangan"></textarea>
                                    </div>
                                </div>
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