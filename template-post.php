<?php
/**
 * Template Name: Item Template
 *
 */

$product = array();

$the_query = new WP_Query( array( 'post_status' => 'publish', 'post_type' => 'product', 'p' => $_GET['id'] ) );
if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

$product['id'] = get_the_ID();
$product['title'] = get_the_title();
$product['specifications_title'] = icl_t('binekhi','SPECIFICATIONS','SPECIFICATIONS');
$product['specifications'] = get_field('specifications');
$product['awards_title'] = icl_t('binekhi','AWARDS','AWARDS');
$product['awards'] = get_field('awards');
$product['images'] = get_field('images');
$product['great_with_title_1'] = icl_t('binekhi','GREAT WITH','GREAT WITH');
$product['great_with_title_2'] = icl_t('binekhi','FOOD RECOMMENDATIONS','FOOD RECOMMENDATIONS');
$product['great_with'] = array();


$product['nextpostid'] = binekhi_post_id_get_2(get_the_ID(),'product',false,true);
$product['prevpostid'] = binekhi_post_id_get_2(get_the_ID(),'product',true,false);

if( get_field('great_with') ):

	$greatwith = get_field('great_with');

        foreach( $greatwith as $key => $pid ):
        	$greatwitharray[$key]['image'] = get_field('image', $pid);
            $greatwitharray[$key]['title'] = get_the_title($pid);
		endforeach;


	$product['great_with'] = $greatwitharray;

endif;

echo json_encode( $product );

endwhile;
endif;

die();