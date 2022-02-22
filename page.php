<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blank
 */

get_header();
?>
<div class="site-content">
        <div class="container clearfix">
            <main id="primary" class="site-main">

                <?php
               
               $posts_per_page =  get_option('blank-elements-pro')['product_per_page-count'][0];
                // check for plugin using plugin name
                
                if ( class_exists( 'WooCommerce' ) ) {
                    if(in_array('configurator-template-kits-blocks/configurator-template-kits-blocks.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
                            
                        if(is_woocommerce()){
                                echo do_shortcode('[products limit='. $posts_per_page.' paginate=true]');
                            //   require_once( WP_PLUGIN_DIR .'/configurator-template-kits-blocks/woocommerce/archive-product.php' );
                            }else if(is_cart()){
                                echo do_shortcode('[woocommerce_cart]');
                            }else if(is_checkout()){
                                echo do_shortcode('[woocommerce_checkout]');
                            }elseif(is_account_page()){
                                echo do_shortcode('[woocommerce_my_account]');
                            }
                    }
                    else{
                        while ( have_posts() ) :
                            the_post();  
                                get_template_part( 'template-parts/content', 'page' );
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
    
                        endwhile; // End of the loop.
                    }
                }
                else{
                    while ( have_posts() ) :
                        the_post();  
                            get_template_part( 'template-parts/content', 'page' );
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                   
                }
                ?>

            </main><!-- #main -->
            <?php //get_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();