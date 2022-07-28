@extends('layout/layout')
@section('content')

    <div class="row h-100">

        <div class="col-12 mx-auto text-center">
            <div class="row h-100">
                <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto align-self-center">
                    <h2 class="text-center mb-4">Login / Daftar</h2>
                    <div class="card card-light shadow-sm mb-4">
                        <div class="card-body">
                            <form class=" was-validated">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control " id="customer_name"
                                        placeholder="Masukan Nama Anda" value="" >
                                    <label for="emailaddress">Masukan Nama Anda</label>
                                    <span style="display: none;" class="text-danger" id="name-validate">Nama tidak boleh kosong</span>
                                   
                                   
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control " id="customer_wa"
                                        placeholder="contoh : 081226377890" value="" >
                                    <label for="emailaddress">Masukan No Whatsapp</label>
                                    <span style="display: none;" class="text-danger" id="wa-validate">No Whatsapp tidak boleh kosong</span>
                                   <br />
                                    <div class="alert alert-warning" role="alert" >
                                     Pastikan no whatsapp anda aktif,agar memudahkan admin untuk melakukan konfirmasi
                                    </div>
                                   
                                </div>
                            </form>
                            <div class="d-grid"><a href="javascript:;"
                                    class="btn btn-lg btn-default shadow-sm" onclick="login(this)">Login / Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
       </div>

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

        });
        function login(t){
            var customer_wa = $("#customer_wa").val();
            var customer_name = $("#customer_name").val();
            $("#wa-validate").hide();
             $("#name-validate").hide();
            if(customer_name==""){
                $("#name-validate").show();
                return;
            }
            if(customer_wa==""){
                $("#wa-validate").html("No Whatsapp tidak boleh kosong");
                $("#wa-validate").show();
                return;
            }
            var form = new FormData();
            form.append("customer_wa",customer_wa);
            form.append("customer_name",customer_name);
            
            var html_default = $(t).html();
            var url = '{{route('auth.login')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                    $(t).html(loading_span());
                    
                },
                success:function(data){
                   $(t).html(html_default);
                   window.location.reload();
                   console.log(data);
                   
                },
                error:function(data){
                     $(t).html(html_default);
                    console.log(data);
                    if(data.status==401){
                         $("#wa-validate").html("Format No Whatsapp salah format yang benar (08122334xx)");
                         $("#wa-validate").show();
                    }
                }
            });
        }
    </script>
@endsection
@endsection
