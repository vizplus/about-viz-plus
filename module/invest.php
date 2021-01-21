<?php
ob_start();
$replace['title']='Инвестиции в ВИЗ - '.$replace['title'];
include('./class/Parsedown.php');
$Parsedown = new Parsedown();

$replace['description']='Почему надо инвестировать в ВИЗ: Третья деятельность - социальная активность, Визономика - экономика социальной активности, Социальный капитал - нефинансовый инструмент влияния, Децентрализованное управление.';

$cache=false;
if(file_exists('./invest4.cache')){
	$cache=file_get_contents('./invest.cache');
	print $cache;
}
else{
print '
<script>
document.addEventListener(\'DOMContentLoaded\',	(event) => {
	document.addEventListener(\'scroll\',function(e){
		let id="contents";
		$(".card").each(function(i,el){
			if((window.pageYOffset + window.innerHeight)>$(el).offset().top){
				id=$(el).find("h2").attr("id");
			}
		});
		$(".cards-nav li").removeClass("current");
		$(".cards-nav a[href=\"#"+id+"\"]").parent().addClass("current");
		if("contents"==id){
			$(".cards-menu").css("display","none");
		}
		else{
			$(".cards-menu").css("display","block");
		}
	});
});
</script>
';
print '
<div class="cards-view about">

<div class="cards-menu" style="display:none;">
	<ul class="cards-nav">
		<li class="current"><a href="#содержание">Содержание</a></li>
		<li><a href="#почему-надо-инвестировать-в-виз">Почему надо инвестировать в ВИЗ</a></li>
		<li><a href="#токен-viz">Токен viz</a></li>
		<li><a href="#эмиссия-в-визе">Эмиссия в ВИЗе</a></li>
		<li><a href="#распределение-социального-капитала-в-визе">Распределение капитала в ВИЗе</a></li>
		<li><a href="#модель-определения-ориентировочной-ценности-viz">Модель определения ценности</a></li>
		<li><a href="#как-инвестировать-в-виз">Как инвестировать в ВИЗ</a></li>
	</ul>
</div>

	<div class="cards-container">';


$file=file_get_contents('./git/viz-invest/invest.md');
$return_to_contents='<div class="return-to-contents captions"><a href="#содержание">Вернуться к содержанию</a></div>';
print '<div class="card" id="contents">';
$html=$Parsedown->text($file);
foreach($files_arr as $filename2){
	$html=str_replace($filename2.'.md#','#',$html);
	$html=str_replace($filename2.'.md','#'.$filename2,$html);
}

$html=str_replace('<h1>','<h1 class="left dev">',$html);
$html=preg_replace('~<h2>(.*)</h2>~iUs',$return_to_contents.'</div><div class="card"><h2 class="left faq" id="$1">$1</h2>',$html);
$html=preg_replace('~<h3>(.*)</h3>~iUs','<h3 class="left faq" id="$1">$1</h3>',$html);

$html=preg_replace('~<img src="(.*)/blob/(.*)"~iUs','<img src="$1/raw/$2"',$html);
$html=preg_replace('~<img src="(.*)"(.*)>~iUs','<a href="$1" target="_blank" class="no-shadow"><img src="$1"$2></a>',$html);
$html=preg_replace('~<img(.*)>~iUs','<center><img$1 class="image-corner"></center>',$html);

$html=str_replace('<p><center>','<center>',$html);
$html=str_replace('</center></p>','</center>',$html);

$html=str_replace('/firstviz.png"','/firstviz.png" style="max-height:360px"',$html);


preg_match_all('~ id="(.*)">~',$html,$stock);
foreach($stock[1] as $k=>$v){
	$new=' id="'.mb_strtolower(str_replace(' ','-',$v)).'">';
	$html=str_replace($stock[0][$k],$new,$html);
}
print $html;
print $return_to_contents;
print '</div>';

print '
	</div>
</div>';
}
$content=ob_get_contents();
if(!$cache){
	file_put_contents('./invest.cache',$content);
	chmod('./invest.cache',0777);
}
ob_end_clean();