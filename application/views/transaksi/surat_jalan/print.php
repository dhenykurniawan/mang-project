<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
    @media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>

<div class="container-fluid mt-100 mb-100">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-header"> 
                    <strong>#<?php echo $data->sj_id?></strong>
                    <div class="pull-right" style="display: none;">
                        <div class="row">
                           <h4>SURAT JALAN</h4>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <div><strong>MANG</strong></div>
                            <div>Jl. Textile Kbn.Kelapa No.5 Rt.02 Rw.03</div>
                            <div>Setiamanah - Cimahi Tengah</div>
                            <div>Telp.  : 081210901919</div>
                        </div>
                        <div class="col-sm-4">
                           
                        </div>
                    </div>
                    <div class="row mb-4">
                       
                        <div class="col-sm-12">
                            <h4 class="mb-2">SURAT JALAN</h4>
                            <div class="row">
                                <div class="col-md-6 row">
                                    <div class="col-sm-5">Nomor</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4"><?php echo $data->sj_id?></div>
                                </div>
                                <div class="col-md-6 row">
                                    <div class="col-sm-5">Dikirim dengan</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4">K RD 2</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 row">
                                     <div class="col-sm-5">Tanggal Pengiriman</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4"><?php echo date("d/m/Y",strtotime($data->sj_tanggal." 00:00:00"))?></div>
                                </div>
                                <div class="col-md-6 row">
                                    <div class="col-sm-5">Nomor Polisi</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4"><?php echo $data->kurir_nopol?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 row">
                                     <div class="col-sm-5">Keterangan</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4"><?php echo $data->sj_keterangan?></div>
                                </div>
                                <div class="col-md-6 row">
                                    <div class="col-sm-5">Total</div>
                                    <div class="col-sm-1">:</div>
                                    <div class="col-sm-4"><?php echo number_format($data->sj_total)?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <?php
                    foreach ($data_order as $do):
                    ?>
                     <div class="mb-2">
                             <div class="row mb-2">
                                <div class="col-sm-12">
                                    <h6 class="mb-2">ORDER</h6>
                                     <div class="row">
                                        <div class="col-md-6 row">
                                            <div class="col-sm-5">Order No.</div>
                                            <div class="col-sm-1">:</div>
                                            <div class="col-sm-5"><?php echo $do['order_id']?></div>
                                        </div>
                                       <div class="col-md-6 row">
                                            <div class="col-sm-5">Telepon/Whatsapp</div>
                                            <div class="col-sm-1">:</div>
                                            <div class="col-sm-5"><?php echo $do['order_wa']?></div>
                                        </div>
                                    </div>
                                     <div class="row">
                                         <div class="col-md-6 row">
                                            <div class="col-sm-5">Nama</div>
                                            <div class="col-sm-1">:</div>
                                            <div class="col-sm-5"><?php echo $do['order_nama']?></div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <div class="col-sm-5">Alamat</div>
                                            <div class="col-sm-1">:</div>
                                            <div class="col-sm-6"><?php echo $do['order_alamat'].", ".$do['order_kelurahan'].", ".$do['order_kecamatan'].", ".$do['order_kota'].", ".$do['order_provinsi']?></div>
                                        </div>
                                    </div>

                            
                                </div>
                            </div>

                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="center">#</th>
                                            <th>Item</th>
                                            <th class="right">Harga</th>
                                            <th class="center">QTY</th>
                                            <th class="right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $data_produk = $do['data_produk'];
                                        foreach ($data_produk as $dp) {
                                        ?>  
                                            <tr>
                                                <td class="center"><?php echo $no?></td>
                                                <td ><?php echo $dp['produk_nama']?></td>
                                                <td class="right"><?php echo number_format($dp['trp_hargajual'])?></td>
                                                <td class="center"><?php echo $dp['trp_qty']?></td>
                                                <td class="right"><?php echo number_format($dp['trp_total'])?></td>
                                            </tr>
                                        <?php
                                        $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5"><?php echo $do['order_keterangan']?></div>
                                <div class="col-lg-4 col-sm-5 ml-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                            <tr>
                                                <td class="left"><strong>Subtotal</strong></td>
                                                <td class="right">Rp. <?php echo number_format($do['order_subtotal'])?></td>
                                            </tr>
                                            <?php
                                            if($do['order_diskon']>0):
                                            ?>
                                                <tr>
                                                    <td class="left"><strong>Diskon</strong></td>
                                                    <td class="right">Rp. <?php echo number_format($do['order_diskon'])?></td>
                                                </tr>
                                            <?php
                                            endif;
                                            ?>
                                            <tr>
                                                <td class="left"><strong>Ongkir</strong></td>
                                                <td class="right">Rp. <?php echo number_format($do['order_ongkir'])?></td>
                                            </tr>
                                            <tr>
                                                <td class="left"><strong>Total</strong></td>
                                                <td class="right"><strong>Rp. <?php echo number_format($do['order_total'])?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div>
                        <hr />
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.print();
</script>
