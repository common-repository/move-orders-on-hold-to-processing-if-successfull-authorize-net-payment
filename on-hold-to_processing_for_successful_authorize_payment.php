<?php
/**
 * Plugin Name: Move orders on-hold to processing if successful authorize.net payment
 * Plugin URI: https://ondway2legend.wordpress.com/
 * Description: Move orders on-hold to processing if successful authorize.net payment. Cron job rans every 5 minutes and check on-hold orders to see if there any successfull payment from Authorize.net. If yes change the order status to processing from on-hold.  
 * Author: Md. Atiqur Rahman Sujon
 * Author URI: https://developersquad.com/
 * Version: 1.0
 * License: GPLv2 or later
 */


//Adding cron to update the on-hold orders which get Authorize.Net Credit Card Charge Approved later
add_filter( 'cron_schedules', 'ondway2legend_add_every_five_minutes' );

function ondway2legend_add_every_five_minutes( $schedules ) {
    $schedules['every_five_minutes'] = array(
            'interval'  => 60 * 5,
            'display'   => __( 'Every 5 Minutes', 'textdomain' )
    );
    return $schedules;
}

// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'ondway2legend_add_every_five_minutes' ) ) {
    wp_schedule_event( time(), 'every_five_minutes', 'ondway2legend_add_every_five_minutes' );
}


// Hook into that action that'll fire every five minutes
add_action( 'ondway2legend_add_every_five_minutes', 'ondway2legend_check_and_update_order_if_successful_authorize_payment' );

function ondway2legend_check_and_update_order_if_successful_authorize_payment() {
    
    //Check on-hold orders to see if there is any authorize.net successfull payment. If yes then chnage the order status to processing
    $statuses = ['on-hold'];
    $orders = wc_get_orders( ['limit' => -1, 'status' => $statuses] );
    

    foreach ($orders as $key => $value) {
        
        $notes = wc_get_order_notes( array(
            'order_id' => $value->id,
            'type'     => 'internal', // use 'internal' for admin and system notes, empty for all
        ) );
     
        if ( $notes ) {
            foreach( $notes as $key => $note ) {
                // system notes can be identified by $note->added_by == 'system'
                if (strpos($note->content, 'Authorize.Net Credit Card Charge Approved:') !== false ) { 
                    //printf( '<div class="note_content">%s</div>', wpautop( wptexturize( wp_kses_post( make_clickable( $note->content ) ) ) ) );
                    $value->update_status( 'wc-processing' );
                }
                

            }
        }
    }
    
    
}
?>