	<footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="site-info">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                echo '©'.date('Y').' ';
                $check_title = (get_bloginfo( 'title' )==null)?'Configurator':get_bloginfo( 'title' );
                echo (get_field('footer_text','options'))?'<a href="'.site_url().'">'.get_field('footer_text','options').'</a>':'<a href="'.site_url().'">'.$check_title.'</a>';
                ?>
            </div><!-- .site-info -->
            <?php if(get_field('show_footer_socmed','options')){ ?>
            <div class="footer-social-links">
                <ul>
                <?php if(get_field('facebook','options')){ ?><li><a href="<?php the_field('facebook','options');?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                <?php if(get_field('twitter','options')){ ?><li><a href="<?php the_field('twitter','options');?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                <?php if(get_field('linkedin','options')){ ?><li><a href="<?php the_field('linkedin','options');?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
