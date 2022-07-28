
<?php
$uri_index = $this->uri->segment(1);
$uri_sub = $this->uri->segment(2);
?>
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo ($uri_index == 'dashboard') ? "active" : ""; ?>">
            <a href="<?php echo base_url()?>">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
       
        
        <li class="<?php echo ($uri_index == 'produk') ? "active" : ""; ?>">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Produk</span>
            </a>
            <ul class="ml-menu">
                <li class="<?php echo ($uri_sub == 'kategori') ? "active" : ""; ?>">
                    <a href="<?php echo base_url()."produk/kategori"?>">Kategori Produk</a>
                </li>
                <li class="<?php echo ($uri_index=="produk" && $uri_sub == '') ? "active" : ""; ?>">
                    <a href="<?php echo base_url()."produk/"?>">Data Produk</a>
                </li>
              
            </ul>
        </li>

          <li class="<?php echo ($uri_index == 'customer') ? "active" : ""; ?>">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Customer</span>
            </a>
            <ul class="ml-menu">
                <li class="<?php echo ( $uri_index == 'customer' && $uri_sub == '' ) ? "active" : ""; ?>">
                    <a href="<?php echo base_url()."customer"?>">Data Customer</a>
                </li>
              
            </ul>
        </li>

         <li class="<?php echo ($uri_index == 'kurir') ? "active" : ""; ?>">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Kurir</span>
            </a>
            <ul class="ml-menu">
                <li  class="<?php echo ($uri_index=="kurir" && $uri_sub == '') ? "active" : ""; ?>">
                    <a href="<?php echo base_url()."kurir/"?>">Data Kurir</a>
                </li>
                <li>
                    <a href="#">Laporan</a>
                </li>
              
            </ul>
        </li>

         <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Mitra</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="#">Data Mitra</a>
                </li>
                <li>
                    <a href="#">Laporan</a>
                </li>
              
            </ul>
        </li>

          <li class="<?php echo ($uri_index=="transaksi") ? "active" : ""; ?>">
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">swap_calls</i>
                <span>Transaksi</span>
            </a>
            <ul class="ml-menu">
                <li class="<?php echo ($uri_index=="transaksi" && $uri_sub == 'order') ? "active" : ""; ?>">
                    <a href="<?php echo base_url("transaksi/order")?>">Order</a>
                </li>
                <li class="<?php echo ($uri_index=="transaksi" && $uri_sub == 'invoice') ? "active" : ""; ?>">
                    <a href="<?php echo base_url("transaksi/invoice")?>">Invoice</a>
                </li>
                 <li class="<?php echo ($uri_index=="transaksi" && $uri_sub == 'surat_jalan') ? "active" : ""; ?>">
                    <a href="<?php echo base_url("transaksi/surat_jalan")?>">Surat Jalan</a>
                </li>
              
            </ul>
        </li>

        <li>
            <a href="<?php echo base_url()."logout"?>">
                <i class="material-icons">logout</i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</div>