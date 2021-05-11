<?php
$ltmp_preset['en']=[
	'meta'=>[
		'title'=>'Knowledge Base',
		'description'=>'Essential information for social capital owners, developers, and investors. VIZ theory and practice: descriptions, instructions, explanations, examples, answers to questions.',
		'image'=>'meta-image-en.png',
	],
	'index'=>[
		'title'=>'Index',
		'description'=>'The Q&A is intended mainly for newcomers and covers the main difficulties they may encounter in VIZ.',
		'contents_id'=>'faq-viz',
		'return_to_contents'=>'Return to content',
		'first_part_without_return'=>'General questions',
		'remove_contents_part'=>'Content:',
	],
];

$ltmp_preset['en']=array_replace_recursive($ltmp_preset['ru'],$ltmp_preset['en']);