<?php theme_include('header'); ?>

		<article class="content__article">

			<header class="article__info">

				<h1 class="article__title"><?php echo article_title(); ?></h1>

				<h2 class="article__meta">
					<?php echo article_date_custom(); ?>  
					| <code class="article__category"><a href="<?php echo article_category_url(); ?>"><?php echo article_category(); ?></a></code>
					<?php if(article_custom_field('post_tags')) { echo '| ' . format_post_tags(article_custom_field('post_tags')); } ?>
				</h2>

			</header>

			<section class="article__content">

				<?php echo article_markdown(); ?>

			</section>

			<?php if(article_custom_field('flickr_album')) : ?>
                <p class="article__source"><a href="<?php echo article_custom_field('flickr_album'); ?>">View album on Flickr</a></p>
            <?php endif; ?>

			<?php if(article_custom_field('source')) : ?>
				<p class="article__source"><a href="<?php echo article_custom_field('source'); ?>">Original source</a></p>
			<?php endif; ?>

			<?php if(article_custom_field('post_sets')) : ?>
				<section class="article__sets">

					<h1 class="article__sets__title">Mentioned sets</h1>

					<ul class="article__sets__list">
						<?php foreach(parse_post_sets(article_custom_field('post_sets')) as $set) {
							echo '<li class="article__set"><a href="http://brickset.com/sets/'.extract_set_number($set).'">'.$set.'</a></li>';
						} ?>
					</ul>

				</section>
			<?php endif; ?>

		</article>

		<div class="pagination">
	        <p>
	            <div class="pagination__previous"><?php echo article_previous_link(); ?></div>
	            <div class="pagination__next"><?php echo article_next_link(); ?></a></div>
	        </p>
		</div>

		
<?php theme_include('footer'); ?>