  <!-- Jquery Core Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/bootstrap/js/bootstrap.js"></script>

    
    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/node-waves/waves.js"></script>

     <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/sweetalert/sweetalert.min.js"></script>

     <!-- Select2 Plugin Js -->
    <script src="<?php echo base_url()."assets/"?>plugins/select2/select2.min.js"></script>


    <script type="text/javascript">

        $(document).ready(function(){
            $(".select2").select2({
                width:"100%",
                placeholder: "Pilih",
                allowClear: true
            });
        });
         function rupiah(nStr){
              nStr += '';
              x = nStr.split(',');
              x1 = x[0];
              x2 = x.length > 1 ? ',' + x[1] : '';
              var rgx = /(\d+)(\d{3})/;
              while (rgx.test(x1)) {
                  x1 = x1.replace(rgx, '$1' + ',' + '$2');
              }
              return x1 + x2;
        }
        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }
        function loading_alert(){
            swal({
                    title: "<img src='<?php echo base_url()."assets/images/loading.gif"?>' width=200 />",
                    text : "<h2>Loading ...</h2>",
                    showConfirmButton: false,
                    html: true
                });
        }
        function success_alert(title,message){
            swal(title, message, "success");
        }
        
        function warning_alert(title,message){
            swal(title, message, "warning");
        }

        function show_delete(idx){
             swal({
                title: "Konfirmasi",
                text: "Ingin menghapus data ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus",
                closeOnConfirm: false
            }, function () {
                delete_data(idx);
            });
        }
    </script>

   