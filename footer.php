</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/angular/angular.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/angular/angular-route.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/app.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/jquery/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/jquery/jquery.mixitup.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/lib/js/nanobar.min.js"></script>
<script>
$(function(){
	var simplebar = new Nanobar();
	simplebar.go(25);
	$(document).ready(function(){
		simplebar.go(100);
		$('.main-wrapper').fadeTo("slow" , 1);
	});
});
</script>
<?php wp_footer(); ?>
</body>
</html>