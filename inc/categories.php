<?php
/**
 * Custom functions to add extra category functionality, such as default menus
 * and colour-coding. Since the magazine format is pretty category-heavy, we're
 * adding some extra fluff here to create some visual interest.
 *
 * @package Cellar_Door
 */

/**
 * Create an array of our most-used categories.
 *
 * @param int $number Number of categories to return.
 * @return array
 */
function cellardoor_get_popular_categories( $number ) {
	$args = array(
		'orderby' => 'count',
		'order'   => 'DESC',
		'number'  => $number,
	);
	$categories = get_categories( $args );
	return $categories;
}

/**
 * Output a menu of the five most popular categories.
 *
 * @return string
 */
function cellardoor_category_menu() {
	$categories = cellardoor_get_popular_categories( 5 );
	?>
	<ul id="primary-menu">
		<?php foreach( $categories as $category ) : ?>
			<li><a href="<?php echo esc_url( get_category_link( $category->cat_ID ) ); ?>" title="<?php echo $category->cat_name; ?>"><?php echo $category->cat_name; ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php }
