<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blank
 */

?>

	<footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="site-info">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf( esc_html__( '©2020 Blank.', 'blank' ), 'WordPress' );
                ?>
            </div><!-- .site-info -->
            <div class="footer-social-links">
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
