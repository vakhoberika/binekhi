<?php

add_theme_support('menus');  //Add menu support
add_theme_support('html5', array( 'search-form' ) );

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function my_deregister_styles() {
    wp_deregister_style( 'language-selector' );
}
add_action( 'init', 'my_deregister_styles');

function icl_post_languages(){
  if( function_exists( 'icl_get_languages' ) ):
  $languages = icl_get_languages();
  endif;

  if(1 < count($languages)){
  	//print_r($languages); die();
  	$switcherOther = "";
    foreach($languages as $l){
      if($l['active']){
      	$switcherActive = '<button type="button" class="dropdown-toggle" id="lang-dropdown" data-toggle="dropdown"><span>'.$l['tag'].'</span> <img src="'.get_stylesheet_directory_uri().'/image/arrow_down.svg" alt=""></button>';
      } else {
      	$switcherOther .= '<li><a href="'.$l['url'].'">'.$l['tag'].'</a></li>';
      }
    }
    $switcher = '<div class="lang">';
    $switcher .= $switcherActive;
    $switcher .= '<ul class="list-unstyled dropdown-menu" role="menu" aria-labelledby="lang-dropdown">';
    $switcher .= $switcherOther;
    $switcher .= '</ul>';
    $switcher .= '</div>';
    return $switcher;
  }
}


// AJAX
add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );

function my_action_callback() {
  global $wpdb;
  session_start();
  $content = '';

  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    
    if( $_REQUEST['get_all_products'] ):

    ?>
    <section class="secondary-nav container-fluid menu-container">

        <div class="container">

            <div class="row nopadding secondary-nav-products">

                <div class="col-xs-24">
                    <nav class="cats">
                        <ul class="list-inline">

                        <?php
                            $categories_list = get_categories(array(
                                'hide_empty'   => 0,
                                'hierarchical' => true,
                                'exclude'      => 1
                            ));

                        $i = 0;
                        $len = count($categories_list);

                        foreach ($categories_list as $ckey => $cat) {
                            if ($i == 0) {
                                ?><li data-cat_id="<?php echo $cat->cat_ID; ?>"><a href=""><?php echo mb_strtoupper( $cat->cat_name ); ?></a></li><!--<?php
                            } else if ($i == $len - 1) {
                                ?>--><li data-cat_id="<?php echo $cat->cat_ID; ?>"><a href=""><?php echo mb_strtoupper( $cat->cat_name ); ?></a></li><?php
                            } else {
                                ?>--><li data-cat_id="<?php echo $cat->cat_ID; ?>"><a href=""><?php echo mb_strtoupper( $cat->cat_name ); ?></a></li><!--<?php
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


    <?php

      $the_query = new WP_Query( array( 'post_status' => 'publish', 'post_type' => 'product' ) );
      if ( $the_query->have_posts() ) {

        $content .= '
    <section class="inner_loader">
    <section class="products-list-wrapper container">

        <div class="row nopadding">
';
        while ( $the_query->have_posts() ) { $the_query->the_post();

          $images = get_field('images');
          if( $images ) {
            $image = $images[0]['image'];
          } else {
            $image = get_stylesheet_directory_uri(). 'image/default.png';
          }      

          $content .= '
          <div class="product-block col-xs-24 col-sm-12 col-md-8 col-lg-6">
                <a href="'.get_permalink().'" data-product_id="'.get_the_ID().'" data-title="'.get_the_title().'">
                    <div class="small-img-wrapper">
                        <img src="'.$image.'" alt="">
                    </div>
                    <div class="product-name">
                        <h2>BINEKHI</h2>
                        <h3>'.get_the_title().'</h3>
                    </div>
                </a>
            </div>
          ';

        }
      } else {
        //no posts
      }
      wp_reset_postdata();


    $content .= '</div>
    </section>
    </section>';

    elseif( $_REQUEST['get_products_by_cat'] ):

      $the_query = new WP_Query( array( 'post_status' => 'publish', 'post_type' => 'product', 'cat' => $_REQUEST['get_products_by_cat'] ) );
      if ( $the_query->have_posts() ) {
        
        while ( $the_query->have_posts() ) { $the_query->the_post();

          $images = get_field('images');
          if( $images ) {
            $image = $images[0]['image'];
          } else {
            $image = get_stylesheet_directory_uri(). 'image/default.png';
          }
          
          
$content .= '
    <section class="inner_loader">
    <section class="products-list-wrapper container">

        <div class="row nopadding">
';
        
          $content .= '
          <div class="product-block col-xs-12 col-sm-8 col-md-6 col-lg-4">
                <a href="'.get_permalink().'" data-product_id="'.get_the_ID().'" data-title="'.get_the_title().'">
                    <div class="small-img-wrapper">
                        <img src="'.$image.'" alt="">
                    </div>
                    <div class="product-name">
                        <h2>BINEKHI</h2>
                        <h3>'.get_the_title().'</h3>
                    </div>
                </a>
            </div>
          ';

        }
      } else {
        $content .= 'No Products Found in this category';
      }
      wp_reset_postdata();
    $content .= '</div>
    </section>
    </section>';


    elseif( $_REQUEST['get_product_single'] ):

$the_query = new WP_Query( array( 'post_status' => 'publish', 'post_type' => 'product', 'p' => $_REQUEST['get_product_single'] ) );
if ( $the_query->have_posts() ) { while ( $the_query->have_posts() ) { $the_query->the_post();
?>


<section class="secondary-nav container-fluid single-header">

    <div class="container">

        <div class="row secondary-nav-details">

            <div class="col-xs-5">
                <button type="button" class="goback"><img src="<?php echo get_stylesheet_directory_uri(); ?>/image/arrow_back.svg" alt=""></button>
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
              <h3><?php _e('SPECIFICATIONS'); ?></h3>
              <?php echo get_field('specifications'); ?>
            </div>
            <?php endif; ?>

            <?php if( get_field('awards') ): ?>
            <div class="specifications">
              <h3><?php _e('AWARDS'); ?></h3>
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

        <h2><?php _e('GREAT WITH'); ?></h2>
        <h3><?php _e('FOOD RECOMENDATIONS'); ?></h3>

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

<?php
  }
} else {
  $content .= 'No Products Found with this id';
}
wp_reset_postdata();

  
    else:
      $content = "nothing";
    endif;

    echo $content;
  }
  else {
    header("Location: ".$_SERVER["HTTP_REFERER"]);
  }

  die();
}


add_filter('admin_url', 'remove_language_for_admin_ajax', 200, 2);
function remove_language_for_admin_ajax($url, $path) {
if($path == 'admin-ajax.php') {
$url = str_replace('/' . ICL_LANGUAGE_CODE . '/', '/', $url);
}
return $url;
}



function binekhi_post_id_get( $cat, $taxonomy='category', $posttype, $return_prev = false, $return_next = false )
{
    $ids = get_posts(array(
        'post_type'     => $posttype,
        'numberposts'   => -1, // get all posts.
        'tax_query'     => array(
            array(
                'taxonomy'  => $taxonomy,
                'field'     => 'id',
                'terms'     => $cat,
            ),
        ),
        'fields'        => 'ids', // only get post IDs.
        'suppress_filters' => 0,
    ));

    sort( $ids );

    if( !$return_prev && !$return_next ) {
      return $ids;
    }

    $key = array_search( get_the_ID(), $ids);
    
    if( $return_prev ) {      
      if( is_numeric( $key ) && is_numeric( $ids[$key-1] ) ) {
        return $ids[$key-1];
      } else {
        return false;
      }
    }
    if( $return_next ) {
      if( is_numeric( $key ) && is_numeric( $ids[$key+1] ) ) {
        return $ids[$key+1];
      } else {
        return false;
      }
    }
}



function binekhi_post_id_get_2( $post_id, $posttype, $return_prev = false, $return_next = false )
{
    $ids = get_posts(array(
        'post_type'     => $posttype,
        'numberposts'   => -1, // get all posts.
        'fields'        => 'ids', // only get post IDs.
        'suppress_filters' => 0,
    ));

    sort( $ids );

    if( !$return_prev && !$return_next ) {
      return $ids;
    }

    $key = array_search( $post_id, $ids);
    
    if( $return_prev ) {      
      if( is_numeric( $key ) && is_numeric( $ids[$key-1] ) ) {
        return $ids[$key-1];
      } else {
        return false;
      }
    }
    if( $return_next ) {
      if( is_numeric( $key ) && is_numeric( $ids[$key+1] ) ) {
        return $ids[$key+1];
      } else {
        return false;
      }
    }
}

function get_food_by_id($id) {
  $food = get_post( $id );
  return json_encode($food);
}