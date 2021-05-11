<?php
ob_start();
$cache=true;

$replace['index_page_selected']=' selected';
$replace['title']=$ltmp_arr['index']['title'].' - '.$replace['title'];
$replace['description']=$ltmp_arr['index']['description'];
include('./class/Parsedown.php');
$Parsedown = new Parsedown();

$cache=false;

$file_prefix='';
if('ru'!=$ltmp_current){
	$file_prefix='-'.$ltmp_current;
}
if(!file_exists('./git/viz-faq/faq'.$file_prefix.'.md')){
	$file_prefix='';
}

if(file_exists('./faq'.$file_prefix.'.cache')){
	$cache=file_get_contents('./faq'.$file_prefix.'.cache');
	print $cache;
}
else{
	$contents_id=$ltmp_arr['index']['contents_id'];
	$return_to_contents='<div class="return-to-contents captions"><a href="#'.$contents_id.'">'.$ltmp_arr['index']['return_to_contents'].'</a></div>';
	$return_to_contents='';

	print '
	<div class="cards-view about">
		<div class="cards-container">';
	$files_arr=[
		'faq',
	];
	foreach($files_arr as $filename){
		$file=file_get_contents('./git/viz-faq/'.$filename.$file_prefix.'.md');
		print '<div class="card">';
		$html=$Parsedown->text($file);
		$html.='<!-- end -->';

		preg_match_all('~\<h1([.^>]*)\>(.*)\<\/h1\>~iUs',$html,$stack);
		foreach($stack[0] as $i=>$part){
			$context=$stack[2][$i];
			preg_replace('~[^a-zа-яё\-]~iUs','',$context);
			$context=mb_strtolower($context,'UTF-8');
			$context=str_replace(' ','-',$context);
			$new='<h1 class="left" id="'.$context.'">'.$stack[2][$i].'</h1>';
			$html=str_replace($part,$new,$html);
		}

		preg_match_all('~\<h2([.^>]*)\>(.*)\<\/h2\>~iUs',$html,$stack);
		foreach($stack[0] as $i=>$part){
			$context=$stack[2][$i];
			preg_replace('~[^a-zа-яё\-]~iUs','',$context);
			$context=mb_strtolower($context,'UTF-8');
			$context=str_replace('  ',' ',$context);
			$context=str_replace(' ','-',$context);
			$new='<!-- end -->'.($stack[2][$i]!=$ltmp_arr['index']['first_part_without_return']?$return_to_contents:'').'<!-- section --><h2 class="left faq" id="'.$context.'">'.$stack[2][$i].'</h2>';
			$html=str_replace($part,$new,$html);
		}
		$html=str_replace('<!-- section -->','</div><div class="card">',$html);

		preg_match_all('~\<h3([.^>]*)\>(.*)\<\/h3\>~iUs',$html,$stack);
		foreach($stack[0] as $i=>$part){
			$new='<!-- end --><h3 class="left faq">'.$stack[2][$i].'</h3>';
			$html=str_replace($part,$new,$html);
		}

		preg_match_all('~\<h3(.*)\>(.*)\<\/h3\>(.*)\<\!~iUs',$html,$stack);

		foreach($stack[0] as $i=>$part){
			if($ltmp_arr['index']['remove_contents_part']!=$stack[2][$i]){
				$new='
				<div class="toggle-box">
					<div class="section"><div class="arrow"></div><span>'.$stack[2][$i].'</span></div>
					<div class="info">'.$stack[3][$i].'</div>
				</div><!';
				$html=str_replace($part,$new,$html);
			}
			else{
				$html=str_replace($part,'<!',$html);
				$html=str_replace('<hr />','',$html);
			}
		}
		$html=str_replace('<!-- end -->','',$html);
		$html=str_replace(' - ',' — ',$html);

		print $html;
		print '</div>';
	}
	print '
		</div>
	</div>';
}
$content=ob_get_contents();
if(!$cache){
	file_put_contents('./faq'.$file_prefix.'.cache',$content);
	chmod('./faq'.$file_prefix.'.cache',0777);
}
ob_end_clean();