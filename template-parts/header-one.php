<header class="check-header">
  <div class="khb_nav_row">
      <div class="khb_nav_left khb_nav_normal">
        <?php janelove_logo();?>
      </div>
      <div class="khb_nav_right khb_nav_grow">
        <div class="khb_nav_alignright">

            <?php
                wp_nav_menu( array(
                    'container' => false,
                    'theme_location' => 'primary',
                    'fallback_cb'=> 'janelove_no_main_nav',
                    'items_wrap' => '<ul class="khb-navbox">%3$s</ul>',
                ));          
            ?> 
            <i class="khbtap dashicons dashicons-menu"></i>
        </div>

      </div>
  </div>
</header>

<div class="khb-mobile">
  <i class="fa fa-arrow-right menu-close"></i>
  <div class="sidebar">
      <?php
          wp_nav_menu( array(
              'container' => false,
              'theme_location' => 'primary',
              'fallback_cb'=> 'janelove_no_main_nav',
              'items_wrap' => '<ul class="khb-mobilenav">%3$s</ul>',
          ));         
      ?> 
  </div>
</div>
<div class="click-capture"></div>