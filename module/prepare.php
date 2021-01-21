<?php
include('functions.php');
$replace['title']='База знаний';
$replace['description']='Необходимая информация для владельцев социального капитала, разработчиков и инвесторов. Теория и практика ВИЗа: описания, инструкции, объяснения, примеры, ответы на вопросы';

$replace['css_change_time']=$css_change_time;
$replace['script_change_time']=$script_change_time;
$replace['index_page_selected']='';
$replace['head_addon']='';

$replace['head_addon'].='
<link rel="image_src" href="/meta-image2.png"/>
<meta property="og:image" content="/meta-image2.png"/>
<meta name="twitter:image" content="/meta-image2.png"/>
<meta name="twitter:card" content="summary_large_image"/>
';
if(isset($path_array)){
	$replace['menu']='
		<a class="menu-el'.('dev'==$path_array[1]?' selected':'').'" href="/dev/">Разработка</a>
		<a class="menu-el'.('biz'==$path_array[1]?' selected':'').'" href="/biz/">Бизнес</a>
		<a class="menu-el'.('invest'==$path_array[1]?' selected':'').'" href="/invest/">Инвестиции</a>
	';
}