@extends('layout/layout')
@section('content')
    
    <div class="main-container container top-20 mt-auto">
       <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{asset("assets/img/cart_empty.png")}}" alt="" class="img">
                    </div>
                    <div class="col-12 text-center">
                            <h2>Yuk Belanja di MANG aja !!</h2>
                            <span class="text-small">Mau cari kebutuhan mu? MANG bantu loh !!</span>
                    </div>
                     <div class="col-12 text-center mt-3">
                             <a href="{{ route('index') }}" class="btn btn-danger text-white btn-lg shadow-sm">   
                                Cari Produk
                            </a>
                    </div>
                </div>
    </div>
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection

@endsection
