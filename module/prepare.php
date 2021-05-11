<?php
include('functions.php');
include('ltmp_arr.php');
$replace['title']=$ltmp_arr['meta']['title'];
$replace['description']=$ltmp_arr['meta']['description'];

$replace['css_change_time']=$css_change_time;
$replace['script_change_time']=$script_change_time;
$replace['index_page_selected']='';
$replace['head_addon']='';

$replace['head_addon'].='
<link rel="image_src" href="/'.$ltmp_arr['meta']['image'].'"/>
<meta property="og:image" content="/'.$ltmp_arr['meta']['image'].'"/>
<meta name="twitter:image" content="/'.$ltmp_arr['meta']['image'].'"/>
<meta name="twitter:card" content="summary_large_image"/>
';
if(isset($path_array)){
	$replace['menu']='
		<a class="menu-el'.('dev'==$path_array[1]?' selected':'').'" href="/dev/">Разработка</a>
		<a class="menu-el'.('biz'==$path_array[1]?' selected':'').'" href="/biz/">Бизнес</a>
		<a class="menu-el'.('invest'==$path_array[1]?' selected':'').'" href="/invest/">Инвестиции</a>
	';
}

$replace['select-lang']='';
$select_lang_arr=[];
foreach($ltmp_base as $lang_el){
	if($lang_el['active']){
		$select_lang_arr[]='<a href="?set_lang='.$lang_el['code2'].'"'.(($lang_el['code2']==$ltmp_current)?' class="current"':'').'>'.$lang_el['local-name'].'</a>';
	}
}
$replace['select-lang']=implode(' / ',$select_lang_arr);