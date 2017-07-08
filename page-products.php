<?php get_header();
/**
 * Template Name: Products Template
 *
 * @package Binekhi
 */
?>

<section class="details-section-1 container-fluid">

    <div class="row nopadding">
        <div class="col-xs-24">
            <h2><?php echo icl_t('binekhi','DISCOVER OUR PRODUCTS','DISCOVER OUR PRODUCTS'); ?></h2>
            <h3><?php echo icl_t('binekhi','RED, WHITE, ROSE, ORANGE, SHERRY, CHACHA','RED, WHITE, ROSE, ORANGE, SHERRY, CHACHA'); ?></h3>
        </div>
    </div>

    <div class="row nopadding">
        <div class="col-xs-offset-4 col-xs-16">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/grape.png" alt="Grape">
        </div>
    </div>

</section>

<div ng-controller="binekhiController" ng-hide="productID != null">

    <section class="secondary-nav container-fluid menu-container">

        <div class="container">

            <div class="row nopadding secondary-nav-products">

                <div class="col-xs-24">
                    <nav class="cats">
                        <ul class="list-inline">

                        <?php
                            $categories_list = get_categories(array(
                                'hide_empty'   => 1,
                                'hierarchical' => true,
                                'exclude'      => 1
                            ));

                        $i = 0;
                        $len = count($categories_list);

                        foreach ($categories_list as $ckey => $cat) {
                            if ($i == 0) {
                                ?><li class="filter" data-filter=".cat_<?php echo $cat->cat_ID; ?>"><?php echo mb_strtoupper( $cat->cat_name ); ?></li><?php
                            }                        
                            $i++;
                        }
                        ?>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>

    </section>

    
	<section class="inner_loader">
		<div class="products-list-wrapper container">
			<div class="row nopadding" id="productsWrapper">
			<?php
			$the_query = new WP_Query( array( 'post_status' => 'publish', 'post_type' => 'product', 'orderby'=> 'id', 'order' => 'asc' ) );
			if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$images = get_field('images');
				if( $images ) {
					$image = $images[0]['image'];
				} else {
					$image = get_stylesheet_directory_uri(). 'image/default.png';
				} 

				$category = get_the_category();
				?>
				<div class="mix cat_<?php echo $category[0]->cat_ID; ?> product-block col-xs-24 col-sm-12 col-md-8 col-lg-6">
				    <a href="<?php echo icl_get_home_url() ?>products/#/item/<?php echo get_the_ID(); ?>" >
				        <div class="small-img-wrapper">
				            <img src="<?php echo $image; ?>" alt="">
				        </div>
				        <div class="product-name">
				            <h2>BINEKHI</h2>
				            <h3><?php echo get_the_title(); ?></h3>
				        </div>
				    </a>
				</div>
				<?php
				}
			}
			wp_reset_postdata();
			?>
			</div>
		</div>
	</section>

</div>

<div class="single-product">

  <div ng-view></div>

</div>
<style>
#productsWrapper .mix {
    display: none;
}
</style>

<script type="text/javascript">
/*jQuery('nav.cats li a').live("click", function(event){
    event.preventDefault();

    jQuery(this).closest('nav.cats').find('li a.active').removeClass('active');
    jQuery(this).addClass('active');

    var cat_id = jQuery(this).parent('li').attr('data-cat_id');

    if( cat_id == '-1' ) {
      jQuery('div.product-block').show();
    } else {
      jQuery('div.product-block').hide();
      jQuery('div.product-block[data-cat_id="'+cat_id+'"]').each(function() {
        jQuery(this).show();
      });
    }
});*/

jQuery('button.othertype').live("click", function(event){
  if ( jQuery(this).hasClass('active') ) {
    jQuery('.cover img').attr("src", jQuery('a.maintype').attr('data-img_url') );
    jQuery(this).removeClass('active');
  } else {
    jQuery('.cover img').attr("src", jQuery(this).attr('data-img_url') );
    jQuery(this).addClass('active');
  }
});
</script>
<?php get_template_part( 'footer_inner' ); ?>
<?php get_footer(); ?>