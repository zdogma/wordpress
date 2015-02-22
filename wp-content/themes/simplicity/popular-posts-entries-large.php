<?php //PVを元にした人気記事 ?>

<?php //グローバル変数の呼び出し
global $g_widget_mode;//ウィジェットモード（全て表示するか、カテゴリ別に表示するか）
global $g_entry_count;//エントリー数
global $g_entry_type;//表示タイプ
global $g_is_pages_include; //固定ページの表示
global $g_is_views_visible;//閲覧数を表示するかどうか
global $g_range;//集計期間
global $g_widget_item;//このテンプレートを利用するウイジェットアイテム
?>
<div class="popular-entrys popular-entrys-large<?php echo ($g_entry_type == 'large_thumb_on' ? ' popular-entrys-large-on' : ''); ?>">
<?php
//「Simplicity同カテゴリーの人気エントリー」ウイジェットを使用している時だけカテゴリを絞る
$now_id = null;
$post_type = $g_is_pages_include ? null : 'post_type="post"&';
if ($g_widget_item == 'SimplicityPopularPostsCategoryWidgetItem' &&
    $g_widget_mode == 'category')://ウィジェットモードが「カテゴリ別表示」のとき
  if ( is_single() ) {//投稿ページでは全カテゴリー取得
    $categories = get_the_category();
    $category_IDs = array();
    foreach($categories as $category):
      array_push( $category_IDs, $category -> cat_ID);
    endforeach ;
    $now_id = implode(",", $category_IDs);
  } elseif ( is_category() ) {//カテゴリページではトップカテゴリーのみ取得
    $categories = get_the_category();
    $cat_now = $categories[0];
    $now_id = $cat_now->cat_ID;
  }
endif;

if ( is_sidebar_width_336() ) {
  $thumbnail_width = 336;
  $thumbnail_height = 189;
} else {
  $thumbnail_width = 300;
  $thumbnail_height = 169;
}

//Wordpress Popular Postsがインストールされているとき
if (function_exists('wpp_get_mostpopular')):
  $args = '
  limit='.$g_entry_count.'&
  range='.$g_range.'&
  order_by=views&
  thumbnail_width='.$thumbnail_width.'&
  thumbnail_height='.$thumbnail_height.'&
  cat="'.$now_id.'"&
  wpp_start=""&
  wpp_end=""&'.
  $post_type.
  'post_start=""&
  post_end=""&
  stats_comments=0&
  stats_views='.($g_is_views_visible ? 1 : 0).'';
  wpp_get_mostpopular($args);
endif; ?>
</div>
<div class="clear"></div>