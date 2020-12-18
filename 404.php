<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */
 
get_header(); ?>

    <section class="xld-unit-test jlclearfix">
        <div class="container">
            <div class="row">
                <div class="blog-wrap">
                    <div class="blog-grids">

						<section class="error-404 not-found">
			              <div class="error">
			                  <img src="<?php echo esc_attr(get_template_directory_uri() . '/assets/img/404.png'); ?>" alt="<?php esc_html_e( '404', 'janelove' ); ?>">
			              </div>				
							<header>
								<h1><?php esc_html_e( 'Sorry the page you are looking does not exist', 'janelove' ); ?></h1>
							</header><!-- .page-header -->

							<div class="widget_search">
							  <?php the_widget( 'WP_Widget_Search' ); ?>
						    </div>
						</section><!-- .error-404 -->

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
