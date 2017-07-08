<?php
get_header(); ?>



<section class="details-section-1 container-fluid">

    <div class="row nopadding">
        <div class="col-xs-24">
            <h2>DISCOVER OUR PRODUCTS</h2>
            <h3>RED, WHITE, ROSE, ORANGE, SHERRY, CHACHA</h3>
        </div>
    </div>

    <div class="row nopadding">
        <div class="col-xs-offset-4 col-xs-16">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/grape.png" alt="Grape">
        </div>
    </div>

</section>


<?php
while ( have_posts() ) : the_post();  ?>

<section class="secondary-nav container-fluid single-header">

    <div class="container">

        <div class="row secondary-nav-details">

            <div class="col-xs-5">
                <button type="button" class="goback">
                <a href="<?php echo site_url('products'); ?>">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/arrow_back.svg" alt="">
                </a>
                </button>
            </div>
            <div class="col-xs-14">
                <h1><?php echo get_the_title(); ?></h1>
            </div>
            <div class="col-xs-5">
                <?php
                  $categories = get_the_category();
                  $left_id = binekhi_post_id_get( $categories[0]->cat_ID, 'category', 'product', true, false );
                  $right_id = binekhi_post_id_get( $categories[0]->cat_ID, 'category', 'product', false, true );

                ?>
                <button type="button" class="prev nextpost" <?php echo $left_id ? 'data-product_id="'.$left_id.'"' : 'disabled="disabled" style="cursor: no-drop;"'; ?>>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/arrow_left.svg" alt=""></button>
                
                <button type="button" class="next nextpost" <?php echo $right_id ? 'data-product_id="'.$right_id.'"' : 'disabled="disabled" style="cursor: no-drop;"'; ?>>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/arrow_right.svg" alt=""></button>
                
            </div>

        </div>

    </div>

</section>


<section class="product-details container">

    <div class="row">
        <div class="details-cover col-xs-8 cover">
          <?php
          $images = get_field('images');
          if( $images ) {
            $image = $images[0]['image'];
          } else {
            $image = get_stylesheet_directory_uri(). 'image/default.png';
          }
          ?> 
            <a class="maintype" data-img_url="<?php echo $image; ?>" style="display: none">Default Cover</a><br />
            <img src="<?php echo $image; ?>" />
        </div>
        <div class="details-info col-xs-16">
            <ul class="list-unstyled">
                <li><h3>BINEKHI</h3></li>
                <li><p><?php echo get_the_title(); ?></p></li>
            </ul>

            <?php if( get_field('specifications') ): ?>
            <div class="specifications">
              <h3><?php echo icl_t('binekhi','SPECIFICATIONS','SPECIFICATIONS'); ?></h3>
              <?php echo get_field('specifications'); ?>
            </div>
            <?php endif; ?>

            <?php if( get_field('awards') ): ?>
            <div class="specifications">
              <h3><?php echo icl_t('binekhi','AWARDS','AWARDS'); ?></h3>
              <?php echo get_field('awards'); ?>
            </div>
            <?php endif; ?>
            <?php if( sizeof( $images ) > 1 ):
              array_shift( $images );
              foreach ($images as $key => $img) {
                ?>
                  <button class="gs-btn-black othertype" data-img_url="<?php echo $img['image']; ?>"><?php echo $img['type']; ?></button>
                <?php
              }
              ?>
            <?php endif; ?>
        </div>
    </div>

</section>

<?php if( get_field('great_with') ): ?>
<section class="great-with container">

    <div class="row great-with-title">

        <h2><?php echo icl_t('binekhi','GREAT WITH','GREAT WITH'); ?></h2>
        <h3><?php echo icl_t('binekhi','FOOD RECOMENDATIONS','FOOD RECOMENDATIONS'); ?></h3>

    </div>

    <div class="row great-with-content">

      <?php 
        $greatwith = get_field('great_with');
        foreach( $greatwith as $key => $pid ):
      ?>
        <div class="col-xs-8">
            <img src="<?php echo get_field('image',$pid); ?>" alt="Great with">
            <h3><?php echo get_the_title($pid); ?></h3>
        </div>
      <?php endforeach; ?>

    </div>

</section>
<?php endif; ?>

<?php endwhile;

get_footer(); ?>