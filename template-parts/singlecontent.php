<?php 
    $arg = [
        'cat' => '<span class="niotitle">'.esc_html__('Category','janelove').'</span>',
        'tag' => '<span  class="niotitle">'.esc_html__('Tag','janelove').'</span>',
        'author' => '<span  class="niotitle">'.esc_html__('Author','janelove').'</span>',
        'year' => '<span  class="niotitle">'.esc_html__('Year','janelove').'</span>',
        'notfound' => '<span  class="niotitle">'.esc_html__('Not found','janelove').'</span>',
        'search' => '<span  class="niotitle">'.esc_html__('Search for','janelove').'</span>',  
        'marchive' => '<span  class="niotitle">'.esc_html__('Monthly archive','janelove').'</span>',  
        'yarchive' => '<span  class="niotitle">'.esc_html__('Yearly archive','janelove').'</span>',  
    ];
?>

<section id="breadcrumb" class="breadcrumb_section background-style relative-position unit-bread">
  <div class="background-overlay"></div>
  <div class="container">
    <div class="breadcrumb_list headline ul-li">
      <h2 class="breadcrumb_title"><?php  echo janelove_single_title($arg); ?></h2>
      <?php janelove_breadcumb();?>
    </div>
  </div> 
</section>

<div id="post-<?php the_ID(); ?>" <?php post_class('singlegrid blog-grids'); ?>>    
	<?php if ( has_post_thumbnail() ) : ?>	
        <div class="entry-media">			    
			<?php the_post_thumbnail('full'); ?>	
        </div>    					
	<?php endif; ?>
    
    <div class="entry-title-meta">
    	<?php the_title( '<h2>', '</h2>') ?>
        <div class="meta-info">
            <?php janelove_single_category();?>
            <?php janelove_post_author();?>
            <?php janelove_post_date();?>
        </div>
    </div>
    <div class="entry-body">
        <?php the_content();?>
        <?php wp_link_pages();?>
        
    </div> 
      <?php janelove_post_tag();?>  
	  <?php the_post_navigation( array(
        'next_text' => '<span class="next-post">' . esc_attr__( 'Next post', 'janelove' ) . '</span> ' .
            '<span class="post-title">%title</span>',
        'prev_text' => '<span class="previous-post">' .esc_attr__( 'Previous post', 'janelove' ) . '</span> ' .
            '<span class="post-title">%title</span>',
	  ) );?>
	  <?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	  ?>    
</div>