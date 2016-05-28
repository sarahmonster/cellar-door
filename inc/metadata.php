<?php
/**
 * Configure Fieldmanager plugin to display additional meta box on posts.
 * This is used to add additional context to review posts.
 *
 * @package Cellar_Door
 */

 /**
  * Use Fieldmanager plugin to set up a custom post meta box for game information.
  *
  * @link http://fieldmanager.org/
  */
function cellardoor_set_up_game_information_meta() {
    $fm = new Fieldmanager_Group( array(
        'name' => 'game_information',
        'children' => array(
            'date_published' => new Fieldmanager_Textfield( __( 'Date Published', 'cellar-door' ) ),
            'developer' => new Fieldmanager_Textfield( __( 'Developer', 'cellar-door' ) ),
            'publisher' => new Fieldmanager_Textfield( __( 'Publisher', 'cellar-door' ) ),
        ),
    ) );
    $fm->add_meta_box( __( 'Game Information', 'cellar-door' ), 'post', 'side', 'default' );
}
add_action( 'fm_post_post', 'cellardoor_set_up_game_information_meta' );

/**
 * Retrieve game information and display it in a widget.
 *
 * @param int $id ID of the post for which you want to get meta information.
 */
function cellardoor_game_information( $id ) {
    $game_information = get_post_meta( $id, 'game_information' );
    if ( ! empty( $game_information ) && ! empty( $game_information[0] ) && ! empty( $game_information[0]['date_published'] ) ) :
        $game = $game_information[0];
        echo '<section id="game-information" class="widget">';
        echo '<h2 class="widget-title">';
        esc_html_e( 'Game information', 'cellar-door' );
        echo '</h2>';

        echo '<dl>';

        if ( $game['date_published'] ) :
            echo '<dt>';
            esc_html_e( 'Published', 'cellar-door' );
            echo '</dt><dd>';
            echo $game['date_published'];
            echo '</dd>';
        endif;

        if ( $game['developer'] ) :
            echo '<dt>';
            esc_html_e( 'Developer', 'cellar-door' );
            echo '</dt><dd>';
            echo $game['developer'];
            echo '</dd>';
        endif;

        if ( $game['publisher'] ) :
            echo '<dt>';
            esc_html_e( 'Publisher', 'cellar-door' );
            echo '</dt><dd>';
            echo $game['publisher'];
            echo '</dd>';
        endif;

        echo '</dl>';
        echo '</section>';
    endif;
}
