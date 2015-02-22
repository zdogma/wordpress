<?php //固定ページ用のパンくずリスト ?>
<?php if ( is_page_breadcrumb_visible() && !is_front_page() ): //個別ページでパンくずリストを表示する場合?>
<div id="breadcrumb" class="breadcrumb-page">
  <?php $count = 0;
  $per_ids = array_reverse(get_post_ancestors($post->ID)); ?>
  <div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><i class="fa fa-home fa-fw"></i><a href="<?php echo home_url(); ?>" itemprop="url"><span itemprop="title">ホーム</span></a><?php echo (count($per_ids) == 0) ? '' : '<span class="sp"><i class="fa fa-angle-right"></i></span>' ?></div>
  <?php foreach ( $per_ids as $par_id ){
    $count += 1;?>
    <div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><i class="fa fa-file-o fa-fw"></i><a href="<?php echo get_page_link( $par_id );?>" itemprop="url"><span itemprop="title"><?php echo get_page($par_id)->post_title; ?></span></a><?php echo (count($per_ids) == $count) ? '' : '<span class="sp"><i class="fa fa-angle-right"></i></span>' ?></div>
  <?php } ?>
</div><!-- /#breadcrumb -->
<?php endif; ?>