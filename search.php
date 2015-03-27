<?php theme_include('header'); ?>

<h1 class="wrap">Results for &ldquo;<?php echo search_term(); ?>&rdquo;</h1>

<?php if(has_search_results()): ?>
	<?php $i = 0; while(search_results()): $i++; ?>
	<article class="content__article">

     	<header class="article__info">

     		<h1 class="article__title"><a href="<?php echo article_url(); ?>"><?php echo page_title(); ?></a></h1>

     		<h2 class="article__meta">
     			<?php echo article_date_custom(); ?> 
     			| <code class="article__category"><a href="<?php echo article_category_url(); ?>"><?php echo article_category(); ?></a></code>
     		</h2>

     	</header>

     	<section class="article__content">

     		<?php echo article_markdown(); ?>

     	</section>

     	<?php if(article_custom_field('source')) : ?>
            <p class="article__source"><a href="<?php echo article_custom_field('source'); ?>">Original source</a></p>
        <?php endif; ?>

		<?php if(article_custom_field('sets')) : ?>
			<section class="article__sets">

				<h1 class="article__sets__title">Mentioned sets</h1>

				<ul class="article__sets__list">
					<?php echo article_custom_field('sets'); ?>
				</ul>

			</section>
		<?php endif; ?>

     	<hr>
	<?php endwhile; ?>

	<?php if(has_pagination()): ?>
	<nav class="pagination">
		<div class="wrap">
			<?php echo search_prev(); ?>
			<?php echo search_next(); ?>
		</div>
	</nav>
	<?php endif; ?>

<?php else: ?>
	<p class="wrap">Unfortunately, there's no results for &ldquo;<?php echo search_term(); ?>&rdquo;. Did you spell everything correctly?</p>
<?php endif; ?>

<?php theme_include('footer'); ?>