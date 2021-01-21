<?php
ob_start();
$replace['title']='Белая бумага VIZPLUS - '.$replace['title'];
include('./class/Parsedown.php');
$Parsedown = new Parsedown();
$replace['description']='Взгляд на VIZ, лежащий в основе деятельности VIZ PLUS. Не является официальной Белой бумагой VIZ (т.к. её нет и не может быть) и лишь выражает частное мнение основателя VIZ.PLUS.';

$cache=false;
if(file_exists('./whitepaper.cache')){
	$cache=file_get_contents('./whitepaper.cache');
	print $cache;
}
else{
	print '
<div class="cards-view about">
	<div class="cards-container">';
	$file=file_get_contents('./git/whitepaper/ru/contents.md');
	print '<div class="card">';
	$html=$Parsedown->text($file);
	foreach($files_arr as $filename2){
		$html=str_replace($filename2.'.md#','#',$html);
		$html=str_replace($filename2.'.md','#'.$filename2,$html);
	}
	$html=str_replace('<h1>','<h1 class="left faq" id="'.$filename.'">',$html);
	$html=preg_replace('~<h2>(.*)</h2>~iUs','<h2 class="left faq" id="$1">$1</h2>',$html);
	$html=preg_replace('~<h3>(.*)</h3>~iUs','<h3 class="left faq" id="$1">$1</h3>',$html);
	print $html;
	print '</div>';

	print '
	</div>
</div>';
}
$content=ob_get_contents();
if(!$cache){
	file_put_contents('./whitepaper.cache',$content);
	chmod('./whitepaper.cache',0777);
}
ob_end_clean();