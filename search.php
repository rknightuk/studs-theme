<?php theme_include('header'); ?>

<h1>Results for &ldquo;<em><?php echo search_term(); ?></em>&rdquo;</h1>

<?php if(has_search_results()): ?>
	<?php $i = 0; while(search_results()): $i++; ?>
	<article class="content__search">

     	<header class="article__info--search">

     		<h1 class="search__title">
     			<a href="<?php echo article_url(); ?>"><?php echo page_title(); ?></a>
     			<span class="article__meta"><?php echo article_date_custom(); ?> 
     			| <code class="article__category"><a href="<?php echo article_category_url(); ?>"><?php echo article_category(); ?></a></code></span>
 			</h1>

     		<h2 class="article__meta">
     			
     		</h2>

     	</header>

    </article>

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
	<p>Unfortunately, there's no results for &ldquo;<em><?php echo search_term(); ?></em>&rdquo;.</p>
	<P>The <a href="/browse">browse page</a> might have what you're looking for.</p>
	<p>Alternatively, go <a href="/">back to the home page</a> to see all posts.</p>
<?php endif; ?>

<?php theme_include('footer'); ?>