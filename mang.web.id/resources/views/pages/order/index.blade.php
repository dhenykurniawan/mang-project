@extends('layout/layout')
@section('content')
  <!-- main page content -->
        <div class="main-container container">
            <!-- Banner FAQs -->
            <div class="row mb-4 position-relative">

                <div class="col-12 col-md-6 col-lg-4 mx-auto align-self-center">
                    <!--<h4 class="text-center mb-2">{{$title}}</h4>!-->
                    <!--<p class="text-center text-opac">Cari Ordermu disini</p>!-->
                    <div class="form-floating">
                        <input type="text" class="form-control is-valid" id="order_id" placeholder="Search">
                        <label for="search">Cari No Order</label>
                        <button type="button" class="btn btn-link tooltip-btn d-block text-color-theme">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <h5 class="mb-0">{{$title}}</h5>
                </div>
            </div>
            <div class="accordion accordion-flush rounded shadow-sm mb-4 data-order" id="accordionFlushExample">
              
               
              
            </div>
              <div class="row mb-3">
                <div class="col align-self-center d-grid">
                    <a href="javascript:;" class="btn btn-danger btn-more btn-sm shadow-sm text-white btn-gradient">Lainnya</a>
                </div>
            </div>
        </div>
        <!-- main page content ends -->

        <div class="position-fixed top-0 start-50 translate-middle-x p-3  z-index-999">
          <div id="toast_copy" class="toast bg-success border-0 shadow hide mb-3" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-body">
                    <div class="row">
                        <div class="col text-white">
                            <p>Nomor rekening berhasil disalin</p>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@section('js')
    <script type="text/javascript">
        var page = 1;
        $(document).ready(function() {
            get_data(true);
            $(".btn-more").click(function(){
                page+=1;
                get_data(false);
            });
             $("#order_id").keyup(delay(function (e) {
                get_data(true);
            }, 500));
        });

        function get_data(new_page){
            var form = new FormData();
            if(new_page){
                page = 1;
            }
            form.append("pages",page);
            form.append("order_id",$("#order_id").val());
            form.append("status","{{$status}}");
            var url = '{{route('order.get_order_data')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    if(new_page) {
                        $(".data-order").html(loading_span());
                        $(".btn-more").fadeOut(100);
                    }
                    $(".btn-more").html("Loading...");
                },
                success:function(data){
                    console.log(data);
                    $(".btn-more").html("Lainya");
                    if(new_page){
                        $(".data-order").html(data);
                        if (data.length > 0) {
                            $(".btn-more").fadeIn(500);
                        }
                        else{
                            $(".data-order").html("Order tidak ditemukan");
                        }
                    }else{
                        $(".data-order").append(data);
                    }

                    var jum_data = $(".data-order").children().length;
                    if (jum_data < (8 * page)) {
                        $(".btn-more").hide();
                    }else{
                        $(".btn-more").show();
                    }
                },
                error:function(data){
                    console.log(data);
                    $(".btn-more").html("Lainya");
                }
            });
        }

         function copyToClipboard(text) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(text).select();
          document.execCommand("copy");
          $('#toast_copy').toast('show');
          $temp.remove();
        }

    </script>
@endsection

@endsection