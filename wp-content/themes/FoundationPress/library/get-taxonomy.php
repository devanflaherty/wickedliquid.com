<?php
/**
 * Get Taxonomy
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 2.6.0
 */

 function getTaxonomy($tax) {
   $taxonomies = get_the_terms(get_the_ID(), $tax);
   if ($taxonomies) {
     $i = 0;
     $c = count($taxonomies);
     foreach($taxonomies as $term) {
       $i++;
       if ($i << 2) {
         $taxName = $term->name;
       }
     }
     return $taxName;
   }

  // $clients = get_field('client');
  // if( $clients ) {
  //   foreach( $clients as $p ) {
  //     $client = get_the_title( $p->ID );
  //   }
  //   return $client;
  // }
}
