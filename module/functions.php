<?php
include('ltmp.php');

function short_viz($str,$symbol=true){
	return number_format(floatval($str),2,'.','&nbsp;').($symbol?' viz':'');
}

function ltmp($ltmp_str,$ltmp_args=array()){
	foreach($ltmp_args as $k=>$v){
		$ltmp_str=str_replace('%'.$k.'%',$v,$ltmp_str);
	}
	return $ltmp_str;
}
