
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>	
		<div id="slider" class="nivoSlider">		
			<img src="images/slider/3.jpg" alt="" />
			<img src="images/slider/2.jpg" alt="" />
			<img src="images/slider/1.jpg" alt="" />
			<img src="images/slider/4.jpg" alt="" />
			<img src="images/slider/5.jpg" alt="" />
		</div>		
</div>

	
	
	<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider({
				effect: 'fade',                 // Specify sets like: 'fold,fade,sliceDown'
				slices: 15,                     // For slice animations
				boxCols: 8,                     // For box animations
				boxRows: 4,                     // For box animations
				animSpeed: 500,                 // Slide transition speed
				pauseTime: 6000,                 // How long each slide will show
				startSlide: 0,                     // Set starting Slide (0 index)
				directionNav: true,             // Next & Prev navigation
				controlNav: true,                 // 1,2,3... navigation
				controlNavThumbs: true,         // Use thumbnails for Control Nav
				pauseOnHover: true,             // Stop animation while hovering
				manualAdvance: true,             // Force manual transitions
				prevText: 'Prev',                 // Prev directionNav text
				nextText: 'Next',                 // Next directionNav text
				randomStart: false,             // Start on a random slide
				beforeChange: function(){},     // Triggers before a slide transition
				afterChange: function(){},         // Triggers after a slide transition
				slideshowEnd: function(){},     // Triggers after all slides have been shown
				lastSlide: function(){},         // Triggers when last slide is shown
				afterLoad: function(){}         // Triggers when slider has loaded
			});
		});
	</script>	
	