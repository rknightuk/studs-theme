<!DOCTYPE HTML>
<html>

	<head>
	
		<title><?php echo page_title('Page can’t be found'); ?> - <?php echo site_name(); ?></title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="<?php echo site_description(); ?>">
		
		
		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="<?php echo theme_url('img/favicon.ico'); ?>">
		<link rel="stylesheet" href="<?php echo theme_url('/css/style.css'); ?>">
		<link rel="stylesheet" href="<?php echo theme_url('/css/magnific.css'); ?>">
		
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo rss_url(); ?>">

		<script>
		  !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
		  arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
		  d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
		  insertBefore(d,q)}(window,document,'script','_gs');

		  _gs('GSN-973214-C');
		</script>
		
	</head>
	
	<body>

		<header class="header-info"> <!-- full width of site -->

			<div class="header-info__wrapper">

				<div class="header-info__centerer">
				
					<div class="header-info__logo">
						<img src="<?php echo theme_url('img/logo.png'); ?>" width="115" height="115">
					</div>

					<div class="header-info__title-wrapper">
						<h1 class="header-info__title"><?php echo site_name(); ?></h1>
						<h2 class="header-info__tagline"><?php echo site_description(); ?></h2>
					</div>

				</div>

			</div>

		</header>

		<nav class="site-nav">

			<ul class="site-nav__list">

				<?php while(menu_items()): ?>
				<li class="site-nav__item">
					<?php
						$url = menu_url();
						$title = menu_name();

						if (menu_name() == 'Posts') {
							$url = '/';
							$title = 'Home';
						}
					?>

					<a href="<?php echo $url; ?>" <?php echo (menu_active() ? 'class="active"' : ''); ?>>
						<?php echo $title; ?>
					</a>
				</li>
				<?php endwhile; ?>

				<li class="site-nav__item">
					<form class="search__form" action="<?php echo search_url(); ?>" method="post">
						<input type="text" autocomplete="off" class="search__box <?php if(search_term()) { echo 'active'; } ?>" name="term" placeholder="Search" value="<?php echo search_term(); ?>">
					</form>
				</li>
			</ul>

		</nav>

		<section class="content">

		<?php
			if (array_key_exists('tag', $_GET) && $tag = $_GET['tag']) echo '<p class="success-msg">Articles tagged with <em>"' . $tag . '"</em></p>';
			elseif (array_key_exists('set', $_GET) && $set = $_GET['set']) echo '<p class="success-msg">Articles metioning set number <em>"' . $set . '"</em></p>';
		?>