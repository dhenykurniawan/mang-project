<!-- Large Size -->
<div class="modal fade" id="form_modal_variant_edit" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Ubah Varian</h4>
			</div>
			<div class="modal-body">
				<form class="form-variant-edit" method="post" novalidate="novalidate">
					<label for="product_id">Nama Produk</label>
					<div class="form-group">
						<div class="form-line">
							<input type="hidden" name="update_variant" value="1">
							<input type="hidden" name="produk_id">
							<input type="text" class="form-control bg-light" name="produk_nama" disabled>
						</div>
					</div>

					<div class="variants-list"></div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-edit-variant btn-link waves-effect">Ubah Varian</button>
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
