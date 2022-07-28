<!-- Large Size -->
<div class="modal fade" id="form_modal_variant" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="largeModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<span class="text-danger pull-right">* (Wajib di isi)</span>
				<form class="form-variant" method="post" novalidate="novalidate">
					<label for="product_id">Pilih Produk <span class="text-danger">*</span></label>
					<div class="form-group">
						<div class="form-line">
							<select name="produk_id" class="select2" id="produk_id">
								<?php foreach ($produk_data as $produk) : ?>
									<option value="<?= $produk['produk_id'] ?>"> <?= $produk['produk_nama'] ?> </option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-5 col-xs-12">
							<label>Nama Varian <span class="text-danger">*</span></label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control" name="variant[0][nama]" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3 col-xs-5">
							<label>Harga Biasa <span class="text-danger">*</span></label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control" name="variant[0][harga_biasa]" required>
								</div>
							</div>
						</div>
						<div class="col-sm-3 col-xs-5">
							<label>Harga Bisnis <span class="text-danger">*</span></label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control" name="variant[0][harga_bisnis]" required>
								</div>
							</div>
						</div>
						<div class="col-sm-1 col-xs-2">
							<button type="button" class="btn btn-circle waves-effect waves-circle waves-float btn-success btn-add-variant">
								<i class="material-icons">add</i>
							</button>
						</div>
					</div>

					<div class="variants-list">
						<!-- <div class="row">
							<div class="col-md-5">
								<label>Nama Varian <span class="text-danger">*</span></label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control" name="variant[][nama]" required>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label>Harga Biasa <span class="text-danger">*</span></label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control" name="variant[][harga_biasa]" required>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label>Harga Bisnis <span class="text-danger">*</span></label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control" name="variant[][harga_bisnis]" required>
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<button class="btn  btn-circle waves-effect waves-circle waves-float btn-danger">
									<i class="material-icons">delete</i>
								</button>
							</div>
						</div> -->
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-save-variant btn-link waves-effect">Simpan Varian</button>
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
