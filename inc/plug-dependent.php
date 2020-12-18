<?php

function janelove_header_template(){
    get_template_part( 'template-parts/header', 'one' );
}
 
function janelove_render_html($output){
  return $output;
}

add_filter( 'body_class', 'janelove_bodyclass_checker' );
function janelove_bodyclass_checker( $classes ) {   
    $classes[] = '';
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }
    return $classes;   
} 
 
function janelove_single_title($arg){

        if ( is_category() ) {
            /* translators: Category archive title. 1: Category name */
            $title = single_cat_title( $arg['cat'], 'janelove',false);
        } elseif ( is_tag() ) {
            /* translators: Tag archive title. 1: Tag name */
            $title = single_cat_title( $arg['tag'], 'janelove',false);
        } elseif ( is_author() ) {
            $title = sprintf( $arg['author'].'%s', '<span>' . get_the_author() . '</span>' );
            //$title = get_the_author( 'Author: ', true );
        } elseif ( is_year() ) {
            /* translators: Yearly archive title. 1: Year */
            $title = sprintf( $arg['yarchive'], '<span>' .get_the_date('F Y', 'yearly archives date format' ). '</span>' );
        } elseif ( is_month() ) {
            /* translators: Monthly archive title. 1: Month name and year */
            $title =  sprintf( $arg['marchive'], '<span>' .get_the_date('F Y', 'monthly archives date format' ). '</span>' );
        } elseif ( is_404() ) {
            /* translators: Daily archive title. 1: Date */
            $title = $arg['notfound'];
        }elseif ( is_post_type_archive() ) {
            /* translators: Post type archive title. 1: Post type name */
            $title = post_type_archive_title( '', false );
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = single_term_title( '', false ) ;
        } elseif (is_search()){
            $title = sprintf( $arg['search'].'%s','<span>' . get_search_query() . '</span>' );
        }elseif( is_home() && is_front_page() ){
          $title = esc_html__( 'Frontpage', 'janelove' );
        } elseif( is_singular() ){
          $title = get_the_title();
        }else {
            $title = esc_html__( 'Archives','janelove' );
        }

        return $title;

}

function janelove_breadcumb() {

  $delimiter = ' | ';
  $name = esc_attr( 'Home', 'janelove' );
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
  
  
    echo '<div id="crumbs">';
   
    global $post;
  
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo '<span class="current">' . '';
      single_cat_title();
      echo '' . '</span>';
  
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo '<span class="current">' . get_the_time('d') . '</span>';
  
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<span class="current">' . get_the_time('F') . '</span>';
  
    } elseif ( is_year() ) {
      echo '<span class="current">' . get_the_time('Y') . '</span>';
  
    } elseif ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<span class="current">';
      the_title();
      echo '</span>';
  
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo '<span class="current">';
      the_title();
      echo '</span>';
  
    } elseif ( is_page() && !$post->post_parent ) {
      echo '<span class="current">';
      the_title();
      echo '</span>';
  
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo janelove_render_html($crumb) . ' ' . $delimiter . ' ';
      echo '<span class="current">';
      the_title();
      echo '</span>';
  
    } elseif ( is_search() ) {
      echo '<span class="current">' . esc_attr( 'Search for ', 'janelove' ) . get_search_query() . '' . $currentAfter;
  
    } elseif ( is_tag() ) {
      echo '<span class="current">' . esc_attr( 'Posts tagged ', 'janelove' );
      single_tag_title();
      echo '' . '</span>';
  
    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo '<span class="current">' . esc_attr( 'Post by ', 'janelove' ) . $userdata->display_name . $currentAfter;
  
    } elseif ( is_404() ) {
      echo '<span class="current">' . esc_attr( 'Error 404', 'janelove' ) . $currentAfter;
    } else {

      $home = esc_url(home_url( '/' ));
      echo '<a href="' . $home . '">' . $name . '</a> ';

    }
  
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo esc_attr('Page ','janelove') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
    echo '</div>';
  
}

function janelove_post_title(){
        global $post;
        $id = $post->ID;
        return'<h2 class="entry_title"><a href="'.get_the_permalink($id).'">'.get_the_title($id).'</a></h2>';
}

function janelove_author(){

        return'<span class="post-meta-author leffect-1">
            <span class="meta-author-name"><i class="dashicons dashicons-admin-users"></i> '.get_the_author_posts_link().'</span>
        </span>';
}

function janelove_tags(){

    $post_tags = get_the_tags();
    $separator = ', ';
    $output = '';
    if (!empty($post_tags)) {
        foreach ($post_tags as $tag) {
            $output .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . $separator;
        }
        return '<span class="nio-tag leffect-1"><i class="fas fa-tags"></i> '.trim($output, $separator).'</span>';
    }
}


function janelove_get_excerpt($post=false) {
    if (!$post) { 
        global $post;
    }
    if (!$post) { return ''; }
    $excerpt = '';
    $blocks = parse_blocks($post->post_content);
    if (count($blocks) == 1 && $blocks[0]['blockName'] == null) {  // Non-Gutenberg posts
        $excerpt = wp_trim_words( strip_tags(get_the_excerpt($post->ID)), 15, '' );
    } else {
        foreach ($blocks as $block) {
            if ($block['blockName'] == 'core/paragraph') {
                $excerpt = wp_trim_words( strip_tags($block['innerHTML']), 15, '' );
                break;
            }
        }
    }
    return "<div class='excerpt'>$excerpt</div>";
}