<?php
$ltmp_preset['en']=[
	'meta'=>[
		'title'=>'Knowledge Base',
		'description'=>'Essential information for social capital owners, developers, and investors. VIZ theory and practice: descriptions, instructions, explanations, examples, answers to questions.',
		'image'=>'meta-image-en.png',
	],
	'menu'=>[
		'development'=>'Development',
		'business'=>'Business',
		'investments'=>'Investments',
	],
	'index'=>[
		'title'=>'Index',
		'description'=>'The Q&A is intended mainly for newcomers and covers the main difficulties they may encounter in VIZ.',
		'contents_id'=>'faq-viz',
		'return_to_contents'=>'Return to content',
		'first_part_without_return'=>'General questions',
		'remove_contents_part'=>'Content:',
	],
	'dev'=>[
		'title'=>'Cookbook for Developers',
		'description'=>'The Cookbook provides Developers with a description of the APIs/objects/structures in the VIZ blockchain, code examples for popular use cases, and a guide for low-level transaction generation.',
		'contents'=>'<li class="current"><a href="#contents">Contents</a></li>
		<li><a href="#basic-concept">Basic concepts</a></li>
		<li><a href="#economy">Economy</a></li>
		<li><a href="#node-types">Node types</a></li>
		<li><a href="#operations">Operations and their types</a></li>
		<li><a href="#object-structures">Objects and structures</a></li>
		<li><a href="#state">State of the system</a></li>
		<li><a href="#plugins-api">Plugins and their API</a></li>
		<li><a href="#libraries">Libraries</a></li>
		<li><a href="#code-examples">Code examples</a></li>
		<li><a href="#transaction-formatting">Formation of transactions</a></li>',
		'return_caption'=>'Return to Contents',
	],
];

$ltmp_preset['en']=array_replace_recursive($ltmp_preset['ru'],$ltmp_preset['en']);