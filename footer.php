		</section>

		<footer class="footer-site"> <!-- Full width -->
			
			<section class="footer-site__wrapper">

				<p><?php echo footer_year(); ?> Studs.me | <a href="/feeds/rss">Subscribe</a> | Twitter: <a href="http://twitter.com/StudsHQ">@StudsHQ</a></p>

			</section>

		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="<?php echo theme_url('/js/magnific.min.js'); ?>"></script>
		<script src="<?php echo theme_url('/js/scripts.js'); ?>"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.article__content').magnificPopup({
					delegate: 'a:has(img)',
					type: 'image',
					gallery: { enabled: true }
				});
			});
		</script>

		<script>
			$('input[name=filter-sets]').keyup(function(e){
				if ($('.no-results').is(':visible')) {
					$('.no-results').hide();
				}
				
				var term = $(e.currentTarget).val().toLowerCase();

				var $sets = $('#browse-sets li');

				$sets.show().filter(function() {
					var text = $(this).find('a').text().replace(/\s+/g, ' ').toLowerCase();
					return !~text.indexOf(term);
				}).hide();

				if ( ! $('#browse-sets li').is(':visible')) {
					$('.no-results').text('No sets found with "' + term + '"').show();
				}
			});
		</script>

		<script>
		  !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(
		  arguments)};d=s.createElement(q);q=s.getElementsByTagName(q)[0];
		  d.src='//d1l6p2sc9645hc.cloudfront.net/tracker.js';q.parentNode.
		  insertBefore(d,q)}(window,document,'script','_gs');

		  _gs('GSN-973214-C');
		</script>

	</body>
	
</html>