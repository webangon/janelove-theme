<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

function janelove_post_author(){
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( '%s', 'post author', 'janelove' ),
		'<span class="author vcard"> <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="single-author leffect-1"> <i class="dashicons dashicons-admin-users"></i>'.$byline.'</span>';	
}

function janelove_post_date(){

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_attr( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_attr( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( '%s', 'post date', 'janelove' ),
		$time_string
	);

	echo '<span class="single-date leffect-1"><i class="dashicons dashicons-clock"></i> '.$posted_on.'</span>';	
}

function janelove_category(){

        if ( 'post' == get_post_type() ) {
            $categories = get_the_category();
            $separator = ' '; 
             
            $output = '';
            if($categories){
                foreach($categories as $category) {
          
                    $output .= '<a class="cat-bg" href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
                }
            $cat= trim($output, $separator);
            echo '<span class="catbg-wrap">'.$cat.'</span>';
            }
        }

}

add_filter('wp_list_categories', 'janelove_cat_count_span');
function janelove_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
function janelove_style_the_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span>(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter('get_archives_link', 'janelove_style_the_archive_count');

add_filter('wp_generate_tag_cloud', 'janelove_tagcloud_inline_style',10,1);
function janelove_tagcloud_inline_style($input){ 
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input); 
}

