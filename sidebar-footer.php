<?php
/**
 * The footer area containing three widget areas.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cellar_Door
 */

 if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
 	<div id="tertiary" class="footer-widget-area" role="complementary">
 		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
 		    <div id="footer-1" class="widget-area">
 		        <?php dynamic_sidebar( 'footer-1' ); ?>
 		    </div>
 		<?php endif; ?>

 		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
 		    <div id="footer-2" class="widget-area">
 		        <?php dynamic_sidebar( 'footer-2' ); ?>
 		    </div>
 		<?php endif; ?>

 		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
 		    <div id="footer-3" class="widget-area">
 		        <?php dynamic_sidebar( 'footer-3' ); ?>
 		    </div>
 		<?php endif; ?>
 	</div><!-- #tertiary -->
<?php endif;
