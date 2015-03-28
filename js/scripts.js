$(document).ready(function() {

	$('.article__content').magnificPopup({
		delegate: 'a:has(img)',
		type: 'image',
		gallery: { enabled: true }
	});

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
	
});