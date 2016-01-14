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
	// This shortcode doesn't actually do anything.
	add_shortcode( 'shortcake-no-attributes', '__return_false' );
	// This is a simple example for a pullquote with a citation.
	add_shortcode( 'shortcake_dev', 'shortcode_ui_dev_shortcode' );
	add_shortcode( 'transcript', 'femfreq_transcript_shortcode' );
}
add_action( 'init', 'femfreq_register_shortcodes' );

/**
 * Register a super-simple UI for the transcript shortcode.
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
 * Render the transcript wrapper.
 */
function femfreq_transcript_shortcode( $attr, $content = '', $shortcode_tag ) {
	$attr = shortcode_atts( array(
		'source'     => '',
		'attachment' => 0,
		'source'     => null,
	), $attr, $shortcode_tag );
	ob_start();
	?>

	<div class="transcript">
		<h2><?php esc_html_e( 'Transcript', 'femfreq' ); ?></h2>
		<?php echo wpautop( wp_kses_post( $content ) ); ?>
	</div>

	<?php
	return ob_get_clean();
}
