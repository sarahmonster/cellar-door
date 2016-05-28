<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cellar_Door
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php cellardoor_game_information( get_the_ID() ); ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
<?php endif;
