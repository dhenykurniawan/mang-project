<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<div class="container-fluid mt-100 mb-100">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-header"> 
                    <strong>#<?php echo $data->invoice_id?></strong>
                    <div class="pull-right" style="display: none;">
                        <div class="row">
                           <h4>Aplikasi-MANG</h4>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h6 class="mb-3">Dari:</h6>
                            <div><strong>Aplikasi-MANG</strong></div>
                            <div>Jl. Textile Kbn.Kelapa No.5 Rt.02 Rw.03 Setiamanah - Cimahi Tengah</div>
                            <div>No Telepon: 082118039767</div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">Kepada:</h6>
                            <div><strong><?php echo $data->order_nama?></strong></div>
                            <div><?php echo $data->order_alamat?></div>
                            <div>No Telepon: <?php echo $data->order_wa?></div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">Detail Order:</h6>
                            <div>Order  <strong> <?php echo $data->order_id?></strong></div>
                            <div><?php echo date("F d , Y",strtotime($data->order_tanggal." 00:00:00"))?></div>
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
                        <div class="col-lg-4 col-sm-5"><?php echo $data->order_keterangan?></div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Subtotal</strong></td>
                                        <td class="right">Rp. <?php echo number_format($data->order_subtotal)?></td>
                                    </tr>
                                    <?php
                                    if($data->order_diskon>0):
                                    ?>
                                        <tr>
                                            <td class="left"><strong>Diskon</strong></td>
                                            <td class="right">Rp. <?php echo number_format($data->order_diskon)?></td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                    <tr>
                                        <td class="left"><strong>Ongkir</strong></td>
                                        <td class="right">Rp. <?php echo number_format($data->order_ongkir)?></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total</strong></td>
                                        <td class="right"><strong>Rp. <?php echo number_format($data->order_total)?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<hr>
<br />

<div class="container-fluid mt-100 mb-100">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-header"> 
                    <strong>#<?php echo $data->invoice_id?></strong>
                    <div class="pull-right" style="display: none;">
                        <div class="row">
                           <h4>Aplikasi-MANG</h4>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h6 class="mb-3">Dari:</h6>
                            <div><strong>Aplikasi-MANG</strong></div>
                            <div>Jl. Textile Kbn.Kelapa No.5 Rt.02 Rw.03 Setiamanah - Cimahi Tengah</div>
                            <div>No Telepon: 082118039767</div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">Kepada:</h6>
                            <div><strong><?php echo $data->order_nama?></strong></div>
                            <div><?php echo $data->order_alamat?></div>
                            <div>No Telepon: <?php echo $data->order_wa?></div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">Detail Order:</h6>
                            <div>Order  <strong> <?php echo $data->order_id?></strong></div>
                            <div><?php echo date("F d , Y",strtotime($data->order_tanggal." 00:00:00"))?></div>
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
                        <div class="col-lg-4 col-sm-5"><?php echo $data->order_keterangan?></div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Subtotal</strong></td>
                                        <td class="right">Rp. <?php echo number_format($data->order_subtotal)?></td>
                                    </tr>
                                    <?php
                                    if($data->order_diskon>0):
                                    ?>
                                        <tr>
                                            <td class="left"><strong>Diskon</strong></td>
                                            <td class="right">Rp. <?php echo number_format($data->order_diskon)?></td>
                                        </tr>
                                    <?php
                                    endif;
                                    ?>
                                    <tr>
                                        <td class="left"><strong>Ongkir</strong></td>
                                        <td class="right">Rp. <?php echo number_format($data->order_ongkir)?></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total</strong></td>
                                        <td class="right"><strong>Rp. <?php echo number_format($data->order_total)?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    window.print();
</script>
