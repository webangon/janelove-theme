<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
 
get_header(); ?>

    <section class="xld-unit-test jlclearfix">
        <div class="container">
            <div class="row">
                <div class="blog-wrap">
                    <div class="blog-grids">

						<?php 
							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'page' );
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;	
							endwhile;				

						 ?>

                    </div>
                </div>
                <div class="xld-sidebar">
                    <?php get_template_part( 'layouts/sidebar', 'left' ); ?>                        
                </div>
            </div>
        </div> <!-- end container -->
    </section>

<?php
get_footer();
