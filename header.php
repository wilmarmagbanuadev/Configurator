<?php

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blank' ); ?></a>

	<header id="masthead" class="site-header">
        <?php if(get_field('top_header_text','options') || get_field('facebook','options') || get_field('twitter','options') || get_field('linkedin','options')){ ?>
            <?php if(get_field('show_header_text','options') || get_field('show_header_socmed','options')){ ?>
            <div class="top-header-bar">
                <?php if(get_field('show_header_text','options')){ ?>
                    <div class="recent-news-feed">
                        <?php echo (get_field('top_header_text','options'))?get_field('top_header_text','options'):'If you can Dream it you can Configure it';?>
                    </div>
               <?php } ?>
                <?php if(get_field('show_header_socmed','options')){ ?>
                <div class="header-social-links">
                    <ul>
                        <?php if(get_field('facebook','options')){ ?><li><a href="<?php the_field('facebook','options');?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                        <?php if(get_field('twitter','options')){ ?><li><a href="<?php the_field('twitter','options');?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                        <?php if(get_field('linkedin','options')){ ?><li><a href="<?php the_field('linkedin','options');?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                    </ul>
                </div>
                <?php } ?>
            <?php } ?>
            </div>
        <?php } ?>
        <div class="main-header clearfix">
            <div class="site-branding">
                <?php
                $site_logo = the_custom_logo();
                if(get_field('show_site_logo','options')){
                    echo ($site_logo)?$site_logo:'<img src="'.get_template_directory_uri().'/assets/images/configurator-logo.png">';
                }
                
                if ( is_front_page() && is_home() ) :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo (get_bloginfo( 'name' ))? get_bloginfo( 'name' ):'Configurator'; ?></a></h1>
                    <?php
                else :
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo (get_bloginfo( 'name' ))? get_bloginfo( 'name' ):'Configurator'; ?></a></p>
                    <?php
                endif;
                $blank_description = get_bloginfo( 'description', 'display' );
                if ( $blank_description || is_customize_preview() ) {
                    ?>
                    <p class="site-description"><?php echo (get_bloginfo( 'description')) ? get_bloginfo( 'description'): 'If you can Dream it you can Configure it'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php }else{ ?>
                    <p class="site-description"><?php echo (get_bloginfo( 'description')) ? get_bloginfo( 'description'): 'If you can Dream it you can Configure it'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
               <?php } ?>
            </div><!-- .site-branding -->
            <div class="container">
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="btn_menu"></span></button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->
            </div>
        </div>
	</header><!-- #masthead -->
