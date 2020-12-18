<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
?>  

<div id="post-<?php the_ID(); ?>" <?php post_class('xldarchives'); ?>>  

    <div class="blog-img-text">
        <div class="blog-img">
            <?php if ( has_post_thumbnail()) {
                the_post_thumbnail('full');                    
             } else { 

             } ?>                         

            <div class="blog-text">
                <div class="blog-title headline">
                    <?php echo janelove_post_title();?>
                </div>
                <div class="blog-meta ul-li">
                    <?php echo janelove_single_category();?>
                    <?php janelove_post_date();?>
                    <?php echo janelove_author();?>
                </div>
            </div>
        </div>
    </div>

</div>




