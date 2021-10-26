<?php
include('ltmp_ru.php');
include('ltmp_en.php');
function ltmp($ltmp_str,$ltmp_args){
	preg_match_all('~%%([a-zA-Z_0-9]*)%%~iUs',$ltmp_str,$ltmp_includes);
	foreach($ltmp_includes as $k=>$v){
		$ltmp_str=str_replace($var_name,ltmp($ltmp_arr[$var_name]),$ltmp_str);
	}
	foreach($ltmp_args as $k=>$v){
		$ltmp_str=str_replace('{'+$k+'}',$v,$ltmp_str);
	}
	//remove empty args
	preg_match_all('~\{[a-z_\-]*\}~iUs',$ltmp_str,$ltmp_prop_arr);
	foreach($ltmp_prop_arr as $k=>$v){
		$ltmp_str=str_replace('{'+$k+'}','',$ltmp_str);
	}
	return $ltmp_str;
}


function set_l10n($id){
	global $ltmp_arr,$ltmp_default,$ltmp_current,$ltmp_presets,$ltmp_preset;
	$err=false;
	if(is_int($id)){
		$code2=$ltmp_base[$id]['code2'];
		if(isset($ltmp_preset[$code2])){
			if($ltmp_preset[$code2]['active']){
				$ltmp_arr=$ltmp_preset[$code2];
				$ltmp_current=$code2;
				return true;
			}
			else{
				$err=true;
			}
		}
		else{
			$err=true;
		}
	}
	else{
		if($ltmp_presets[$id]){
			$code2=$ltmp_presets[$id];
		}
		if(isset($ltmp_preset[$code2])){
			$ltmp_arr=$ltmp_preset[$code2];
			$ltmp_current=$code2;
			return true;
		}
		else{
			$err=true;
		}
	}
	if($err){
		$ltmp_arr=$ltmp_preset[$ltmp_default];
		$ltmp_current=$ltmp_default;
		return false;
	}
}

$ltmp_arr=[];
$ltmp_presets=['ru-RU'=>'ru','ru'=>'ru','en-US'=>'en','en-GB'=>'en','en'=>'en'];
$ltmp_current=false;
$ltmp_default='ru';
$ltmp_base=[
	1=>[
		'code2'=>'ru',
		'code3'=>'rus',
		'alias'=>false,
		'name'=>'Russian',
		'local-name'=>'Русский',
		'ru-name'=>'Русский язык',
		'active'=>true,
	],
	2=>[
		'code2'=>'en',
		'code3'=>'eng',
		'alias'=>false,
		'name'=>'English',
		'local-name'=>'English',
		'ru-name'=>'Английский язык',
		'active'=>true,
	],
];

if(isset($_GET['set_lang'])){
	$preferred_lang=$_GET['set_lang'];
	if(set_l10n($preferred_lang)){
		@setcookie('l10n',$preferred_lang,31536000+time(),'/');
	}
	header('location:'.$path);
	exit;
}
if(isset($_COOKIE['l10n'])){
	set_l10n($_COOKIE['l10n']);
}
else{
	$preferred_lang=$ltmp_default;
	if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])){
		$lang_max=0.0;
		$user_langs=explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
		foreach($user_langs as $user_lang){
			$user_lang=explode(';',$user_lang);
			$q=isset($user_lang[1])?(float)$user_lang[1]:1.0;
			if($q>$lang_max){
				$lang_max=$q;
				$preferred_lang=$user_lang[0];
			}
		}
		$preferred_lang=trim($preferred_lang);
			if($ltmp_presets[$preferred_lang]){
				$preferred_lang=$ltmp_presets[$preferred_lang];
			}
	}
	if($ltmp_preset[$preferred_lang]['active']){
		if(set_l10n($preferred_lang)){
			@setcookie('l10n',$preferred_lang,31536000+time(),'/');
		}
	}
}
if(isset($_GET['lang'])){
	$preferred_lang=$_GET['lang'];
	set_l10n($preferred_lang);
}
if(false===$ltmp_current){
	set_l10n($ltmp_default);
}
//$ltmp_arr['js']['LANGUAGE']=$_SERVER["HTTP_ACCEPT_LANGUAGE"];
