@extends('layout/layout')
@section('content')
    <div class="main-container container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                <div class="card card-light shadow-sm mb-4">
                    <div class="card-body">
                        <form class="form_alamat">
                            <input type="hidden" name="address_id" id="address_id" value="{{$address_id_edit}}">
                            <div class="form-floating mb-3">
                                <center>
                                    <h5>{{$title}}</h5>
                                </center>
                                <hr>
                            </div>

                            <div class="form-floating mb-3" style="display: none;">
                                <select class="form-select" name="select_provinsi">
                                    <option selected value="{{$provinsi_id}}">{{$provinsi_name}}</option>
                                </select>
                                <label for="select">Provinsi</label>
                            </div>

                            <div class="form-floating mb-3">
                               <div class="alert alert-warning" role="alert">
                                  <center>Saat ini MANG baru mengcover provinsi {{$provinsi_name}}</center>
                                </div>
                            </div>

                            <div class="mb-3">
                                 @php
                                    $checked = "";
                                    if($address_utama_edit==1){
                                        $checked = "checked";
                                    }
                                 @endphp
                                 <input type="checkbox" name="address_utama" value="1" {{$checked}}>
                                 <label for="select">Jadikan Alamat Utama</label>
                            </div>

                            <div class="mb-3">
                                <label for="select">Kota <span class="text-danger">*</span></label>
                                <select class="form-control select_kota" name="select_kota" data-selected="{{$kota_id_edit}}" >
                                    <option></option>
                                   @foreach($kota_data as $kd)
                                    <option value="{{$kd['kota_id']}}">{{$kd['kota_name']}}</option>
                                   @endforeach
                                </select>
                                
                            </div>

                            <div class="mb-3">
                                 <label for="select">Kecamatan <span class="text-danger">*</span></label>
                                <select class="form-select select_kecamatan" name="select_kecamatan">
                                     <option></option>

                                </select>
                               
                            </div>

                            <div class="mb-3">
                                  <label for="select">Kelurahan <span class="text-danger">*</span></label>
                                 <select class="form-select select_kelurahan" name="select_kelurahan">
                                     <option></option>

                                </select>
                                
                            </div>
                            <div class="mb-3">
                                 <label for="select">Alamat Detail <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="3" name="address_detail">{{$address_detail_edit}}</textarea>
                                
                            </div>
                             
                        </form>
                        <div class="d-grid">
                            <a href="javascript:;" class="btn btn-sm btn-default shadow-sm btn_submit">{{$title}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
             $(".select_kota").select2({
                placeholder: "Pilih Kota",
                allowClear: false,
             });

          
            $(".select_kecamatan").select2({
                placeholder: "Pilih Kecamatan",
                allowClear: false,
             });

             $(".select_kelurahan").select2({
                placeholder: "Pilih Kelurahan",
                allowClear: false,
             });

             $(".select_kota").change(function(){
                var val = $(this).val();
                if(val.length>0){
                    get_kecamatan(val);
                }
                else{
                    $(".select_kecamatan").html("");
                    var option = [];
                    option.push({id:"",text:""});
                    $(".select_kecamatan").select2({data:option});
                }
             });
             var kota_id_edit = "{{$kota_id_edit}}";
             if(kota_id_edit.length>0){
                $(".select_kota").val("{{$kota_id_edit}}").trigger('change');
             }
              

              $(".select_kecamatan").change(function(){
                var val = $(this).val();
                if(val.length>0){
                    get_kelurahan(val);
                }
             });

             $(".btn_submit").click(function(){
                var form = new FormData();
                var form_array = $(".form_alamat").serializeArray();
                var check_form = false;
                var html_default = $(this).html();
                var address_id = $("#address_id").val();
                 
                $.each(form_array,function(i,item){
                    if(item.name!="address_utama" && item.name!="address_id"){
                        if(item.value.length<1){
                            check_form = true;
                        }
                    }
                    form.append(item.name,item.value);
                });
                if(check_form){
                    alert("Form bertanda (*) wajib di isi");
                    return;
                }

                var url = '{{route('cart.store_address')}}';
                if(address_id.length>0){
                    url = '{{route('cart.update_address')}}';
                }
                $.ajax({
                    type:'POST',
                    data:form,
                    contentType:false,
                    processData: false,
                    url:url,
                    beforeSend:function(){
                       $(".btn_submit").html(loading_span());
                    },
                    success:function(data){
                        console.log(data);
                        $(".btn_submit").html(html_default);
                        window.location.href="{{route('cart.address')}}";
                       
                    },
                    error:function(data){
                        $(".btn_submit").html(html_default);
                        console.log(data);
                    }
                });
                
             });

        });

        function get_kecamatan(kota_id){
            var form = new FormData();
            form.append("kecamatan_kota_id",kota_id);
            var url = '{{route('state.get_kecamatan')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                   $(".select_kecamatan").html("");
                },
                success:function(data){
                   var option = [];
                   var kecamatan_id_edit = "{{$kecamatan_id_edit}}";
                   $.each(data,function(i,item){
                        var selected = false;
                        if(kecamatan_id_edit.length>0){
                            if(item.kecamatan_id==kecamatan_id_edit){
                                selected=true;
                            }
                        }
                        option.push({id:item.kecamatan_id,text:item.kecamatan_name,selected:selected});
                   });
                   $(".select_kecamatan").select2({data:option});
                   $(".select_kecamatan").trigger("change");
                   
                },
                error:function(data){
                    console.log(data);
                }
            });
        }

        function get_kelurahan(kecamatan_id){
            var form = new FormData();
            form.append("kelurahan_kec_id",kecamatan_id);
            var url = '{{route('state.get_kelurahan')}}';
            $.ajax({
                type:'POST',
                data:form,
                contentType:false,
                processData: false,
                url:url,
                beforeSend:function(){
                   $(".select_kelurahan").html("");
                },
                success:function(data){
                   var option = [];
                   var kelurahan_id_edit = "{{$kelurahan_id_edit}}";
                   $.each(data,function(i,item){
                        var selected  = false;
                        if(kelurahan_id_edit==item.kelurahan_id){
                            selected=true;
                        }
                        option.push({id:item.kelurahan_id,text:item.kelurahan_name,selected:selected});
                   });
                   $(".select_kelurahan").select2({data:option});
                   
                },
                error:function(data){
                    console.log(data);
                }
            });
        }


    </script>
@endsection
@endsection
