<!-- sidebar -->
<aside>
<div id="sidebar">
  <?php get_template_part('ad-sidebar');//サイドバートップ広告の呼び出し ?>

  <div id="sidebar-widget">
  <!-- ウイジェット -->
  <?php if ( is_active_sidebar( 'sidebar-1' ) ) :
    dynamic_sidebar( 'sidebar-1' );
  endif;?>
  </div>

  <?php if (is_active_sidebar('sidebar-scroll') && !wp_is_mobile() ): ?>
  <!--スクロール追従領域-->
  <div id="sidebar-scroll">
    <?php dynamic_sidebar('sidebar-scroll');?>
  </div>
  <?php endif; ?>

</div></aside><!-- /#sidebar -->