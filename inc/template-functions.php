<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 */

function janelove_comment_nav()
{
    // Are there comments to navigate through?
    if (get_comment_pages_count() > 1 && get_option('page_comments')):
    ?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'janelove');?></h2>
		<div class="nav-links">
			<?php
if ($prev_link = get_previous_comments_link(esc_attr_('Older Comments', 'janelove'))):
        printf('<div class="nav-previous">%s</div>', $prev_link);
    endif;

    if ($next_link = get_next_comments_link(esc_attr_('Newer Comments', 'janelove'))):
        printf('<div class="nav-next">%s</div>', $next_link);
    endif;
    ?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
endif;
}

/**
 * janelove comment callback
 * @param  string $comment 
 * @param  array $args 
 * @param  int $depth
 * @return string
 */

function janelove_comment_callback($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr($tag); ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent')?> id="comment-<?php comment_ID()?>">
    <?php if ('div' != $args['style']): ?>
        <div id="div-comment-<?php comment_ID()?>" class="article">
    <?php endif;?>

        <div class="author-pic"><?php if ($args['avatar_size'] != 0) {
        echo get_avatar($comment, 64);
    }
    ?></div>
        <div class="details">
 		<div class="author-meta">
	        <?php printf(__('<div class="name"><h4>%s</h4></div>', 'janelove'), get_comment_author_link());?>
	        <div class="date"><span><?php printf(__('%1$s', 'janelove'), get_comment_date());?></span></div>
		</div>
		    <?php if ($comment->comment_approved == '0'): ?>
		         <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'janelove');?></em>
		    <?php endif;?>

	    	<?php comment_text();?>
		    <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])));?>


	</div>

    <?php if ('div' != $args['style']): ?>
    </div>
    <?php endif;?>
    <?php
}

/**
 * return default logo if exists
 * @return string
 */

function janelove_logo()
{
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = wp_get_attachment_image( $custom_logo_id , 'full' );
	if ( $custom_logo_id ) {
        echo '<a class="site-logo" href=' . esc_url(home_url('/')) . ' rel="home">' . $logo . '</a>';
	} else {
		echo '<h1 class="theme-logo"><a class="site-logo" href=' . esc_url(home_url('/')) . ' rel="home">' . get_bloginfo('name') . '</a></h1>';
	}
    
}

/**
 * output all post tags
 * @return string
 */

function janelove_post_tag()
{

    if ('post' == get_post_type()) {

        $posttags  = get_the_tags();
        $separator = ' ';
        $output    = '';
        if ($posttags) {

            foreach ($posttags as $tag) {
                $output .= '<span><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></span>' . $separator;
            }

            $tags = trim($output, $separator);
            echo '<div class="tags-links leffect-1"><span class="tag-label">' . esc_attr__('Tags: ', 'janelove') . '</span>' . $tags . '</div>';
        }
    }
}

/**
 * single post category, only used in single post
 * @param  boolean $default 
 * @return string
 */

function janelove_single_category($default = true)
{

    if ('post' == get_post_type()) {
        $categories = get_the_category();

        $separator = '';

        $output = '';
        if ($categories) {
            foreach ($categories as $category) {

                $output .= '<a class="cat-links" href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;

            }
            $cat = trim($output, $separator);
            echo '<span class="post-cat leffect-1"><i class="dashicons dashicons-open-folder"></i>' . $cat . '</span>';
        }
    }

}

/*Filter searchform button markup*/
add_filter('get_search_form', 'janelove_modify_search_form');

function janelove_modify_search_form($form)
{
    $form = '<form class="password-form" role="search" method="get" id="search-form" action="' . esc_url(home_url('/')) . '" >
    <div><label class="screen-reader-text" for="s">' . esc_attr__('Search for:', 'janelove') . '</label>
    <input type="text" placeholder="' . esc_attr__('Type and hit enter', 'janelove') . '" class="form-control" value="' . get_search_query() . '" name="s" id="s" />
    <button type="submit"><i class="dashicons dashicons-search"></i></button>
    </div>
    </form>';

    return $form;
}

/*Filter password form markup*/
add_filter('the_password_form', 'janelove_password_form');
function janelove_password_form()
{
    global $post;
    $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $o     = '<form class="postpass-form" action="' .
    esc_url(site_url('wp-login.php?action=postpass',
        'login_post')) .
    '" method="post">
	 ' . esc_attr__('This post is password protected and this is what I want to say about that. To view it please enter your password below:', 'janelove') . '
	 <input class="post-pass" name="post_password" placeholder="' . esc_attr__('Type and hit enter', 'janelove') . '" id="' . $label . '" type="password" />
	 </form>
	 ';
    return $o;
}

/*No main nav fallback*/
function janelove_no_main_nav($args)
{
    if (!current_user_can('manage_options')) {
        return;
    }
    extract($args);

    $link = $link_before . '<a href="' . esc_url(admin_url('nav-menus.php')) . '">' . $before . esc_attr__('Please assign PRIMARY menu location', 'janelove') . $after . '</a>' . $link_after;

    if (false !== stripos($items_wrap, '<ul') or false !== stripos($items_wrap, '<ol')) {
        $link = "<li>$link</li>";
    }

    $output = sprintf($items_wrap, $menu_id, $menu_class, $link);
    if (!empty($container)) {
        $output = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ($echo) {
        echo '' . $output . '';
    }

    return $output;
}

function new_excerpt_more($more)
{
    return '';
}

add_filter('excerpt_more', 'new_excerpt_more');

function the_excerpt_more_link($excerpt)
{
    $post = get_post();
    $excerpt .= '<a class="read-more" href="' . get_permalink($post->ID) . '">' . esc_attr__('Read More', 'janelove') . '</a>';
    return $excerpt;
}
add_filter('the_excerpt', 'the_excerpt_more_link');
