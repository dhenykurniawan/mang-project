<?php

namespace App\Libs;

class FileManager{

	public static function get($folder,$filename){
		$url  = config("app.file_url");
		$url  = $url.$folder.$filename;
		return $url;
	}

}


?>