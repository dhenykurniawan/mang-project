 @extends('layout/layout')
 @section('content')


     <div class="main-container container top-20">
         <!-- Blog/News Details banner -->
         <div class="row">
             <div class="col-12 px-0">
                 <div class="card mb-4 overflow-hidden shadow-sm card-theme text-white rounded-0">
                     <div class="overlay"></div>
                     <div class="coverimg h-100 w-100 position-absolute opacity-3">
                         <img src="{{ asset('assets/img/news1.jpg') }}" alt="">
                     </div>
                     <div class="card-body">
                         <div class="row mb-5">
                             <div class="col">
                                 <span class="tag">Info</span>
                             </div>
                             <!--  <div class="col-auto">
                                                                                                                                             <button class="btn btn-theme text-white avatar avatar-40 p-0 rounded-circle shadow-sm"><i
                                                                                                                                                     class="bi bi-share"></i></button>
                                                                                                                                             <button class="btn btn-success text-white avatar avatar-40 p-0 rounded-circle shadow-sm"><i
                                                                                                                                                     class="bi bi-bookmark"></i></button>
                                                                                                                                         </div>!-->
                         </div>
                         <br>
                         <a href="blog-details.html" class="h4 text-normal d-block text-white">Best Discovery ever
                             in UX</a>
                         <p class="text-opac">Terbit Pada : Sabtu 3 November, 2021</p>
                         <div class="d-flex">
                             <figure class="avatar avatar-40 rounded">
                                 <img src="{{ asset('assets/img/user2.jpg') }}" alt="">
                             </figure>
                             <p class="mx-2 lh-small align-self-center">Tim PINGKIFRESH<br><span
                                     class="text-opac small">Penulis</span></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Blogs/News Content  -->
         <div class="row">
             <div class="col-12 col-md-10 col-lg-8 mx-auto">
                 <h5>Best class template with details</h5>
                 <figure class="overflow-hidden rounded text-center">
                     <img src="{{ asset('assets/img/news3.jpg') }}" alt="" class="mw-100 mx-auto">
                 </figure>
                 <p class="text-opac">
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vestibulum lorem vitae mollis
                     tristique. Aliquam eget semper ipsum. Duis eu ante at lacus rutrum consectetur. Donec viverra, quam vel
                     iaculis bibendum, tortor orci fermentum felis, ac interdum urna orci ut velit. Nam quis pellentesque
                     ligula. Suspendisse leo felis, tincidunt ut sollicitudin vitae, faucibus ut ligula. Ut elementum, orci
                     sit amet consectetur tincidunt, ipsum felis lacinia nisi, ut porta libero purus nec sem.

                     Vivamus nibh felis, pellentesque at mauris vel, convallis rhoncus est. Donec ac turpis facilisis,
                     efficitur ex non, vehicula lorem. Aenean efficitur auctor tellus. Mauris enim justo, mollis at metus
                     nec, tempus ultrices mi. Donec convallis gravida metus, at lacinia nisi sodales quis. Sed euismod diam
                     libero. Morbi sit amet libero dui. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                     per inceptos himenaeos. Nam quis semper orci. In vehicula egestas urna. Praesent placerat ut est ut
                     efficitur. Quisque feugiat volutpat lorem, sit amet ultrices nunc consequat a. Praesent pharetra auctor
                     lectus a iaculis. Donec vel tellus volutpat, porttitor arcu et, ultrices arcu. Proin euismod est quis
                     ipsum venenatis luctus.

                     Quisque felis est, consequat imperdiet sem quis, eleifend gravida justo. Donec feugiat tempus nunc sit
                     amet consectetur. Etiam eu lobortis erat. Quisque tempor dignissim tempor. Etiam mauris felis,
                     dignissim ut odio nec, scelerisque efficitur augue. Donec consectetur mi vel justo luctus, sed pharetra
                     sapien facilisis. Curabitur porttitor tortor lectus, vel cursus augue posuere et. Pellentesque congue
                     vitae nunc vitae venenatis. Nam lorem leo, tincidunt a sem in, cursus dignissim quam.

                     Phasellus non velit quis nulla congue varius. In hac habitasse platea dictumst. Praesent lacinia quis
                     enim sed lacinia. Cras arcu lorem, scelerisque eu aliquet at, luctus eget neque. Nam maximus sem ut
                     lorem pellentesque, nec placerat augue consequat. Cras ultricies interdum tellus vitae hendrerit.
                     Praesent in arcu vel augue eleifend pharetra nec eu massa. Nullam luctus venenatis risus non
                     consectetur. Donec augue leo, elementum at mi at, euismod finibus quam. Suspendisse sem sem, pulvinar
                     finibus purus et, feugiat sodales arcu. Donec pretium rhoncus feugiat. Aliquam sollicitudin sagittis
                     est, a aliquam leo sollicitudin sit amet.

                     Phasellus non magna sagittis, suscipit elit ac, consequat dui. Proin tempus nunc lectus, quis venenatis
                     nunc maximus ullamcorper. Ut purus urna, ultrices a auctor sit amet, mattis et purus. Morbi ligula
                     erat, finibus ut ante quis, sollicitudin vestibulum justo. Sed velit lectus, ultricies eu magna id,
                     luctus vestibulum neque. Donec accumsan venenatis hendrerit. Sed orci est, pharetra sit amet suscipit
                     quis, finibus nec eros. Proin et dictum justo. Vivamus ac nunc sed lacus rhoncus egestas sed at nisl.
                     Donec viverra nibh non euismod imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia
                     nostra, per inceptos himenaeos. Ut non lacus nisi. Suspendisse accumsan commodo libero, ac euismod
                     sapien mollis in.

                     Suspendisse ac nulla eros. Praesent vestibulum risus sit amet tortor dignissim volutpat. Phasellus
                     rutrum, odio ac rutrum pharetra, diam lectus rhoncus dolor, iaculis volutpat diam massa sed nibh.
                     Nullam magna nulla, convallis sed euismod non, posuere vel tellus. Phasellus vel quam at elit venenatis
                     cursus. Curabitur pharetra nisi at massa sollicitudin malesuada. In fringilla mollis lacinia.
                     Suspendisse risus dui, consectetur ac venenatis eget, ullamcorper ut libero. Phasellus rutrum massa
                     rutrum metus feugiat, vitae aliquet lacus semper. Donec aliquet metus eget odio luctus pretium ut vitae
                     felis. Proin tempor enim felis, non commodo tellus consectetur sed. Nunc maximus quam non arcu iaculis
                     tempor. Mauris dignissim porttitor molestie. Cras pharetra purus nec lacus ornare posuere.

                     Nullam non cursus ex, quis feugiat purus. Donec dictum facilisis dolor a ultricies. Lorem ipsum dolor
                     sit amet, consectetur adipiscing elit. Phasellus fringilla cursus malesuada. Interdum et malesuada
                     fames ac ante ipsum primis in faucibus. Nullam eget porta magna. Nulla aliquam consequat hendrerit.
                     Proin et velit sit amet justo tincidunt sollicitudin. Vivamus sit amet libero et turpis efficitur
                     porttitor. Aliquam sed enim eu dui consectetur cursus non ac erat. Curabitur porta ex suscipit odio
                     semper fermentum. Quisque tellus magna, dignissim sit amet erat non, eleifend tincidunt dui. Etiam
                     vestibulum purus vitae urna accumsan, eu vulputate nunc vehicula. Cras placerat non neque a varius.
                     Vivamus venenatis ut nulla ac auctor.

                     Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus non tellus ex. Praesent
                     placerat ligula at auctor pellentesque. Nullam scelerisque sit amet augue a auctor. Class aptent taciti
                     sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec placerat, magna sit amet
                     blandit vestibulum, ligula neque tincidunt orci, eget vulputate nisl ligula eu quam. Cras a erat
                     turpis. Mauris interdum turpis eget dapibus lobortis. Proin hendrerit sem lectus, in egestas metus
                     semper nec. Donec id massa sollicitudin, sollicitudin augue id, luctus nulla. Cras semper rutrum
                     laoreet. Nulla dictum ante at elit aliquam, blandit viverra ex cursus.

                     Phasellus pellentesque pretium libero, sit amet bibendum arcu scelerisque rhoncus. Nunc porttitor,
                     lectus cursus fringilla egestas, lorem turpis malesuada neque, ut tristique massa libero sit amet enim.
                     Etiam dignissim, magna quis pretium ullamcorper, nisl sem lobortis velit, a faucibus ipsum augue eu
                     diam. Praesent congue, sem sed laoreet finibus, arcu tellus bibendum lacus, id maximus neque dolor id
                     dolor. Cras sed ante sollicitudin, dignissim orci nec, dictum erat. Vestibulum ante ipsum primis in
                     faucibus orci luctus et ultrices posuere cubilia curae; Aenean dapibus vulputate lectus, condimentum
                     vehicula dui gravida non. Sed id auctor nulla, et lacinia lectus. Donec vehicula dapibus tempus.
                     Phasellus ut ligula neque. Sed convallis pretium ipsum at molestie. Quisque ac turpis a ante fermentum
                     cursus at vitae nisi. Nam mattis ligula eleifend nulla luctus venenatis. Fusce bibendum mi congue,
                     molestie orci in, eleifend risus. Morbi tincidunt orci semper viverra molestie.
                 </p>
             </div>
         </div>
         <!-- Related Items -->
         <div class="row mb-3">
             <div class="col">
                 <h5 class="mb-0">Produk Berhubungan</h5>
             </div>
         </div>
         <!-- trending -->
         <div class="swiper-container trendingslides">
             <!-- Additional required wrapper -->
             <div class="swiper-wrapper">
                 <!-- Slides -->
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product1.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Red Apple</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$12.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product2.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Protein</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Best Banana</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 12 pcs</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product3.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Watermelon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$11.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product4.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Yellow Lemon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product4.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Yellow Lemon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product4.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Yellow Lemon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product4.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Yellow Lemon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product4.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Yellow Lemon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div class="card shadow-sm product mb-4">
                         <figure class="text-center mb-0 bg-light-warning">
                             <img src="{{ asset('assets/img/product4.png') }}" alt="">
                         </figure>
                         <div class="card-body">
                             <p class="mb-1">
                                 <small class="text-opac">Fresh</small>
                                 <small class="float-end"><span class="text-opac">4.5</span> <i
                                         class="bi bi-star-fill text-warning"></i></small>
                             </p>
                             <a href="product.html" class="text-normal">
                                 <h6 class="text-color-theme">Yellow Lemon</h6>
                             </a>
                             <div class="row">
                                 <div class="col">
                                     <p class="mb-0">$8.00<br><small class="text-opac">per 1 kg</small></p>
                                 </div>
                                 <div class="col-auto">
                                     <!-- button counter increamenter-->
                                     <div class="counter-number">
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-dash size-22"></i>
                                         </button>
                                         <span>1</span>
                                         <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                             <i class="bi bi-plus size-22"></i>
                                         </button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-12 mb-2">
             <button type="button" class="btn btn-lg btn-default shadow-sm" style="width: 100%;">
                 Pesan Sekarang
             </button>
         </div>
     </div>
 @section('js')
     <script type="text/javascript">
         $(document).ready(function() {

         });
     </script>
 @endsection

@endsection
