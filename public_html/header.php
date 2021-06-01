<?php
	include('functions.php');
?><!DOCTYPE html>
<html hreflang="bg" lang="bg" itemscope itemtype="http://schema.org/Organization">
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		
		<!--  Essential SEO meta tags -->
		<meta name="description" content="<?php echo $desc; ?>" />
		<meta name="author" content="TU-Varna Students" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0" />
		
		<?php addHeadFiles(); ?>
		
		<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
	</head>
	<body>	
		<header id="header" style="<?php echo 'background-image: url('. getImage('images/header', 'jpg') .')' ?>;">
			<div id="navbar">
				<div class="logo">
					<a href="<?php echo URLBase; ?>"><img src="<?php echo getImage('images/logo', 'svg'); ?>" alt="Recipes Logo" /></a>
				</div>
				<div id="menuToggle">
					<label class="visuallyhidden" for="hamburger">Hamburger menu</label>
					<input id="hamburger" type="checkbox" />
					<span></span>
					<span></span>
					<span></span>
				</div>
				<nav  id="navigation" class="nav">
					<ul class="list">
						<?php navItems(); ?>
					</ul>
				</nav>
			</div>
			<div class="intro narrow dark">
				<?php
					echo '<h1 class="title underline">'. $title .'</h1>';
					echo '<h2 class="slogan">'. $desc .'</h2>';	
				?>
			</div>
		</header>