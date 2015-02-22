<?php
////////////////////////////////
//投稿日と更新日のテンプレート
////////////////////////////////
$human_time_diff = '';
if ( is_human_time_diff_visible() )//時間差を表示するか
  $human_time_diff = '<span class="post-human-def-diff">（<span class="post-human-date-diff-in">'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'前</span>）</span>';
if ( is_seo_date_update() && //検索エンジンに更新日を伝える場合
      get_mtime('c') ): //かつ更新日がある場合?>
    <?php if ( is_create_date_visible() ): //投稿日を表示する場合?>
      <span class="post-date"><i class="fa fa-clock-o fa-fw"></i><?php the_time('Y/n/j') ;?><?php echo $human_time_diff; ?></span>
    <?php endif; //is_create_date_visible?>
    <?php if ( is_update_date_visible() ): //更新日を表示する場合?>
      <span class="post-update"><i class="fa fa-history fa-fw"></i><time class="entry-date date updated" datetime="<?php echo get_the_time('c') ;?>"><?php if ($mtime = get_mtime('Y/n/j')) echo $mtime; ?></time></span>
    <?php endif; //is_update_date_visible?>
<?php else: //検索エンジンに投稿日を伝える場合?>
  <?php if ( is_create_date_visible() ): //投稿日を表示する場合?>
    <span class="post-date"><i class="fa fa-clock-o fa-fw"></i><time class="entry-date date updated" datetime="<?php echo get_the_time('c') ;?>"><?php the_time('Y/n/j') ;?></time><?php echo $human_time_diff; ?></span>
  <?php endif; //is_create_date_visible?>
  <?php if ( is_update_date_visible() && //更新日を表示する場合
             get_mtime('c') ) : //更新日があるどき?>
    <span class="post-update"><i class="fa fa-history fa-fw"></i><?php if ($mtime = get_mtime('Y/n/j')) echo $mtime; ?></span>
  <?php endif; //is_update_date_visible?>
<?php endif; ?>
