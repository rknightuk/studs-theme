<?php theme_include('header'); ?>

		<article class="content__article">

			<header class="article__info">

				<h1 class="article__title"><?php echo page_title(); ?></h1>

			</header>

			<section class="article__content">

				<h2><?php echo total_articles(); ?> posts in <?php echo total_categories(); ?> categories.</h2>

				<ul>
					<?php foreach(Category::dropdown() as $id => $category): ?>
					    <li>
					    	<a href="<?php echo '/category/'.strtolower($category); ?>">
					    		<?php echo $category; ?>
				    		</a> (<?php echo category_count_for_id($id); ?>)
			    		</li>
					<?php endforeach; ?>
				</ul>

			</section>

		</article>

<?php theme_include('footer'); ?>