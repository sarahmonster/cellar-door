<?php
/**
 * Configure Shortcake UI so we can apply special formatting to certain elements.
 * Primarily used for video transcripts and resource lists within posts.
 *
 * @package Feminist_Frequency
 */

/**
 * Register the two shortcodes independently of their UI.
 * Shortcodes should always be registered, but shortcode UI should only
 * be registered when Shortcake is active.
 */
function femfreq_register_shortcodes() {
	add_shortcode( 'transcript', 'femfreq_transcript_shortcode' );
	add_shortcode( 'resourcelist', 'femfreq_resourcelist_shortcode' );
}
add_action( 'init', 'femfreq_register_shortcodes' );

/**
 * Register a UI for the transcript shortcode.
 */
function femfreq_transcript_shortcode_ui() {
	shortcode_ui_register_for_shortcode( 'transcript', array(
		'label'         => esc_html__( 'Video Transcript', 'femfreq' ),
		'listItemImage' => 'dashicons-format-video',
		'inner_content' => array(
			'label'        => esc_html__( 'Transcript', 'femfreq' ),
			'description'  => esc_html__( 'Include the full text of the video transcript. No need to include the word transcript as a title, since this will be automatically prefixed to the post.', 'femfreq' ),
		),
	) );
}
add_action( 'register_shortcode_ui', 'femfreq_transcript_shortcode_ui' );

/**
 * Register a UI for the resource list shortcode.
 */
function femfreq_resourcelist_shortcode_ui() {
	shortcode_ui_register_for_shortcode( 'resourcelist', array(
		'label'         => esc_html__( 'Resource List', 'femfreq' ),
		'listItemImage' => 'dashicons-list-view',
		'inner_content' => array(
			'label'        => esc_html__( 'Resource List', 'femfreq' ),
			'description'  => esc_html__( 'Write out your list here. You can include HTML as needed.', 'femfreq' ),
		),
		'attrs' => array(
			array(
				'label'  => esc_html__( 'List title', 'femfreq' ),
				'attr'   => 'title',
				'type'   => 'text',
				'encode' => true,
				'meta'   => array(
					'placeholder' => esc_html__( 'List title', 'femfreq' ),
				),
			),
		),
	) );
}
add_action( 'register_shortcode_ui', 'femfreq_resourcelist_shortcode_ui' );

/**
 * Output transcripts, along with a containing div and a title.
 * The title is static, and says "Transcript" for all transcripts.
 */
function femfreq_transcript_shortcode( $attr, $content = '', $shortcode_tag ) {
	ob_start();
	?>

	<div class="transcript">
		<h2><?php esc_html_e( 'Transcript', 'femfreq' ); ?></h2>
		<?php echo wpautop( wp_kses_post( $content ) ); ?>
	</div>

	<?php
	return ob_get_clean();
}

/**
 * Output resource lists, along with a containing div and title.
 * The title is derived from the attributes.
 */
function femfreq_resourcelist_shortcode( $attr, $content = '', $shortcode_tag ) {
	$attr = shortcode_atts( array(
		'title'     => '',
	), $attr, $shortcode_tag );
	ob_start();
	?>

	<div class="resource-list">
		<h2><?php echo esc_html__( $attr[ 'title' ] ); ?></h2>
		<?php echo wpautop( wp_kses_post( $content ) ); ?>
	</div>

	<?php
	return ob_get_clean();
}
