<?php theme_include('header'); ?>

		<article class="content__article">

			<header class="article__info">

				<h1 class="article__title"><?php echo page_title(); ?></h1>

			</header>

			<section class="article__content">

				<?php echo page_content(); ?>

				<h2>Contact</h2>

				<?php if (isset($_GET["sent"])) : ?>
					<p class="success-msg">Your email has been sent. Thanks.</p>
				<?php else: ?>

					<form class="contact" action="//formspree.io/&#109;&#101;+&#115;&#116;&#117;&#100;&#115;&#064;&#116;&#104;&#101;&#114;&#111;&#098;&#098;&#046;&#099;&#111;&#109;" method="POST">
						<input type="text" name="_gotcha" style="display:none" />
					    <p><label>Email:</label> <input type="email" name="_replyto" required></p>
					    <p><label>Message:</label> <input type="text" name="message" size="40" required></p>
					    <input type="hidden" name="_next" value="//studs.dev/about?sent">
					    <input type="submit" value="Send" class="btn">
					</form>

				<?php endif; ?>

			</section>

		</article>
<?php theme_include('footer'); ?>