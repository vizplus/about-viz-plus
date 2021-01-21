<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{title}</title>
	<meta name="description" content="{description}">
	<meta property="og:description" content="{description}">
	<meta name="twitter:description" content="{description}">
	<meta name="viewport" content="width=device-width">
	{head_addon}

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="/app.css?{css_change_time}">
	<script type="text/javascript" src="/cash.min.js"></script>
	<script type="text/javascript" src="/app.js?{script_change_time}"></script>
</head>
<body>

<div class="header shadow unselectable">
	<div class="horizontal-view">
		<div class="toggle-menu"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="23" height="23" stroke="none" fill="currentColor"><path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"></path></svg></div>
		<div class="logo"><a href="/" class="prefix{index_page_selected}">about.</a><a href="https://viz.plus/"><img src="/logo.svg" alt="VIZ+"></a></div>
		<div class="menu-list captions">
			<div class="menu-bg">
				{menu}
			</div>
		</div>
	</div>
</div>

<div class="horizontal-view vertical-view">
	{content}
</div>
</body>
</html>