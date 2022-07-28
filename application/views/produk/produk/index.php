 <!-- JQuery DataTable Css -->
 <link href="<?= base_url() . "assets/" ?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
 <section class="content">
 	<div class="container-fluid">
 		<div class="block-header">
 			<h2> Produk
 				<!--<small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>!-->
 			</h2>
 		</div>
 		<!-- Basic Examples -->
 		<div class="row clearfix">
 			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 				<div class="card">
 					<div class="header">
 						<div class="row">
 							<div class="col-lg-9">
 								<h2> Data Produk </h2>
 							</div>
 							<div class="col-lg-3 d-flex">
 								<button class="btn btn-small btn-primary btn-create-variant">Tambah Variant</button>
 								<button class="btn btn-small btn-primary btn-create">Tambah Produk</button>
 							</div>
 						</div>
 						<!--<ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>!-->
 					</div>
 					<div class="body">
 						<div class="table-responsive">
 							<table
 								class="table table-bordered table-striped table-hover js-basic-example dataTable table_group">
 								<thead>
 									<tr>
 										<th width="50" class="no-filter">Foto Produk</th>
 										<th width="50" title="Nama Produk">Nama Produk</th>
 										<th width="30" title="Kategori">Kategori</th>
 										<th width="30" class="no-filter">Status</th>
 										<th width="30" class="no-filter">Sameday</th>
 										<th width="30" class="no-filter" title="Harga Beli">Harga Beli</th>
 										<th width="30" class="no-filter" title="Harga Jual">Harga Jual</th>
 										<th width="30" class="no-filter" title="Harga Promo">Harga Promo</th>
 										<th width="100" class="no-filter">-</th>
 									</tr>
 								</thead>
 								<tbody>
 								</tbody>
 							</table>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<!-- #END# Basic Examples -->
 	</div>
 </section>
 <!--- Modal ---->
 <?= $form ?>
 <?= $form_variant ?>
 <?= $form_variant_edit ?>
 <?= $modal_harga ?>

 <!-- Jquery DataTable Plugin Js -->
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
 <script src="<?= base_url() . "assets/" ?>plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
 <!-- Custom Js -->
 <script src="<?= base_url() . "assets/" ?>js/admin.js"></script>
 <script type="text/javascript">
var dt_table, table_harga;
$(function() {
	table_harga = $(".table_harga").DataTable();
	dt_table = $('.js-basic-example').DataTable({
		"bLengthChange": false,
		"ordering": true,
		"processing": true,
		"serverSide": true,
		"scrollX": false,
		"ajax": {
			"url": "<?= base_url() . "produk/get_data" ?>",
			"dataType": "json",
			"type": "GET",
			"error": function(l) {
				console.log(l);
				console.log(l.responseText);
			}
		},
		'columnDefs': [{
			'targets': 0,
			'createdCell': function(td, cellData, rowData, row, col) {}
		}, ],
		"columns": [{
			"data": "produk_foto"
		}, {
			"data": "produk_nama"
		}, {
			"data": "kategori_nama"
		}, {
			"data": "produk_status"
		}, {
			"data": "produk_someday"
		}, {
			"data": "harga_beli",
		}, {
			"data": "harga_jual",
		}, {
			"data": "harga_promo",
		}, {
			"data": "button",
			"orderable": false
		}],
		"order": [
			[1, 'asc']
		]
	});
});
$('.table_group thead tr').clone(true).appendTo('.table_group thead');
$('.table_group thead tr:eq(0) th').each(function(i) {
	var title = $(this).text();
	$(this).addClass("no-arrow").addClass("bg-light");
	if (!$(this).hasClass("no-filter")) {
		$(this).html(
			'<input type="text" style="width:100%" class="form-control form-control-sm" placeholder="Filter by ' +
			title + '" />');
	} else {
		$(this).html("-");
	}
	$('input, select', this).on('keyup change', delay(function() {
		if (dt_table.column(i).search() !== this.value) {
			console.log(this.value);
			dt_table.column(i).search(this.value).draw();
		}
	}, 800));
});
$(document).on("click", ".btn-create", function() {
	$(".modal-title").html("Tambah Produk");
	$("#form_modal").modal("show");
});
$(document).on("click", ".btn-create-variant", function() {
	$(".modal-title").html("Tambah Varian Produk");
	$("#form_modal_variant").modal("show");
});
$(document).on("click", ".btn-save", function() {
	$(".form").trigger("submit");
});
$(document).on("click", ".btn-save-variant", function() {
	$(".form-variant").trigger("submit");
});
$(document).on("click", ".btn-edit-variant", function() {
	$(".form-variant-edit").trigger("submit");
});
$(document).on("click", ".btn-save-harga", function() {
	$(".form_harga").trigger("submit");
});
$(document).on("submit", ".form", function(e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("kategori_id", $("#kategori_id").val());
	var uri = "<?= base_url() . "produk/store" ?>";
	if ($("#produk_id").val().length > 0) {
		uri = "<?= base_url() . "produk/update" ?>";
	}
	$.ajax({
		url: uri,
		data: formData,
		method: "POST",
		"processData": false,
		"contentType": false,
		"mimeType": "multipart/form-data",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			console.log(data);
			var json = $.parseJSON(data);
			if (json.success == 0) {
				warning_alert("Informasi", json.message);
			} else {
				$(".form").trigger("reset");
				$("#form_modal").modal("hide");
				success_alert("Informasi", json.message);
				dt_table.ajax.reload(null, false);
			}
		},
		error: function(xhr) { // if error occured
			console.log(xhr);
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
});
$(document).on("submit", ".form-variant-edit", function(e) {
	e.preventDefault();

	const produk_id    = $("#produk_id").val();
	const variant_nama = $("#variant_nama").val();

	var formData = new FormData(this);
	// formData.append("produk_id", produk_id);
	// formData.append("variant_nama", variant_nama);

	var uri = "<?= base_url() . "produk/store_variant" ?>";

	$.ajax({
		url: uri,
		data: formData,
		method: "POST",
		"processData": false,
		"contentType": false,
		"mimeType": "multipart/form-data",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			var json = $.parseJSON(data);
			if (json.success == 0) {
				warning_alert("Informasi", json.message);
			} else {
				$(".modal").modal("hide");
				success_alert("Informasi", json.message);
				dt_table.ajax.reload(null, false);
			}
		},
		error: function(xhr) { // if error occured
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
});
$(document).on("submit", ".form-variant", function(e) {
	e.preventDefault();

	const produk_id    = $("#produk_id").val();
	const variant_nama = $("#variant_nama").val();

	var formData = new FormData(this);
	// formData.append("produk_id", produk_id);
	// formData.append("variant_nama", variant_nama);

	var uri = "<?= base_url() . "produk/store_variant" ?>";

	$.ajax({
		url: uri,
		data: formData,
		method: "POST",
		"processData": false,
		"contentType": false,
		"mimeType": "multipart/form-data",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			var json = $.parseJSON(data);
			if (json.success == 0) {
				warning_alert("Informasi", json.message);
			} else {
				$(".form-variant").trigger("reset");
				$(".modal").modal("hide");
				success_alert("Informasi", json.message);
				dt_table.ajax.reload(null, false);
			}
		},
		error: function(xhr) { // if error occured
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
});
$(document).on("submit", ".form_harga", function(e) {
	e.preventDefault();
	var formData = new FormData(this);
	var uri = "<?= base_url() . "produk/store_harga" ?>";
	$.ajax({
		url: uri,
		data: formData,
		method: "POST",
		"processData": false,
		"contentType": false,
		"mimeType": "multipart/form-data",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			console.log(data);
			var json = $.parseJSON(data);
			if (json.success == 0) {
				warning_alert("Informasi", json.message);
			} else {
				$(".form_harga").trigger("reset");
				$("#modal_harga").modal("hide");
				success_alert("Informasi", json.message);
				dt_table.ajax.reload(null, false);
			}
		},
		error: function(xhr) { // if error occured
			console.log(xhr);
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
});

var variant_count = 0;
$(document).on("click", ".btn-add-variant", function(e) {
	++variant_count
	$('.variants-list').append(`
		<div class="row">
			<div class="col-sm-5 col-xs-12">
				<label>Nama Varian <span class="text-danger">*</span></label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" class="form-control" name="variant[${variant_count}][nama]" required>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-5">
				<label>Harga Biasa <span class="text-danger">*</span></label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" class="form-control" name="variant[${variant_count}][harga_biasa]" required>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-5">
				<label>Harga Bisnis <span class="text-danger">*</span></label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" class="form-control" name="variant[${variant_count}][harga_bisnis]" required>
					</div>
				</div>
			</div>
			<div class="col-sm-1 col-xs-2">
				<button type="button" class="btn btn-circle waves-effect waves-circle waves-float btn-danger btn-remove-variant">
					<i class="material-icons">delete</i>
				</button>
			</div>
		</div>
	`)
});

$(document).on("click", ".btn-remove-variant", function(e) {
	$(this).closest('.row').remove();
});

$('#form_modal').on('hidden.bs.modal', function(e) {
	$(".form").trigger("reset");
	$("#produk_id").val("");
	$(".alert-upload").hide();
	$("#kategori_id").val("").trigger('change');
});
$('#modal_harga').on('hidden.bs.modal', function(e) {
	$(".form_harga").trigger("reset");
	$("#produk_id_harga").val("");
});

function show_edit(produk_id) {
	$.ajax({
		url: "<?= base_url() . "produk/show?produk_id=" ?>" + produk_id,
		method: "GET",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			swal.close();
			console.log(data);
			var json = $.parseJSON(data);
			$("#produk_id").val(json.data.produk_id);
			$("#produk_nama").val(json.data.produk_nama);
			$("#kategori_id").select2("val", json.data.kategori_id);
			$("#produk_status").select2("val", json.data.produk_status);
			$("#produk_someday").select2("val", json.data.produk_someday);
			$(".alert-upload").show();
			$("#produk_shortdesc").val(json.data.produk_shortdesc);
			$("#produk_desc").val(json.data.produk_desc);
			$(".modal-title").html("Ubah Produk");
			$("#form_modal").modal("show");
		},
		error: function(xhr) { // if error occured
			console.log(xhr);
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
}

function edit_variant(produk_id) {
	const form = $("#form_modal_variant_edit")
	form.find('.variants-list').html('')

	$.ajax({
		url: "<?= base_url() . "produk/show?produk_id=" ?>" + produk_id,
		method: "GET",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			swal.close();
			var json = $.parseJSON(data);
			form.find('[name="produk_id"]').val(json.data.produk_id);
			form.find('[name="produk_nama"]').val(json.data.produk_nama);

			$.get("<?= base_url() . "produk/show_variant?produk_id=" ?>" + produk_id)
				.then((variant_data) => {
					var variant_json = $.parseJSON(variant_data);
					let variant_count_edit = 0

					variant_json.data.forEach(variant => {
						const variant_id   = variant.produk_variant_id
						const variant_nama = variant.produk_variant_nama
						const harga_biasa  = variant.produk_variant_harga_jual > 0 ? variant.produk_variant_harga_jual : 0
						const harga_bisnis = variant.produk_variant_harga_jual_bisnis > 0 ? variant.produk_variant_harga_jual_bisnis : 0

						form.find('.variants-list').append(`
							<div class="row">
								<div class="col-sm-5 col-xs-12">
									<label>Nama Varian <span class="text-danger">*</span></label>
									<div class="form-group">
										<div class="form-line">
											<input type="hidden" value="${variant_id}" name="variant[${variant_count_edit}][id]" required>
											<input type="text" class="form-control" value="${variant_nama}" name="variant[${variant_count_edit}][nama]" required>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-5">
									<label>Harga Biasa <span class="text-danger">*</span></label>
									<div class="form-group">
										<div class="form-line">
											<input type="text" class="form-control" value="${harga_biasa}" name="variant[${variant_count_edit}][harga_biasa]" required>
										</div>
									</div>
								</div>
								<div class="col-sm-3 col-xs-5">
									<label>Harga Bisnis <span class="text-danger">*</span></label>
									<div class="form-group">
										<div class="form-line">
											<input type="text" class="form-control" value="${harga_bisnis}" name="variant[${variant_count_edit}][harga_bisnis]" required>
										</div>
									</div>
								</div>
								<div class="col-sm-1 col-xs-2">
									<button type="button" class="btn btn-circle waves-effect waves-circle waves-float btn-danger btn-remove-variant" onclick=delete_variant(${variant_id})>
										<i class="material-icons">delete</i>
									</button>
								</div>
							</div>
						`)

						variant_count_edit++
					});
				})

			form.modal("show");
		},
		error: function(xhr) { // if error occured
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
}

function show_harga(produk_id) {
	$.ajax({
		url: "<?= base_url() . "produk/show_harga?produk_id=" ?>" + produk_id,
		method: "GET",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			swal.close();
			console.log(data);
			var json = $.parseJSON(data);
			$("#produk_id_harga").val(produk_id);
			if (json.data != null) {
				$("#harga_beli").val(json.data.harga_beli);
				$("#harga_jual").val(json.data.harga_jual);
				$("#harga_promo").val(json.data.harga_promo);
				$("#harga_desc").val(json.data.harga_desc);
			}
			table_harga.clear();
			$.each(json.table, function(i, item) {
				table_harga.row.add([
					item.harga_beli,
					item.harga_jual,
					item.harga_promo,
					item.harga_desc,
					item.harga_created
				]);
			});
			table_harga.draw();
			$(".modal-title").html("Harga Produk");
			$("#modal_harga").modal("show");
		},
		error: function(xhr) { // if error occured
			console.log(xhr);
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
}

function delete_data(kategori_id) {
	$.ajax({
		url: "<?= base_url() . "produk/kategori/delete?kategori_id=" ?>" + kategori_id,
		method: "GET",
		beforeSend: function() {
			loading_alert();
		},
		success: function(data) {
			console.log(data);
			var json = $.parseJSON(data);
			success_alert("Informasi", json.message);
			dt_table.ajax.reload(null, false);
		},
		error: function(xhr) { // if error occured
			console.log(xhr);
			warning_alert("Informasi", "Kesalahan dari server");
		}
	});
}

function delete_variant(variant_id) {
	$.get("<?= base_url() . "produk/delete_variant?variant_id=" ?>" + variant_id).then(() => dt_table.ajax.reload(null, false));
}
 </script>
