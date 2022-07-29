 <!-- JQuery DataTable Css -->
<link href="<?php echo base_url()."assets/"?>plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Order
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
                                        Data Order
                                    </h2>
                               </div>
                               <div class="col-lg-2">
                                    <button style="display: none;" class="btn btn-small btn-primary btn-create">Tambah Order</button>
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
                                            <th width="10"  title="Order ID">Order ID</th>
                                            <th width="30" title="Atas Nama">Atas Nama</th>
                                            <th width="20" title="Whatsapp">Whatsapp</th>
                                             <th width="10" title="Tanggal" class="no-filter date-filter">Waktu Pesan</th>
                                            <th width="10" title="Tanggal" class="no-filter date-filter">Untuk Tanggal</th>
                                            <th width="10" title="Tanggal" class="no-filter select-filter">Status</th>
                                            <th width="10" title="Tanggal" class="no-filter select-method">Metode Pembayaran</th>
                                            
                                             <th width="20" title="Total">Total</th>
                                            <th width="10">Opsi</th>
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
      var free_ongkir_min = parseInt("<?php echo $data_setting['setting_free_ongkir_min']?>");
      var free_ongkir = parseInt("<?php echo $data_setting['setting_free_ongkir']?>");
    
       $(function () {
            dt_table = $('.js-basic-example').DataTable({
                "bLengthChange": false,
                "ordering": true,
                "processing": true,
                "serverSide": true,
                "scrollX": false,
                "ajax": {
                     "url": "<?php echo base_url()."transaksi/order/get_data"?>",
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
                    "data": "order_id",
                },
                {
                    "data": "order_nama"
                },
                {
                    "data": "order_wa"
                },
                {
                    "data": "order_created"
                },
                {
                    "data": "order_tanggal"
                },
                {
                    "data": "order_status"
                },
                {
                    "data": "order_payment_method"
                },
                
                {
                    "data": "order_total"
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

         dt_table.column(0).search("<?php echo $order_id_notif?>").draw();

         $("#order_kota").change(function(){
              var val = $(this).val();
              if(val!=null){
                 if(val.length>0){
                    get_kecamatan(val);
                  }
                  else{
                      $("#order_kecamatan").html("");
                      var option = [];
                      option.push({id:"",text:""});
                      $("#order_kecamatan").select2({data:option});
                  }
              }
             
           });

           $("#order_kecamatan").change(function(){
              var val = $(this).val();
              if(val!=null){
                 if(val.length>0){
                    get_kelurahan(val);
                  }
                  else{
                      $("#order_kelurahan").html("");
                      var option = [];
                      option.push({id:"",text:""});
                      $("#order_kelurahan").select2({data:option});
                  }
              }
             
           });
           $("#order_kelurahan").change(function(){
              var val = $(this).val();
              
              if(val!=null){
                var data =$(this).select2("data")[0];
                data = data.data;
                var kelurahan_ongkir = 0;
                if(free_ongkir==1){

                }
                else{
                  kelurahan_ongkir = data.kelurahan_ongkir;
                  
                }
                $(".order_ongkir").val(kelurahan_ongkir);
                func_total_harga();
               
              
              }
             
           });            
    });
    var kecamatan_id_edit="";
    function get_kecamatan(kota_id){
       var form = new FormData();
       form.append("kota_id",kota_id);
        var url = '<?php echo base_url()?>'+"state/get_kecamatan";
        $.ajax({
            type:'POST',
            data:form,
            contentType:false,
            processData: false,
            url:url,
            beforeSend:function(){
               $("#order_kecamatan").html("");
            },
            success:function(data){
              console.log(data);
              data =$.parseJSON(data);
               var option = [];
               $.each(data,function(i,item){
                    var selected = false;
                    if(kecamatan_id_edit.length>0){
                        if(item.kecamatan_id==kecamatan_id_edit){
                            selected=true;
                        }
                    }
                    option.push({
                        id:item.kecamatan_id,
                        text:item.kecamatan_name,
                        selected:selected,
                        
                      });
               });
               $("#order_kecamatan").select2({data:option});
               $("#order_kecamatan").trigger("change");
               
            },
            error:function(data){
                console.log(data);
            }
        });
    }
    
    var kelurahan_id_edit = "";
   
    function get_kelurahan(kecamatan_id){
       var form = new FormData();
       form.append("kecamatan_id",kecamatan_id);
        var url = '<?php echo base_url()?>'+"state/get_kelurahan";
        $.ajax({
            type:'POST',
            data:form,
            contentType:false,
            processData: false,
            url:url,
            beforeSend:function(){
               $("#order_kelurahan").html("");
            },
            success:function(data){
              console.log(data);
              data =$.parseJSON(data);
               var option = [];
               
               $.each(data,function(i,item){
                    var selected  = false;
                    if(kelurahan_id_edit==item.kelurahan_id){
                        selected=true;
                    }
                    option.push({id:item.kelurahan_id,text:item.kelurahan_name,selected:selected,"data" : item});

               });
               $("#order_kelurahan").select2({data:option});
               
            },
            error:function(data){
                console.log(data);
            }
        });
    }

    $('.table_group thead tr').clone(true).appendTo('.table_group thead');
    $('.table_group thead tr:eq(0) th').each(function(i) {
        var title = $(this).text();
        $(this).addClass("no-arrow").addClass("bg-light");
        if (!$(this).hasClass("no-filter")) {
          if(title=="Order ID"){
            $(this).html('<input type="text" value="<?php echo $order_id_notif?>"   class="form-control form-control-sm" placeholder="Filter by ' + title + '" />');
          }
          else{
             $(this).html('<input type="text"   class="form-control form-control-sm" placeholder="Filter by ' + title + '" />');
          }
        } 
        else {
            $(this).html("-");
        }

        if($(this).hasClass("select-filter")){
          $(this).html(`<center><select class="form-control form-control-sm">
                          <option value="">Semua Status</option>
                          <option value="draft">Draft</option>
                          <option value="approved-admin">Approved Admin</option>
                          <option value="cancel-admin">Cancel Admin</option>
                          <option value="cancel-user">Cancel User</option>
                          <option value="reorder">Reorder</option>
                          <option value="refund">Refund</option>
                          <option value="ongoing">Ongoing</option>
                          <option value="finish">Finish</option>
                        </select></center>`);
        }

        if($(this).hasClass("select-method")){
          $(this).html(`<center><select class="form-control form-control-sm">
                          <option value="">Semua Metode</option>
                          <option value="cod">COD</option>
                          <option value="transfer">Transfer</option>
                        </select></center>`);
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
        $(".modal-title").html("Tambah Order");
        $(".select2").val( "").trigger('change');
        $(".row_produk").html("");
        $("#order_id").val("");
        $("#form_modal").modal("show");
    });

    $(document).on("change",".select-produk", function(e) { 
        var option = $(this).find(":selected");
        var value = $(this).val();
        var text = option.text();
        var harga = 0;
        harga_beli = 0;
        if(option.attr("data")!=null){
          console.log(option.attr("data").replace(/\n/g, ""));
          var data = $.parseJSON(option.attr("data").replace(/\n/g, ""));
          harga_beli = data.harga_beli;
          harga = data.harga_jual;
          if(data.harga_promo>0){
            harga = data.harga_promo;
          }
        }
        var parent = $(this).parent().parent().parent();
        var input_harga = parent.next().find(".harga_satuan");
        input_harga.val(rupiah(harga));
        var input_qty = parent.next().next().find(".jumlah_beli");
        var input_harga_beli = parent.next().next().next().find(".harga_beli");
        input_harga_beli.val(harga_beli);
        
        input_qty.trigger("keyup");
    });

    $(document).on('keyup mouseup','.jumlah_beli', function () {
        var jumlah = $(this).val();
        var harga = 0;
        if(jumlah==""){
          jumlah = 0;
        }
        var parent = $(this).parent();
        var select_produk = parent.prev().prev().find(".select-produk");
        var option = $(select_produk).find(":selected");
        if(option.attr("data")!=null){
          var data = $.parseJSON(option.attr("data"));
          var harga_beli = data.harga_beli;
          harga = data.harga_jual;
          if(data.harga_promo>0){
            harga = data.harga_promo;
          }
        }
        var trp_diskon = parent.next().find(".trp_diskon").val();
        var total = (jumlah * harga) - trp_diskon;
        var total_text = parent.next().next().find(".total_produk");
        total_text.val(rupiah(total));
        func_total_harga();
    });

    $(document).on('keyup mouseup','.trp_diskon', function () {
        var harga = 0;
        if(jumlah==""){
          jumlah = 0;
        }
        var parent = $(this).parent();
         var jumlah = parent.prev().find(".jumlah_beli").val();
        var select_produk = parent.prev().prev().prev().find(".select-produk");
        var option = $(select_produk).find(":selected");
        if(option.attr("data")!=null){
          var data = $.parseJSON(option.attr("data"));
          var harga_beli = data.harga_beli;
          harga = data.harga_jual;
          if(data.harga_promo>0){
            harga = data.harga_promo;
          }
        }
        var trp_diskon = $(this).val();
        var total = (jumlah * harga) - trp_diskon;
        var total_text = parent.next().find(".total_produk");
        total_text.val(rupiah(total));
        func_total_harga();
    });
    $(document).on('keyup mouseup','.order_diskon', function () {
        func_total_harga();
    });
    $(document).on('keyup mouseup','.order_ongkir', function () {
        func_total_harga();
    });
    var index_produk = 0;
    $(document).on("click",".btn_tambah_produk",function(){
        index_produk++;
        var html = `<div class='row row-${index_produk}'>
                          <div class="col-sm-3">
                              <div class="form-group">
                                  <div class="form-line">
                                     <select name="produk_id[]" class="select2 select-produk">
                                        <option value="" selected></option>
                                        <?php
                                        foreach ($produk_data as $kd):
                                          $harga = $kd['harga_jual'];
                                          if($kd['harga_promo']>0){
                                              $harga = $kd['harga_promo'];
                                          }
                                        ?>
                                          <option value="<?php echo $kd['produk_id']?>" data='<?php echo json_encode($kd)?>'>
                                              <?php echo $kd['produk_nama']." - ".number_format($harga)?>        
                                          </option>
                                        <?php
                                        endforeach;
                                        ?>
                                         
                                     </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-2">
                               <input type="text" name="trp_hargajual[]" class="form-control harga_satuan"  readonly="" value="0" >
                          </div>
                          <div class="col-sm-2">
                               <input type="number" name="trp_qty[]" class="form-control jumlah_beli" placeholder="QTY" min="1" >
                          </div>
                          <div class="col-sm-2">
                               <input type="number" name="trp_diskon[]" class="form-control trp_diskon" placeholder="Diskon" min="1" >
                          </div>
                          <div class="col-sm-2">
                               <input type="text" name="trp_total[]" class="form-control total_produk"  readonly="" value="0" >
                               <input type="hidden" name="trp_hargabeli[]" class="harga_beli">
                          </div>
                          <div class="col-sm-1">
                            <button class="btn btn-sm btn-danger" onclick="hapus_produk(${index_produk})">Hapus</button>
                          </div>
                        </div>`;

            $(".row_produk").append(html);
             $(".select2").select2({
                width:"100%",
                placeholder: "Pilih",
                allowClear: true
            });
    });

    function hapus_produk(index){
      $(".row-"+index).remove();
      func_total_harga();
    }

    function func_total_harga(){
      var subtotal = 0;
      $(".total_produk").each(function(){
        var total = $(this).val().replace(",","");
        subtotal+=parseInt(total);
      });
      $(".order_subtotal").val(rupiah(subtotal));
      var diskon = $(".order_diskon").val();
      var ongkir = $(".order_ongkir").val();
      var total_all = (parseInt(subtotal) - parseInt(diskon)) + parseInt(ongkir);
    //   $(".order_total").val(total_all);
    }

    $(document).on("click",".btn-save",function(){
        $(".form").trigger("submit");
    });

    $(document).on("submit",".form",function(e){
        e.preventDefault();
        var formData = new FormData(this);
        var uri = "<?php echo base_url()."transaksi/order/store"?>";
        if($("#order_id").val().length>0){
          uri = "<?php echo base_url()."transaksi/order/update"?>";
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
         $(".btn-save").show();
         $("#order_id").val("");

    });

    function show_edit(order_id){
         $.ajax({
              url: "<?php echo base_url()."transaksi/order/show?order_id="?>"+order_id,
              method:"GET",
              beforeSend:function(){
                  loading_alert();
              },
              success: function(data) { 
                 swal.close();
                 console.log(data);
                 $(".row_produk").html("");
                 var json = $.parseJSON(data);
                 console.log(json);
                 $("#order_id").val(json.data.order_id);
                 $("#order_nama").val(json.data.order_nama);
                 $("#order_wa").val(json.data.order_wa);
                 $("#order_provinsi").val(json.data.provinsi_id);
                 $("#order_provinsi").trigger("change");
                 $("#order_kota").val(json.data.kota_id);
                 $("#order_kota").trigger("change");
                 kecamatan_id_edit  = json.data.kecamatan_id;
                 kelurahan_id_edit = json.data.kelurahan_id;
                 $("#order_alamat").val(json.data.order_alamat);
                 $("#order_tanggal").val(json.data.order_tanggal);
                 $("#order_status").val(json.data.order_status);
                 $(".order_subtotal").val(rupiah(json.data.order_subtotal));
                 $(".order_diskon").val(rupiah(json.data.order_diskon));
                 $(".order_ongkir").val(rupiah(json.data.order_ongkir));
                 $(".order_total").val(rupiah(json.data.order_total));
                 $("#order_keterangan").val(json.data.order_keterangan);
                 var produk_data = json.data_produk;
                 $.each(produk_data,function(i,item){
                     index_produk++;
                     var selected = "";

                     var html = `<div class='row row-${index_produk}'>
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <div class="form-line">
                                     <select name="produk_id[]" class="select2 select-produk">
                                        <option value="" selected></option>
                                        <?php
                                        foreach ($produk_data as $kd):
                                          $harga = $kd['harga_jual'];
                                          if($kd['harga_promo']>0){
                                              $harga = $kd['harga_promo'];
                                          }
                                        ?>
                                          <option value="<?php echo $kd['produk_id']?>" data='<?php echo json_encode($kd)?>'>
                                              <?php echo $kd['produk_nama']." - ".number_format($harga)?>        
                                          </option>
                                        <?php
                                        endforeach;
                                        ?>
                                         
                                     </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-2">
                               <input type="text" name="trp_hargajual[]" class="form-control harga_satuan"  readonly="" value="${rupiah(item.trp_hargajual)}" >
                          </div>
                          <div class="col-sm-2">
                               <input type="number" name="trp_qty[]" class="form-control jumlah_beli" placeholder="QTY" min="1" value="${rupiah(item.trp_qty)}">
                          </div>
                          <div class="col-sm-2">
                               <input type="text" name="trp_total[]" class="form-control total_produk"  readonly="" value="${rupiah(item.trp_total)}" >
                               <input type="hidden" name="trp_hargabeli[]" class="harga_beli" value="${item.trp_hargabeli}">
                          </div>
                          <div class="col-sm-2">
                            <button class="btn btn-sm btn-danger" onclick="hapus_produk(${index_produk})">Hapus</button>
                          </div>
                        </div>`;

                     $(".row_produk").append(html);
                     $(".select2").select2({
                        width:"100%",
                        placeholder: "Pilih",
                        allowClear: true
                    });
                     $(`.row-${index_produk}`).find(".select-produk").val(item.produk_id).trigger("change");
                 });


                 $(".modal-title").html("Ubah Order");
                 $("#form_modal").modal("show");
              },
              error: function(xhr) { // if error occured
                  console.log(xhr);
                  warning_alert("Informasi","Kesalahan dari server");
               }
            });
    }

    function confirm(t){
      var status = $(t).data("status");
      var order_id = $(t).data("order");
      var formData = new FormData();
      formData.append("order_id",order_id);
      formData.append("order_status",status);
      
      var uri = "<?php echo base_url()."transaksi/order/confirm"?>";
     
      
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
                  success_alert("Informasi",json.message);
                  dt_table.ajax.reload(null, false);
             }
                 
            },
            error: function(xhr) { // if error occured
                console.log(xhr);
                warning_alert("Informasi","Kesalahan dari server");
             }
          });
      
      
    }

    function show_detail(order_id){
         $.ajax({
              url: "<?php echo base_url()."transaksi/order/show?order_id="?>"+order_id,
              method:"GET",
              beforeSend:function(){
                  loading_alert();
              },
              success: function(data) { 
                 swal.close();
                 console.log(data);
                 $(".row_produk").html("");
                 var json = $.parseJSON(data);
                 $("#order_id").val(json.data.order_id);
                 $("#order_kota").val(json.data.kota_id);
                $("#order_payment_method").val(json.data.order_payment_method);
                 $("#order_nama").val(json.data.order_nama);
                 $("#order_wa").val(json.data.order_wa);
                 $("#order_alamat").val(json.data.order_alamat);
                 $("#order_tanggal").val(json.data.order_tanggal);
                 $("#order_status").val(json.data.order_status);
                 $(".order_subtotal").val(rupiah(json.data.order_subtotal));
                 $(".order_diskon").val(rupiah(json.data.order_diskon));
                 $(".order_ongkir").val(rupiah(json.data.order_ongkir));
                 $(".order_total").val(rupiah(json.data.order_total));
                 $("#order_keterangan").val(json.data.order_keterangan);

                  $("#order_kecamatan").html("");
                  var option = [];
                  option.push({id:json.data.kecamatan_id,text:json.data.kecamatan_name});
                  $("#order_kecamatan").select2({data:option});

                  $("#order_kelurahan").html("");
                  var option = [];
                  option.push({id:json.data.kelurahan_id,text:json.data.kelurahan_name});
                  $("#order_kelurahan").select2({data:option});

                 var produk_data = json.data_produk;
                 $.each(produk_data,function(i,item){
                     index_produk++;
                     var selected = "";

                     var html = `<div class='row row-${index_produk}'>
                          <div class="col-sm-4">
                              <div class="form-group">
                                  <div class="form-line">
                                     <select name="produk_id[]" class="select2 select-produk">
                                        <option value="" selected></option>
                                        <?php
                                        foreach ($produk_data as $kd):
                                          $harga = $kd['harga_jual'];
                                          if($kd['harga_promo']>0){
                                              $harga = $kd['harga_promo'];
                                          }
                                        ?>
                                          <option value="<?php echo $kd['produk_id']?>" data='<?php echo json_encode($kd)?>'>
                                              <?php echo $kd['produk_nama']." - ".number_format($harga)?>        
                                          </option>
                                        <?php
                                        endforeach;
                                        ?>
                                         
                                     </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-2">
                               <input type="text" name="trp_hargajual[]" class="form-control harga_satuan"  readonly="" value="${rupiah(item.trp_hargajual)}" >
                          </div>
                          <div class="col-sm-2">
                               <input type="number" name="trp_qty[]" class="form-control jumlah_beli" placeholder="QTY" min="1" value="${rupiah(item.trp_qty)}">
                          </div>
                          <div class="col-sm-2">
                               <input type="text" name="trp_total[]" class="form-control total_produk"  readonly="" value="${rupiah(item.trp_total)}" >
                               <input type="hidden" name="trp_hargabeli[]" class="harga_beli" value="${item.trp_hargabeli}">
                          </div>
                          <div class="col-sm-2">
                            <button class="btn btn-sm btn-danger" onclick="hapus_produk(${index_produk})">Hapus</button>
                          </div>
                        </div>`;

                     $(".row_produk").append(html);
                     $(".select2").select2({
                        width:"100%",
                        placeholder: "Pilih",
                        allowClear: true
                    });
                     $(`.row-${index_produk}`).find(".select-produk").val(item.produk_id).trigger("change");
                 });


                 $(".modal-title").html("Detail Order");
                 $("#form_modal").modal("show");
                 $(".btn-save").hide();

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
