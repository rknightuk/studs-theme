<?php theme_include('header'); ?>

		<article class="content__article">

			<header class="article__info">

				<h1 class="article__title"><?php echo page_title(); ?></h1>

			</header>

			<section class="article__content">

				<?php echo page_content(); ?>

			</section>

		</article>
<?php theme_include('footer'); ?>