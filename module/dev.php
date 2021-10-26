<?php
ob_start();
$replace['title']=$ltmp_arr['dev']['title'].' - '.$replace['title'];
include('./class/Parsedown.php');
$Parsedown = new Parsedown();
$replace['description']=$ltmp_arr['dev']['description'];

$replace['head_addon'].='
<link rel="image_src" href="/meta-developers-image.png"/>
<meta property="og:image" content="/meta-developers-image.png"/>
<meta name="twitter:image" content="/meta-developers-image.png"/>
<meta name="twitter:card" content="summary_large_image"/>
';

$cache=false;
$file_prefix='';
if('ru'!=$ltmp_current){
	$file_prefix='-'.$ltmp_current;
}
if(file_exists('./cookbook'.$file_prefix.'.cache')){
	$cache=file_get_contents('./cookbook'.$file_prefix.'.cache');
	print $cache;
}
else{
print '
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/highlight.min.js"></script>
<script>
document.addEventListener(\'DOMContentLoaded\',	(event) => {
	hljs.initHighlightingOnLoad();
	document.addEventListener(\'scroll\',function(e){
		let id="contents";
		$(".card").each(function(i,el){
			if((window.pageYOffset + window.innerHeight)>$(el).offset().top){
				id=$(el).find("h1").attr("id");
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
		'.$ltmp_arr['dev']['contents'].'
	</ul>
</div>

	<div class="cards-container">';

$files_arr=[
	'contents',
	'basic-concept',
	'economy',
	'node-types',
	'operations',
	'object-structures',
	'state',
	'plugins-api',
	'libraries',
	'code-examples',
	'transaction-formatting',
];
foreach($files_arr as $filename){
	$file=file_get_contents('./git/viz-cookbook/'.$ltmp_current.'/'.$filename.'.md');
	print '<div class="card">';
	//print './git/viz-cookbook/'.$ltmp_current.'/'.$filename.'.md';
	$html=$Parsedown->text($file);
	foreach($files_arr as $filename2){
		$html=str_replace($filename2.'.md#','#',$html);
		$html=str_replace($filename2.'.md','#'.$filename2,$html);
	}
	$html=str_replace('<h1>','<h1 class="left dev" id="'.$filename.'">',$html);
	$html=preg_replace('~<h2>(.*)</h2>~iUs','<h2 class="left dev" id="$1">$1</h2>',$html);
	$html=preg_replace('~<h3>(.*)</h3>~iUs','<h3 class="left dev" id="$1">$1</h3>',$html);
	print $html;
	print '<div class="return-to-contents captions"><a href="#contents">'.$ltmp_arr['dev']['return_caption'].'</a></div>';
	print '</div>';
}

print '
	</div>
</div>';
}
$content=ob_get_contents();
if(!$cache){
	file_put_contents('./cookbook'.$file_prefix.'.cache',$content);
	chmod('./cookbook'.$file_prefix.'.cache',0777);
}
ob_end_clean();