<?php
/**
 * Configure Fieldmanager plugin to display additional meta box on posts.
 * This is used to add additional context to review posts.
 *
 * @package Feminist_Frequency
 */

add_action( 'fm_post_post', function() {
    $fm = new Fieldmanager_Group( array(
        'name' => 'game_information',
        'children' => array(
            'date_published' => new Fieldmanager_Textfield( __( 'Date Published', 'femfreq' ) ),
            'developer' => new Fieldmanager_Textfield( __( 'Developer', 'femfreq' ) ),
            'publisher' => new Fieldmanager_Textfield( __( 'Publisher', 'femfreq' ) ),
        ),
    ) );
    $fm->add_meta_box( __( 'Game Information', 'femfreq' ), 'post' );
} );

/**
 * Retrieve game information and display it.
 */
function femfreq_game_information( $id ) {
    $game_information = get_post_meta( $id, 'game_information' );
    if ( 0 < count( $game_information ) ) :
        $game = $game_information[0];
        echo '<section id="game-information" class="widget">';
        echo '<h2 class="widget-title">';
        esc_html_e( 'Game information', 'femfreq' );
        echo '</h2>';

        echo '<dl>';

        if ( $game['date_published'] ) :
            echo '<dt>';
            esc_html_e( 'Published', 'femfreq' );
            echo '</dt><dd>';
            echo $game['date_published'];
            echo '</dd>';
        endif;

        if ( $game['developer'] ) :
            echo '<dt>';
            esc_html_e( 'Developer', 'femfreq' );
            echo '</dt><dd>';
            echo $game['developer'];
            echo '</dd>';
        endif;

        if ( $game['publisher'] ) :
            echo '<dt>';
            esc_html_e( 'Publisher', 'femfreq' );
            echo '</dt><dd>';
            echo $game['publisher'];
            echo '</dd>';
        endif;

        echo '</dl>';
        echo '</section>';
    endif;
}
