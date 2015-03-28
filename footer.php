		</section>

		<footer class="footer-site"> <!-- Full width -->
			
			<section class="footer-site__wrapper">

				<p><?php echo footer_year(); ?> Studs.me | <a href="/feeds/rss">Subscribe</a> | Twitter: <a href="http://twitter.com/StudsHQ">@StudsHQ</a></p>

			</section>

		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="<?php echo theme_url('/js/magnific.min.js'); ?>"></script>

		<script src="instantclick.min.js" data-no-instant></script>
		<script data-no-instant>InstantClick.init();</script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.article__content').magnificPopup({
					delegate: 'a:has(img)',
					type: 'image',
					gallery: { enabled: true }
				});
			});
		</script>

	</body>
	
</html>