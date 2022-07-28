<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style type="text/css">
            * {
                    font-size: 11px;
                    font-family: 'Times New Roman';
             }

                thead {
                    border-top: 1px solid black;
                    border-collapse: collapse;
                }

                td.description,
                th.description {
                    width: 105px;
                    max-width: 105px;
                }

                td.quantity,
                th.quantity {
                    width: 40px;
                    max-width: 40px;
                    word-break: break-all;
                }

                td.price,
                th.price {
                    width: 40px;
                    max-width: 40px;
                    word-break: break-all;
                }

                .centered {
                    text-align: center;
                    align-content: center;
                }

                .ticket {
                    width: 160px;
                    max-width: 160px;

                }

                img {
                    max-width: inherit;
                    width: inherit;
                }

                @media print {
                    .hidden-print,
                    .hidden-print * {
                        display: none !important;
                    }
                }
        </style>
        <title>Receipt example</title>
    </head>
    <body>
        <div class="ticket">
           <center> 
                <img  src="<?php echo base_url()."assets/images/logo_print.png"?>" alt="Logo" style="width: 100px;">
                <h4 style="margin-top: 0px;">MANG</h4>
           </center>

           <?php echo $data_setting['setting_header_print']?>
            <p  style="margin-top: 0px;">
               #<?php echo $data['data']->order_id?>
            </p>
            <p  style="margin-top: -10px;">
               <?php echo $data['data']->order_nama?>
            </p>
            <p  style="margin-top: -10px;">
               <?php echo $data['data']->order_alamat?>
            </p>
            <p  style="margin-top: -10px;">
               <?php echo $data['data']->order_kelurahan?>, <?php echo $data['data']->order_kecamatan?>, <?php echo $data['data']->order_kota?> 
            </p>
             <p  style="margin-top: -10px;">
               <?php echo $data['data']->order_wa?>
            </p>
            <p>-------------------------------------------</p>
            
            <table style="width: 100%;margin-top: -5px;margin-bottom: -5px;" cellpadding="2" cellspacing="2">
                <tbody>
                    <?php
                    foreach($data['data_produk'] as $dp):
                    $produk_data = $this->db->where("produk_id",$dp['produk_id'])
                                  ->get("pr_produk")->result_array();
                    ?>
                    <tr>
                        <td class=""><?php echo $produk_data[0]['produk_nama']?></td>
                        <td class="" style="text-align: right;"><?php echo number_format($dp['trp_total'])?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $dp['trp_qty']?>x <?php echo number_format($dp['trp_hargajual'])?></td>
                    </tr>
                     <?php
                    endforeach;
                     ?>
                   
                </tbody>
                
            </table>
             <p>-------------------------------------------</p>
             <table style="width: 100%;margin-top: -5px;margin-bottom: -5px;" cellpadding="2" cellspacing="2">
                <tbody>
                    <tr>
                        <td class="">Subtotal</td>
                        <td class="" style="text-align: right;"><?php echo number_format($data['data']->order_subtotal)?></td>
                    </tr>
                    <tr>
                        <td class="">Ongkir 
                            <?php
                            if($data['data']->order_ongkir<1):
                                $kelurahan_id = $data['data']->kelurahan_id;
                                $st_kelurahan = $this->db->where("kelurahan_id",$kelurahan_id)->get("st_kelurahan")->result_array();
                            ?>
                                (<del><?php echo number_format($st_kelurahan[0]['kelurahan_ongkir'])?></del>)
                            <?php
                            endif;
                            ?>
                        </td>
                        <td class="" style="text-align: right;"><?php echo number_format($data['data']->order_ongkir)?></td>
                    </tr>

                    <tr>
                        <td class="">Total</td>
                        <td class="" style="text-align: right;"><?php echo number_format($data['data']->order_total)?></td>
                    </tr>
                   
                   
                </tbody>
                
            </table>
            <p class="centered"  style="margin-top:20px;">
               <?php echo date("d M Y H:i")?>
            </p>
            <p class="centered">
                Terima kasih <br>
				Belanja Di Mang Ajah !
            </p>
           <!-- <p style="text-align: right;margin-right: 10px;margin-bottom: 5px;">
                Admin : Finka Aulia 
            </p>!-->
           
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
         <script type="text/javascript">
            window.print();
             const $btnPrint = document.querySelector("#btnPrint");
                    $btnPrint.addEventListener("click", () => {
                        window.print();
                    });

         </script>
    </body>
   
</html>
