<?php theme_include('header'); ?>

		<article class="content__article">

			<header class="article__info">

				<h1 class="article__title"><?php echo page_title(); ?></h1>

			</header>

			<section class="article__content">

				<?php echo page_content(); ?>

				<h2>Categories</h2>

				<p>
					<?php foreach(sorted_categories() as $id => $category): ?>
				    	<code class="article__category article__category--large">
				    		<a href="<?php echo '/category/'.strtolower($category); ?>">
					    		<?php echo $category; ?>
				    		</a>
			    		</code>
					<?php endforeach; ?>
				</p>

				<h2>Tags</h2>

				<p>
					<?php foreach(get_post_tags() as $id => $tag): ?>
				    	<code class="article__tag article__tag--large">
				    		<a href="<?php echo '/?tag='.strtolower($tag); ?>">
				    			<?php echo strtoupper($tag); ?>
			    			</a>
			    		</code>
					<?php endforeach; ?>
				</p>

				<h2>Mentioned Sets</h2>

				<input name="filter-sets" type="text" size="30" placeholder="Search sets">

				<p class="no-results" style="display:none;"></p>

				<ul id="browse-sets">
					<?php foreach(get_post_sets() as $id => $tag): ?>
				    	<li>
				    		<a href="<?php echo '/?set='.strtolower(preg_replace("/[^0-9]/", '',$tag)); ?>">
				    			<?php echo $tag; ?>
			    			</a>
			    		</li>
					<?php endforeach; ?>
				</ul>

			</section>

		</article>

<?php theme_include('footer'); ?>