<?php
include($site_root.'/class/db.php');
include($site_root.'/class/sdb.php');
include($site_root.'/class/template.php');

$db=new DataManagerDatabase($config['db_host'],$config['db_login'],$config['db_password']);
$db->db($config['db_base'],'utf8mb4');
if(!$db->link){
	print '<html><head></head><body>Server restarting... <!-- '.$config['db_host'].'  --></body></html>';
	exit;
}
$sdb=new DataManagerSuperDatabase;
$t=new DataManagerTemplate($site_root.'/templates/');

$script_change_time=filemtime($site_root.'/app.js');
$css_change_time=filemtime($site_root.'/app.css');

$time=time();

$ip='';
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else{
	if(isset($_SERVER['REMOTE_ADDR'])){
		$ip=$_SERVER['REMOTE_ADDR'];
	}
}