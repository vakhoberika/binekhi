<?php get_header();
/**
 * Template Name: Culture Template
 *
 * @package Binekhi
 */
?>


<section class="culture-header section container-fluid">

    <div class="row">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/culture-header-bg.jpg" alt="">
    </div>

    <div class="section-info-wrapper">
        <div class="container">
            <div class="middle">
                <h1><?php /* echo icl_t('binekhi','RICH CULTURE OF WINEMAKING','RICH CULTURE OF WINEMAKING');/* */ ?><?php echo get_field('title'); ?></h1>
                <h2><?php /* echo icl_t('binekhi','MAKING WINE MORE THAN 8000 YEARS','MAKING WINE MORE THAN 8000 YEARS'); /* */ ?><?php echo get_field('subtitle'); ?></h2>
            </div>
        </div>
    </div>

</section>


<section class="culture-content container">
	
	<div class="row nopadding">
		<div class="col-xs-offset-3 col-xs-18">
			<?php echo get_field('text_1'); ?>
		</div>
	</div>

</section>



<section class="region-header container">
	<div class="row nopadding">
		<div class="col-xs-24">
			<h2><?php /* *echo icl_t('binekhi','THE REGION THAT INSPIRES OUR WINE','THE REGION THAT INSPIRES OUR WINE'); /* */ ?><?php echo get_field('block_2_title'); ?></h1>
    		<h3><?php /* *echo icl_t('binekhi','BENEATH THE HIGH MOUNTAINS OF CAUCASUS','BENEATH THE HIGH MOUNTAINS OF CAUCASUS'); /* */ ?><?php echo get_field('block_2_subtitle'); ?></h2>
		</div>
	</div>
</section>


<section class="region-images container">

	<div class="row nopadding region-row">

		<?php
			$images = get_field('block_2_images');
			if( $images ):
				foreach ($images as $ikey => $ivalue):
					?>
						<div class="col-xs-24 col-sm-8">
							<img src="<?php echo $ivalue['image']; ?>" alt="<?php echo $ivalue['image_title']; ?>">
							<h3><?php echo $ivalue['image_title']; ?></h3>
						</div>			
					<?php
				endforeach;
			endif;
		?>
	</div>
	
</section>


<section class="region-content container">
	
	<div class="row nopadding">
		<div class="col-xs-offset-3 col-xs-18">
			<?php echo get_field('text_2'); ?>
		</div>
	</div>

</section>


<?php get_template_part( 'footer_inner' ); ?>
<?php get_footer(); ?>