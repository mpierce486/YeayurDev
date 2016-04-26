$(document).ready(function(){
	$('.main-user-post').hover(function(){
		$(this).find('.main-btn-group').show();
	}, function(){
		$(this).find('.main-btn-group').hide();
	});

	var $grid = $('.post-grid').imagesLoaded( function() {
		$grid.masonry({
			  // options
			  itemSelector: '.main-user-post',
			  columnWidth: '.main-user-post'
		});
	});

	// Infinite Scroll 

	$('.post-grid').infinitescroll({

		loading: {
			finishedMsg: ''
		},

		navSelector: '.pagination',
		nextSelector: '.pagination a:last',
		itemSelector: '.main-user-post',
		bufferPx: 400
	},

	// Use Masonry appended method to add new elements to page

		function (newElements) {
			var $newElems = $( newElements);

			$('.post-grid').masonry('appended', $newElems);
		}
	);
});