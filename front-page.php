<?php get_header(); ?>

<!-- <h1>model: {{param}}</h1>
<a href="#/item/123">Item 1</a>
<a href="#/item/463">Item 2</a>
<a href="#/item/666">Item 3</a> -->
<?php
if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php $block = get_field('block'); ?>
<section class="section-1 section container-fluid">
    <div class="row">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/banner-1.jpg" alt="">
    </div>
    <div class="section-info-wrapper">
        <div class="container">
            <div class="middle">
                <h1 class="hidden-xs"><?php echo $block[0]['title']; ?></h1>
                <h3 class="hidden-xs"><?php echo $block[0]['description']; ?></h3>
                <a href="<?php echo $block[0]['button_link']; ?>" class="gs-btn-white"><?php echo $block[0]['button_text']; ?></a>
            </div>
        </div>
    </div>
</section>


<section class="section-2 container-fluid">

    <div class="row row-1">
        <div class="col-xs-24">
            <h2><?php echo $block[1]['title']; ?></h2>
            <h3><?php echo $block[1]['description']; ?></h3>
        </div>
    </div>

    <div class="row row-2">
        <div class="col-xs-offset-4 col-xs-16">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/grape.png" alt="Grape">
        </div>
    </div>

    <div class="row row-3">
        <div class="col-xs-1 col-sm-1 col-md-9 col-lg-9 nopadding">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/bottle.png" class="hidden-xs hidden-sm" alt="Bottle">
        </div>
        <div class="col-xs-22 col-sm-22 col-md-6 col-lg-6">
            <a href="<?php echo $block[1]['button_link']; ?>" class="gs-btn-black"><?php echo $block[1]['button_text']; ?></a>
        </div>
    </div>

</section>

<section class="section-3 section container-fluid">

    <div class="row">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/banner-2.jpg" alt="">
    </div>

    <div class="section-info-wrapper">
        <div class="container">
            <div class="middle">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/ornament-top.png" class="hidden-xs hidden-sm ornament-top" alt="">
                <h2><?php echo $block[2]['title']; ?></h2>
                <h3><?php echo $block[2]['description']; ?></h3>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/ornament-bottom.png" class="hidden-xs hidden-sm ornament-bottom" alt="">
                <p class="hidden-xs">&nbsp;</p>
                <div class="row">
                	<div class="col-sm-18 col-xs-offset-3">
                		<p class="hidden-xs"><?php echo $block[2]['content']; ?></p>
                	</div>
                </div>
            </div>
        </div>
    </div>

</section>


<section class="section-4 section container-fluid">

    <div class="row">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/banner-3.jpg" alt="">
    </div>

    <div class="section-info-wrapper">
        <div class="container">
            <div class="middle">
                <h2><?php echo $block[3]['title']; ?></h2>
                <h3><?php echo $block[3]['description']; ?></h3>
                <div class="row">
                	<div class="col-sm-18 col-xs-offset-3">
                		<p class="hidden-xs"><?php echo $block[3]['content']; ?></p>
                	</div>
                </div>
            </div>
        </div>
    </div>

</section>


<footer class="footer container-fluid">

    <div class="container">
        <div class="row nopadding">
            <div class="contact-title col-xs-20 col-xs-offset-2">
                <div class="row nopadding">
                    <div class="col-xs-24">
                        <h2><?php echo icl_t('binekhi','CONTACT US','CONTACT US'); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row nopadding">
            <div class="contact-details col-xs-24 col-xs-offset-0 col-sm-20 col-sm-offset-2">

                <div class="row nopadding">
                    <div class="contact-form col-xs-24 col-sm-10" id="contact">

                    <?php echo do_shortcode('[contact-form-7 title="Contact form '.ICL_LANGUAGE_CODE.'"]'); ?>

                    </div>
                    <div class="contact-info col-xs-offset-0 col-xs-24 col-sm-offset-4 col-sm-10">

                        <?php
                            $contact = get_page_by_title("contact");
                            $contact_page_id = $contact->ID;
                            if( function_exists("icl_object_id") ):
                                $translated_page_id = icl_object_id($contact_page_id, 'page', FALSE, ICL_LANGUAGE_CODE);
                            else:
                                $translated_page_id = $contact_page_id;
                            endif;

                            $query1 = new WP_Query( array( 'page_id' => $translated_page_id ) );
                            if( $query1->have_posts() ) : while( $query1->have_posts() ) : $query1->the_post();
                        ?>
                        <h3><?php echo icl_t('binekhi','BINEKHI LTD','BINEKHI LTD'); ?></h3>
                        <ul class="list-unstyled">
                            <li class="clearfix"><strong><?php echo icl_t('binekhi','Address','Address'); ?>: </strong> <span><?php echo get_field('address'); ?></span></li>
                            <li class="clearfix"><strong><?php echo icl_t('binekhi','E-Mail','E-Mail'); ?>: </strong> <span class="red-txt"><a href="mailto:<?php echo get_field('e-mail'); ?>" target="_blank"><?php echo get_field('e-mail'); ?></a></span></li>
                            <li class="clearfix"><strong><?php echo icl_t('binekhi','Tel','Tel'); ?>: </strong> <span><?php echo get_field('tel'); ?></span></li>
                            <li class="clearfix"><strong><?php echo icl_t('binekhi','Fax','Fax'); ?>: </strong> <span><?php echo get_field('fax'); ?></span></li>
                        </ul>

                        <?php
                            endwhile; endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>


<?php endwhile; endif; ?>


<?php get_footer(); ?>