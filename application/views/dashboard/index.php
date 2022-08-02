<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">ORDER FINISH</div>
                            <div class="number" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo number_format($total_order)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">loyalty</i>
                        </div>
                        <div class="content">
                            <div class="text">PRODUK</div>
                            <div class="number" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"> <?php echo number_format($total_produk)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="content">
                            <div class="text">CUSTOMER</div>
                            <div class="number" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo number_format($total_customer)?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">monetization_on</i>
                        </div>
                        <div class="content">
                            <div class="text">JUMLAH PENDAPATAN</div>
                            <div class="number" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">Rp.<?php echo number_format($total_transaksi)?></div>
                        </div>
                    </div>
                </div>
             
              
            </div>
            <!-- #END# Widgets -->
           <div class="row">
               <div class="col-md-12">
                   <div id="donut_chart"></div>
               </div>
           </div>
            

           
        </div>
</section>

<!-- Custom Js -->
<script src="<?php echo base_url()."assets/"?>js/admin.js"></script>

<!-- Demo Js -->
<script src="<?php echo base_url()."assets/"?>js/demo.js"></script>
<script type="text/javascript" src="<?php echo base_url()."assets/"?>js/highcharts.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        chart_produk_terlaris();
    });

    function chart_produk_terlaris(){
        var data = '<?php echo $data_chart_produk?>';
        data = $.parseJSON(data);
        var dt = [];
        $.each(data,function(i,item){
            var p = {
                name:item.produk_nama,
                y:parseInt(item.total)
            }
            dt.push(p);
        });
        console.log(dt);
        Highcharts.chart('donut_chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '10 Produk Terlaris'
            },
            tooltip: {
                pointFormat: ` Pembelian: <b>{point.y}</b>
                               <br/>Persentase: <b>{point.percentage:.1f}%</b> 
                              `
            },
             legend: {
               layout: 'vertical',
               align: 'left',
               verticalAlign: 'middle',
               itemMarginTop: 10,
               itemMarginBottom: 10,
               itemMarginRight:10
             },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Produk',
                colorByPoint: true,
                data: dt
            }]
        });
    }
              

</script>