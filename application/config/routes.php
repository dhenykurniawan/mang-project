<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'AuthController/login';
$route['login_post'] = 'AuthController/login_post';
$route['logout'] = 'AuthController/logout';


$route['dashboard'] = 'DashboardController';

//produk
$route['produk/upload'] = 'Excel/UploadController';
$route['produk/upload_store'] = 'Excel/UploadController/store';
//kategori-produk
$route['produk/kategori'] = 'Produk/KategoriController/index';
$route['produk/kategori/get_data'] = 'Produk/KategoriController/get_data';
$route['produk/kategori/store'] = 'Produk/KategoriController/store';
$route['produk/kategori/show'] = 'Produk/KategoriController/show';
$route['produk/kategori/update'] = 'Produk/KategoriController/update';
$route['produk/kategori/delete'] = 'Produk/KategoriController/delete';

//produk
$route['produk'] = 'Produk/ProdukController/index';
$route['produk/get_data'] = 'Produk/ProdukController/get_data';
$route['produk/store'] = 'Produk/ProdukController/store';
$route['produk/store_variant'] = 'Produk/ProdukController/store_variant';
$route['produk/store_harga'] = 'Produk/ProdukController/store_harga';
$route['produk/show'] = 'Produk/ProdukController/show';
$route['produk/show_variant'] = 'Produk/ProdukController/show_variant';
$route['produk/show_harga'] = 'Produk/ProdukController/show_harga';
$route['produk/update'] = 'Produk/ProdukController/update';
$route['produk/update_variant'] = 'Produk/ProdukController/update_variant';
$route['produk/delete'] = 'Produk/ProdukController/delete';
$route['produk/delete_variant'] = 'Produk/ProdukController/delete_variant';

//kurir
$route['kurir'] = 'Kurir/KurirController/index';
$route['kurir/get_data'] = 'Kurir/KurirController/get_data';
$route['kurir/store'] = 'Kurir/KurirController/store';
$route['kurir/show'] = 'Kurir/KurirController/show';
$route['kurir/update'] = 'Kurir/KurirController/update';
$route['kurir/delete'] = 'Kurir/KurirController/delete';

//state
$route['state/get_kecamatan'] = 'State/StateController/get_kecamatan';
$route['state/get_kelurahan'] = 'State/StateController/get_kelurahan';

//customer
$route['customer'] = 'Customer/CustomerController/index';
$route['customer/get_data'] = 'Customer/CustomerController/get_data';

//transaksi

//order
$route['transaksi/order'] = 'Transaksi/OrderController/index';
$route['transaksi/order/get_data'] = 'Transaksi/OrderController/get_data';
$route['transaksi/order/store'] = 'Transaksi/OrderController/store';
$route['transaksi/order/show'] = 'Transaksi/OrderController/show';
$route['transaksi/order/update'] = 'Transaksi/OrderController/update';
$route['transaksi/order/get_order_invoice'] = 'Transaksi/OrderController/get_order_invoice';
$route['transaksi/order/get_order_surat_jalan'] = 'Transaksi/OrderController/get_order_surat_jalan';
$route['transaksi/order/print'] = 'Transaksi/OrderController/print';
$route['transaksi/order/confirm'] = 'Transaksi/OrderController/confirm';

//invoice
$route['transaksi/invoice'] = 'Transaksi/InvoiceController/index';
$route['transaksi/invoice/get_data'] = 'Transaksi/InvoiceController/get_data';
$route['transaksi/invoice/store'] = 'Transaksi/InvoiceController/store';
$route['transaksi/invoice/print'] = 'Transaksi/InvoiceController/print';

//surat jalan
$route['transaksi/surat_jalan'] = 'Transaksi/SuratJalanController/index';
$route['transaksi/surat_jalan/get_data'] = 'Transaksi/SuratJalanController/get_data';
$route['transaksi/surat_jalan/store'] = 'Transaksi/SuratJalanController/store';
$route['transaksi/surat_jalan/delete'] = 'Transaksi/SuratJalanController/delete';
$route['transaksi/surat_jalan/print'] = 'Transaksi/SuratJalanController/print';

//notification
$route['notification/get_count'] = 'Notification/NotificationController/get_count';
$route['notification/get_detail'] = 'Notification/NotificationController/get_detail';
$route['notification/read_notif'] = 'Notification/NotificationController/read_notif';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
