<?php
//Creating rows and columns for Images, Categories and Sub Categories. Don't change anything***
//Creating rows and columns for Images, Categories and Sub Categories. Don't change anything***
add_filter( 'wp_all_export_csv_headers', 'wpae_wp_all_export_csv_headers', 10, 2 );

function wpae_wp_all_export_csv_headers( $headers, $export_id ) {
	global $wpdb;
    $last_id = $wpdb->get_var( 'SELECT id FROM ' . $wpdb->prefix . 'pmxe_exports' . ' ORDER BY id DESC LIMIT 1 ');	
 if ( $export_id == $last_id++ ) { // change to your export ID*/
        $additional_headers = array(
            'Product Title',
			'Description ',
			'Short Description ',
			'Product Features ',
			'Product Specifications ',
            'Main Categories ',
			'Sub Categories ',
			'Image 1',
            'Image 2',
            'Image 3',
            'Image 4',
            'Image 5',
            'Image 6',
            'Image 7',
            'Image 8',
            'Image 9',
            'Image 10'
        );
        $headers = array_merge( $headers, $additional_headers );
 }
    return $headers; 
}

//Creating rows and columns for Images, Categories and Sub Categories. Don't change anything***
function wp_all_export_csv_rows( $articles, $options, $export_id ) {
	global $wpdb;
    $last_id = $wpdb->get_var( 'SELECT id FROM ' . $wpdb->prefix . 'pmxe_exports' . ' ORDER BY id DESC LIMIT 1 ');	
if ( $export_id == $last_id++ ) { // change to your export ID*/
        foreach( $articles as $key => $article ) {
            if ( array_key_exists( 'ID', $article ) ) {
                $i = 1;
                $product = wc_get_product( $article['ID'] );

                if ( ! empty( $product ) ) {

                    $featured_img = wp_get_attachment_url( $product->get_image_id() );

                    if ( ! empty( $featured_img ) ) {
                        $articles[ $key ]['Image ' . $i] = $featured_img;
                    }

                    $other_imgs = $product->get_gallery_image_ids();

                    if ( ! empty( $other_imgs ) ) {
                        foreach ( $other_imgs as $id ) {
                            $i++;
                            $img = wp_get_attachment_url( $id );
                            $articles[ $key ]['Image ' . $i] = $img;
                        }
                    }
						$the_id = $product->post->post_parent > 0 ? $product->post->post_parent : $product->post->ID;
						$cats_array = wp_get_post_terms( $the_id, 'product_cat', array("fields" => "ids") );

						if ( ! empty( $cats_array ) ){
							$k_name = array();
							foreach ( $cats_array as $ID ) { 
   								$k_name[] = get_the_category_by_ID( $ID );
 								// uncomment the next line to get the name tied to the ID
  							    // $names_k[$ID] = get_the_category_by_ID( $ID );
							}
							$cat_main1 = array_values($k_name)[0];
						    $articles[ $key ]['Main Categories ' ] = $cat_main1;
							
						}

							$the_id_s = $product->post->post_parent > 0 ? $product->post->post_parent : $product->post->ID;
							$s_cats_array = wp_get_post_terms( $the_id_s, 'product_cat', array("fields" => "ids") );
			
						if ( ! empty( $s_cats_array ) ){
						$s_k_name = array();
							foreach ( $s_cats_array as $ID ) { 
   							 $s_k_name[] = get_the_category_by_ID( $ID ); }
								$s_cat1 = array_values($s_k_name)[1];
								$s_cat2 = array_values($s_k_name)[2];
								$s_cat3 = array_values($s_k_name)[3];
								$s_cat4 = array_values($s_k_name)[4];
 							$all_s_cats =  $s_cat1 . "\r\n" . $s_cat2 . "\r\n" .$s_cat3 . "\r\n" . $s_cat4;
						   $articles[ $key ]['Sub Categories ' ] = $all_s_cats;
						}
							$pr_description = $product->post->post_parent > 0 ? $product->post->post_parent : $product->post->ID;
							$decs = get_post( $pr_description )->post_content;
						if ( ! empty( $decs ) ){

						   $articles[ $key ]['Description ' ] = preg_replace ('/<[^>]*>/', ' ', $decs);
						}
							$myvals = get_post_meta($product->get_id());
						$pr_s_description = $product->post->post_parent > 0 ? $product->post->post_parent : $product->post->ID;	
							$short_decs = get_post( $pr_s_description )->post_excerpt;
						if ( ! empty( $short_decs ) ){

						   $articles[ $key ]['Short Description ' ] = preg_replace ('/<[^>]*>/', ' ', $short_decs);
						}
    				$features_group_id = $product->post->post_parent > 0 ? $product->post->post_parent : $product->post->ID;
					
					$fieldftr = get_fields( $features_group_id );
					$rpt_1 = array_values($fieldftr)[0];
					if ( ! empty( $rpt_2 ) ){

						   $articles[ $key ]['Product Features ' ] = preg_replace ('/<[^>]*>/', ' ',$rpt_1);
						}
					$specifications_group_id = $product->post->post_parent > 0 ? $product->post->post_parent : $product->post->ID;
					
					$fields_spec = get_fields( $specifications_group_id );
					$rpt_spc = array_values($fields_spec)[1];
					$spec_data = '';
					foreach ($rpt_spc['body'] as $item) {
   					 $spec_data .= trim($item[0]['c']) . ' ' . trim($item[1]['c']);
					 $spec_data .= "\r\n"; }
					if ( ! empty( $rpt_spc ) ){

						   $articles[ $key ]['Product Specifications ' ] = strip_tags ($spec_data , ENT_NOQUOTES );
					}
				}			
			}
		}
	}
    return $articles; // Return the array of records to export

}

add_filter('wp_all_export_csv_rows', 'wp_all_export_csv_rows', 10, 3);
?>
