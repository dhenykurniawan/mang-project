 <!-- JQuery DataTable Css -->
<link href="<?php echo base_url()."assets/"?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                   Surat Jalan
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
                                        Data Surat Jalan
                                    </h2>
                               </div>
                               <div class="col-lg-2">
                                    <button class="btn btn-small btn-primary btn-create">Tambah Surat Jalan</button>
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
                                            <th width="100" title="No Surat Jalan">Surat Jalan No.</th>
                                            <th width="100" title="order id" class="no-filter date-filter"> Tanggal</th>
                                            <th width="100" title="Nama Kurir">Nama Kurir</th>
                                            <th width="100" title="Total">Total</th>
                                            <th width="100" >-</th>
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
                     "url": "<?php echo base_url()."transaksi/surat_jalan/get_data"?>",
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
                    "data": "sj_id"
                },
                {
                    "data": "sj_tanggal"
                },
                {
                    "data": "kurir_nama"
                },
                
                {
                    "data": "sj_total"
                },
                {
                   "data" : "button",
                   "orderable":false
                }
            ],
            "order": [
                [0, 'desc']
            ]
        }); 

        $('#order_id').select2({
           width:"100%",
           minimumInputLength: 2,
           allowClear: true,
           placeholder: 'Masukan Order ID',
           ajax: {
              dataType: 'json',
              url: '<?php echo base_url()."transaksi/order/get_order_invoice"?>',
              delay: 800,
              method:"POST",
              data: function(params) {
                return {
                  order_id: params.term
                }
              },
              error:function(res){
                console.log(res);
              },
              processResults: function (data, page) {
                  console.log(data);
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.order_id,
                                id: item.order_id,
                                data: item
                            }
                        })
                    };
                },
          }
      });

       $('#order_id').on('select2:selecting', function(e) {
              var value = e.params.args.data;
              $("#invoice_total").val(rupiah(value.data.order_total));
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

        if($(this).hasClass("date-filter")){
          $(this).html('<input type="date"  class="form-control form-control-sm" placeholder="Filter by ' + title + '" />');
        }

        $('input, select', this).on('keyup change', delay(function() {
          if (dt_table.column(i).search() !== this.value) {
              console.log(this.value);
              dt_table.column(i).search(this.value).draw();
          }
        },800));

    });


    $(document).on("click",".btn-create",function(){
        $(".modal-title").html("Tambah Invoice");
        $(".select2").val("").trigger("change");
         $(".row_order").html("");
        $("#sj_id").val("");
        $("#form_modal").modal("show");
    });

    $(document).on("click",".btn-save",function(){
        $(".form").trigger("submit");
    });

    var index_order = 0;
    $(document).on("click",".btn_tambah_order",function(){
         index_order++;
        var html = `<div class='row row-${index_order}'>
                          <div class="col-sm-10">
                              <div class="form-group">
                                  <div class="form-line">
                                     <select name="order_id[]" class="select2 select-order">
                                        <option value="" selected></option>
                                       
                                     </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-2">
                            <button class="btn btn-sm btn-danger" onclick="hapus_order(${index_order})">Hapus</button>
                          </div>
                        </div>`;

           $(".row_order").append(html);
           $(".row-"+index_order).find(".select-order").select2({
                    width:"100%",
                    placeholder: "Loading...",
                    allowClear: true,
                   
              });
            get_order($(".row-"+index_order).find(".select-order"));


    });

     function hapus_order(index){
      $(".row-"+index).remove();
    }

    function get_order(el){
       var formData = new FormData();
       var uri = "<?php echo base_url()."transaksi/order/get_order_surat_jalan"?>";
       
        
        $.ajax({
              url: uri,
              data: formData,
              method:"POST",
              "processData": false,
              "contentType": false,
              "mimeType": "multipart/form-data",
              beforeSend:function(){
              },
              success: function(data) { 
               data = $.parseJSON(data);
               var option=[];
               $.each(data,function(i,item){
                    var selected  = false;
                    option.push({id:item.order_id,text:item.order_id,selected:selected});
               });
               el.select2({
                    width:"100%",
                    placeholder: "Pilih Order",
                    allowClear: true,
                    data:option
                });
               
                   
              },
              error: function(xhr) { // if error occured
                  console.log(xhr);
               }
            });
    }


    $(document).on("submit",".form",function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var uri = "<?php echo base_url()."transaksi/surat_jalan/store"?>";
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
         $("#invoice_id").val("");
    });

    function print(sj_id){
       window.open('<?php echo base_url()."transaksi/surat_jalan/print?sj_id="?>'+sj_id, '_blank');
    }

     function delete_data(sj_id){
       $.ajax({
          url: "<?php echo base_url()."transaksi/surat_jalan/delete?sj_id="?>"+sj_id,
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
