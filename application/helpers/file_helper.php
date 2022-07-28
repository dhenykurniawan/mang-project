<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_file'))
{
    function get_file($folder,$filename)
    {
    	$uri = base_url()."assets/uploads/";
    	$urix = $uri.$folder.$filename;
        return $urix;
    }   
}

if ( ! function_exists('wa_number'))
{
   function wa_number($nohp) {
     $nohp = str_replace(" ","",$nohp);
     $nohp = str_replace("(","",$nohp);
     $nohp = str_replace(")","",$nohp);
     $nohp = str_replace(".","",$nohp);
     if(!preg_match('/[^+0-9]/',trim($nohp))){
         if(substr(trim($nohp), 0, 3)=='+62'){
             $hp = trim($nohp);
         }
         elseif(substr(trim($nohp), 0, 1)=='0'){
             $hp = '+62'.substr(trim($nohp), 1);
         }
     }
     return $hp;
 }
}