<?php

/* === Constants and Variables === */
	define('SITEVersion', '1');
	define('URLBase', 'https://' . $_SERVER['HTTP_HOST']);
	define('URLHere', 'https://' . $_SERVER['HTTP_HOST'] .'/'. trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
	define('Topic', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	define('Lang', isset($_GET['hl']) && in_array($_GET['hl'], array('en')) ? $_GET['hl'] : 'bg');
	
	$desc='Лесни, бързи и вкусни рецепти за всички!';
	switch( Topic ){
		case '/': 
			$title = 'Cooking Master';
			$desc = 'Лесни, бързи и вкусни рецепти за всички!';
			break;
		case '/recipes': 
			$title = 'Рецепти';
			break;
		case '/contact': 
			$title = 'Контакти';	
			$desc = 'Лесни, бързи и вкусни рецепти за всички!';
			break;
		case '/addRecipe': 
			$title = 'Добавяне на рецепта';	
			$desc = 'Лесни, бързи и вкусни рецепти за всички!';
			break;
		case '/recipeSingle': 
			$title = 'Рецепта';	
			$desc = 'Лесни, бързи и вкусни рецепти за всички!';
			break;
		case '/results': 
			$title = 'Търсене по съставки';	
			$desc = 'Лесни, бързи и вкусни рецепти за всички!';
			break;
		default: 
			$title='404'; 
	}	
	
/* === Include other files with definded constants === */
	include('functions-database.php');
	
/* === Functions === */
	
	function debug($code = ''){
		return '<pre>'. var_export($code, true) .'</pre>';
	}
	
	function getImage($slug, $format = 'jpg'){
		return URLBase .'/'. $slug .'.'. $format;
	}
	
	// Enqueue CSS files
	function addHeadFiles(){
		$output = "\n\t\t";
		$files = array(
			array('shortcut icon', 'images/favicon.ico'),
			array('stylesheet', 'style.css'),
			array('stylesheet', 'plugins/swiper/swiper.min.css'),
			array('stylesheet', '/fonts/icons/font/flaticon.css')
		);
		
		$output .= '<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;700;800&display=swap" rel="stylesheet">' . "\n\t\t";
		foreach($files as $file) $output .= '<link rel="'. $file[0] .'" crossorigin="use-credentials" href="'. URLBase .'/'. $file[1] . '?v='. SITEVersion .'" />' . "\n\t\t";

		echo $output;
	}

	// Enqueue JavaScript files
	function addFooterFiles(){
		$output = '';
		$files = array(
			'scripts/jquery.min.js',
			'plugins/swiper/swiper.min.js',
			'scripts/main.js'
		);
				
		foreach($files as $file){
			$output .= '<script src="'. URLBase .'/' . $file . '?v='. SITEVersion .'"></script>' . "\n\t";
		}
		echo $output;
	}

	function navItems(){
		switch(Lang){
			case 'en': $labels = array(); break;
			default: $labels = array('Начало', 'Рецепти', 'Нова рецепта', 'Контакти'); break;
		}
		$langParam = in_array(Lang, array('en', 'de')) ? '?hl='. Lang : '';
		
		$output = '<li class="item first"><a href="'. URLBase .'">'. $labels[0] .'</a></li>'. "\n";
		$output .= '<li class="item second"><a href="'. URLBase .'/recipes'. $langParam .'">'. $labels[1] .'</a></li>'. "\n\r";
		$output .= '<li class="item third"><a href="'. URLBase .'/addRecipe'. $langParam .'">'. $labels[2] .'</a></li>'. "\n\r";
		$output .= '<li class="item fourth"><a href="'. URLBase .'/contact'. $langParam .'">'. $labels[3] .'</a></li>'. "\n\r";
		echo $output;
	}

	function langItems(){
		switch(Lang){
			case 'en': $labels = array('?hl=en', '', 'En', 'Bg'); break;
			default: $labels = array('', '?hl=en', 'Bg', 'En'); break;
		}
		
		$output = '<li class="item current"><a href="'. URLHere . $labels[0] .'">'. $labels[2] .'</a></li>';
		$output .= '<li class="item "><a href="'. URLHere . $labels[1] .'">'. $labels[3] .'</a></li>';
		echo $output;
	}
	
	
	function wa_json_error($msg = ''){
		echo json_encode(array('type' => 'error', 'data' => $msg));
		die();
	}
	
	function wa_json_success($msg = ''){
		echo json_encode(array('type' => 'success', 'data' => $msg));
		die();
	}
?>