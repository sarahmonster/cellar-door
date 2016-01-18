<?php
/**
 * Configure Fieldmanager plugin to display additional meta box on posts.
 * This is used to add additional context to review posts.
 *
 * @package Feminist_Frequency
 */

 add_action( 'fm_post_post', function() {
     $fm = new Fieldmanager_Group( array(
         'name' => 'game_info',
         'children' => array(
             'name' => new Fieldmanager_Textfield( __( 'Year Published', 'femfreq' ) ),
             'phone_number' => new Fieldmanager_Textfield( __( 'Developer', 'femfreq' ) ),
             'website' => new Fieldmanager_Link( __( 'Publisher', 'femfreq' ) ),
         ),
     ) );
     $fm->add_meta_box( __( 'Game Details', 'femfreq' ), 'post' );
 } );
