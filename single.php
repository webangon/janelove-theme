<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */

get_header();
?>
 
    <section class="blog-single-section xld-unit-test">
        <div class="container">
            <div class="row">
                <div class="blog-wrap">
                    <div class="blog-details-content">

						<?php if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/singlecontent');

							endwhile;				

						endif; ?>

                    </div>
                </div>
                <div class="xld-sidebar">
                    <?php get_template_part( 'layouts/sidebar', 'left' ); ?>                        
                </div>
            </div>
        </div> <!-- end container -->
    </section>

<?php get_footer();
