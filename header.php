<!DOCTYPE html>
<html lang="<?php echo ICL_LANGUAGE_CODE; ?>">
<head>
<base href="/">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php the_title(); ?></title>
<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/image/favicon.png">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display+SC:900&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/lib/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/lib/bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style/stylesheet.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style/responsive.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>
<body ng-app="binekhi">
<div class="main-wrapper">
<header class="header container-fluid">
    <div class="container">

        <div class="row">
            <div class="header-col-1 col-xs-24 col-sm-9 col-md-9 col-lg-9">
                <nav class="top-left-menu">
                    <ul class="list-inline">
                        <li>
                            <a href="http://binekhi.ge/<?php echo ICL_LANGUAGE_CODE != 'en' ? ICL_LANGUAGE_CODE.'/' : ''; ?>"><?php echo icl_t('binekhi','HOME','HOME'); ?></a>
                        </li><!-- 
                         --><li>
                            <a href="http://binekhi.ge/<?php echo ICL_LANGUAGE_CODE != 'en' ? ICL_LANGUAGE_CODE.'/' : ''; ?>products"><?php echo icl_t('binekhi','PRODUCTS','PRODUCTS'); ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="header-col-2 col-xs-24 col-sm-6 col-md-6 col-lg-6">
                <a href="<?php echo icl_get_home_url() ?>" class="top-logo">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/binekhi-logo.png" alt="Binekhi" class="img-responsive">
                </a>

                <button type="button" class="menu-btn" id="menu-btn">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="header-col-3 col-xs-24 col-sm-9 col-md-9 col-lg-9">
                <nav class="top-right-menu">
                    <ul class="list-inline">
                        <li>
                            <a href="http://binekhi.ge/<?php echo ICL_LANGUAGE_CODE != 'en' ? ICL_LANGUAGE_CODE.'/' : ''; ?>culture"><?php echo icl_t('binekhi','CULTURE','CULTURE'); ?></a>
                        </li><!-- 
                         --><li>
                            <a href="<?php site_url(); ?>/<?php echo ICL_LANGUAGE_CODE != 'en' ? ICL_LANGUAGE_CODE.'/' : ''; ?>#contact"><?php echo icl_t('binekhi','CONTACTS','CONTACTS'); ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <?php if( function_exists('icl_post_languages') ) { echo icl_post_languages(); } ?>
        
    </div>
</header>
