<?php
$config['server_timezone']='Etc/GMT';
$site_root=$_SERVER['DOCUMENT_ROOT'];

$config['db_host']='localhost';
$config['db_login']='';
$config['db_password']='';
$config['db_base']='';

putenv('TZ='.$config['server_timezone']);
date_default_timezone_set($config['server_timezone']);