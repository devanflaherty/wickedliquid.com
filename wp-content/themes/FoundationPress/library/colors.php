<?php
/**
 * Get page colors
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 2.6.0
 */

 function getColors() {
   if (get_field( 'primary_color' ) && get_field( 'secondary_color' )) {
     $primaryColor = get_field( 'primary_color' );
     $secondaryColor = get_field( 'secondary_color' );
   } else {
     $primaryColor = get_field( 'site_primary_color', 'option' );
     $secondaryColor = get_field( 'site_secondary_color', 'option' );
   }
   return array('primary' => $primaryColor, 'secondary' => $secondaryColor);
}
