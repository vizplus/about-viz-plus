<?php
ob_start();
$replace['title']='Бизнес в ВИЗе - '.$replace['title'];
include('./class/Parsedown.php');
$Parsedown = new Parsedown();
$replace['description']='Уникальный и интересный бизнес в ВИЗе с использованием социального капитала строится вокруг создания приложений, предоставляющих контекст для наград.';

$cache=false;
if(file_exists('./biz.cache')){
	$cache=file_get_contents('./biz.cache');
	print $cache;
}
else{
print '
<div class="cards-view about">
	<div class="cards-container">';
	$file=file_get_contents('./git/viz-biz/biz.md');
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
	file_put_contents('./biz.cache',$content);
	chmod('./biz.cache',0777);
}
ob_end_clean();