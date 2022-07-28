 <!-- JQuery DataTable Css -->
<link href="<?php echo base_url()."assets/"?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Kategori Produk
                    <!--<small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>!-->
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                           <div class="row">
                               <div class="col-lg-10">
                                    <h2>
                                        Data Kategori
                                    </h2>
                               </div>
                               <div class="col-lg-2">
                                    <button class="btn btn-small btn-primary btn-create">Tambah Kategori</button>
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
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable table_group">
                                    <thead>
                                        <tr>
                                            <th width="20" class="no-filter">Icon</th>
                                            <th width="100" title="Kategori">Nama Kategori</th>
                                            <th width="10" class="no-filter">-</th>
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
    <?php echo $form?>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url()."assets/"?>js/admin.js"></script>
    <script type="text/javascript">
       var dt_table;
       $(function () {
            dt_table = $('.js-basic-example').DataTable({
                "bLengthChange": false,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "scrollX": false,
                "ajax": {
                     "url": "<?php echo base_url()."produk/kategori/get_data"?>",
                     "dataType": "json",
                     "type": "GET",
                     "error": function(l){
                        console.log(l);
                         console.log(l.responseText);
                     }
              },
              'columnDefs': [
                 {
                    'targets': 0,
                    'createdCell':  function (td, cellData, rowData, row, col) {
                   
                    }
                },
            ],
            "columns": [
                {
                    "data": "kategori_icon",
                    "orderable":false
                },
                {
                    "data": "kategori_nama"
                },
                {
                   "data" : "button",
                   "orderable":false
                }
            ],
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
            $(this).html('<input type="text" style="width:100%" class="form-control form-control-sm" placeholder="Filter by ' + title + '" />');
        } 
        else {
            $(this).html("-");
        }

        $('input, select', this).on('keyup change', delay(function() {
          if (dt_table.column(i).search() !== this.value) {
              console.log(this.value);
              dt_table.column(i).search(this.value).draw();
          }
        },800));

    });


    $(document).on("click",".btn-create",function(){
        $(".modal-title").html("Tambah Kategori");
        $("#form_modal").modal("show");
    });

    $(document).on("click",".btn-save",function(){
        $(".form").trigger("submit");
    });

    $(document).on("submit",".form",function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var uri = "<?php echo base_url()."produk/kategori/store"?>";
        if($("#kategori_id").val().length>0){
          uri = "<?php echo base_url()."produk/kategori/update"?>";
        }
        
        $.ajax({
              url: uri,
              data: formData,
              method:"POST",
              "processData": false,
              "contentType": false,
              "mimeType": "multipart/form-data",
              beforeSend:function(){
                  loading_alert();
              },
              success: function(data) { 
               console.log(data);
               var json = $.parseJSON(data);
               if(json.success==0){
                    warning_alert("Informasi",json.message);
               }
               else{
                    $(".form").trigger("reset");
                    $("#form_modal").modal("hide");
                    success_alert("Informasi",json.message);
                    dt_table.ajax.reload(null, false);
               }
                   
              },
              error: function(xhr) { // if error occured
                  console.log(xhr);
                  warning_alert("Informasi","Kesalahan dari server");
               }
            });
    });

    $('#form_modal').on('hidden.bs.modal', function (e) {
         $(".form").trigger("reset");
         $(".alert-upload").hide();
         $("#kategori_id").val("");
    });

    function show_edit(kategori_id){
         $.ajax({
              url: "<?php echo base_url()."produk/kategori/show?kategori_id="?>"+kategori_id,
              method:"GET",
              beforeSend:function(){
                  loading_alert();
              },
              success: function(data) { 
                 swal.close();
                 console.log(data);
                 var json = $.parseJSON(data);
                 $("#kategori_id").val(json.data.kategori_id);
                 $("#kategori_name").val(json.data.kategori_nama);
                 $(".modal-title").html("Ubah Kategori");
                 $(".alert-upload").show();
                 $("#form_modal").modal("show");
              },
              error: function(xhr) { // if error occured
                  console.log(xhr);
                  warning_alert("Informasi","Kesalahan dari server");
               }
            });
    }

    function delete_data(kategori_id){
       $.ajax({
          url: "<?php echo base_url()."produk/kategori/delete?kategori_id="?>"+kategori_id,
          method:"GET",
          beforeSend:function(){
              loading_alert();
          },
          success: function(data) { 
             console.log(data);
             var json = $.parseJSON(data);
             success_alert("Informasi",json.message);
             dt_table.ajax.reload(null, false);
          },
          error: function(xhr) { // if error occured
              console.log(xhr);
              warning_alert("Informasi","Kesalahan dari server");
           }
        });
    }

   </script>
