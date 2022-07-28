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
                    <input type="hidden" name="invoice_id" id="invoice_id">
                    <label for="email_address">Order <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <select name="order_id" class="select2" id="order_id"></select>
                        </div>
                    </div>
                    <label for="email_address">Total <span class="text-danger">*</span></label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="invoice_total" id="invoice_total" class="form-control" value="0" readonly="" >
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