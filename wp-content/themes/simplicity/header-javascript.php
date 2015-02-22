<?php //Simplicityで使用するJavaScript関係のことをまとめて書く?>
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); //コメント返信時のフォームの移動?>
<?php
///////////////////////////////////
//Simplicity内で使用するJavaScript関数をまとめて定義する外部ファイルを呼び出す（javascript.js）
///////////////////////////////////
wp_enqueue_script( "simplicity_js", get_template_directory_uri() . "/javascript.js", array( "jquery" ) );
?>
<?php
///////////////////////////////////
//子テーマディレクトリ内のjavascript.jsファイルの存在を確認。あれば呼び出す
///////////////////////////////////
if (file_exists_in_child_theme('javascript.js')):
  wp_enqueue_script( "simplicity_child_js", get_stylesheet_directory_uri() . "/javascript.js", array( "simplicity_js" ) );
endif; //子テーマJavaScript終了
?>
<?php
///////////////////////////////////
//Evernoteに関する記述
///////////////////////////////////
if ( is_singular() && is_evernote_btn_visible() ): //固定ページか投稿ページのときEvernoteスクリプトを呼び出す ?>
<script defer src="<?php echo get_template_directory_uri(); ?>/js/noteit.js"></script>
<?php endif; //Evernote終了?>
<?php
///////////////////////////////////
//Masonryに関する記述（タイル状リスト）
///////////////////////////////////
if ( !is_singular() && //投稿ページや固定ページ以外のとき
  is_list_style_tile_thumb_cards() && //タイル状リストのとき
  have_posts() ): //投稿があるとき?>
<?php wp_enqueue_script('jquery-masonry'); //Masonryライブラリの呼び出し ?>
<?php //Masonry関数の呼び出し ?>
<?php wp_localize_script('simplicity_js', 'do_masonry', array('enable' => true)); ?>
<?php endif; //Masonry終了?>
<?php
///////////////////////////////////
//独自シェアボタンに関する記述
///////////////////////////////////
if ( is_singular() && ( is_simplicity_share_button() || wp_is_mobile() ) )://固定ページか投稿ページで独自シェアボタンがオンのとき、モバイルの時は必ず表示 ?>
<?php if ( is_share_button_type_twitter() ): ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-twitter-type.css">
<?php endif; ?>
<?php
wp_localize_script('simplicity_js', 'social_count_config', array(
  'permalink' => get_permalink(),
  'rss2_url' => get_bloginfo("rss2_url")
));
?>
<?php endif; //独自シェアボタン終了?>
<?php
///////////////////////////////////
//Pinterestボタンの呼び出し
///////////////////////////////////
if ( is_pinterest_btn_visible() && is_singular() ): ?>
<!-- 画像にPinterestボタン -->
<script type="text/javascript" async defer data-pin-height="28" data-pin-hover="true" src="//assets.pinterest.com/js/pinit.js"></script>
<?php endif; ?>
<?php
///////////////////////////////////
//ローカルのテスト環境だった場合はダミー画像生成スクリプトを呼び出す（開発用）
///////////////////////////////////
if ( is_local_test() ): ?>
<!-- テスト環境用のダミー画像呼び出し -->
<script src="<?php echo get_template_directory_uri(); ?>/js/holder.js"></script>
<?php endif; ?>
<?php
///////////////////////////////////
//コメント欄の高さを文章量に応じて自動調整する
///////////////////////////////////
if ( is_single() && is_comment_textarea_expand() ): ?>
<!-- コメント欄の高さを文章量に応じて自動調整 -->
<?php
wp_enqueue_script( "expanding", get_template_directory_uri() . "/js/expanding.js", array( "jquery" ) );
?>
<?php endif; ?>
<?php
///////////////////////////////////
//画像の遅延読み込み（Lazy Load）の設定
///////////////////////////////////
if ( is_singular() && is_lazy_load_enable() ): ?>
<!-- 画像の遅延読み込み（Lazy Load）の設定 -->
<!-- Lazy Load jQueryプラグインの呼び出し -->
<?php
wp_enqueue_script( "jquery-lazyload", get_template_directory_uri() . "/js/jquery.lazyload.min.js", array( "jquery" ) );
?>
<!-- Lazy Loadプラグインの実行 -->
<?php
  $lazyload_config = array('threshold' => get_lazy_load_threshold());
  if (is_lazy_load_effect_enable()) {
    $lazyload_config['effect'] = 'fadeIn';
  }

  wp_localize_script( 'simplicity_js', 'lazyload_config', $lazyload_config );
 ?>
<?php endif; ?>
<?php
///////////////////////////////////
//画像の画面内拡大表示（Lightbox）の設定
///////////////////////////////////
if ( is_lightbox_enable() && is_singular() ): //投稿・固定ページでしか利用しないため、その他では呼び出さない?>
<!-- Lightboxプラグインの実行 -->
<link href="<?php echo get_template_directory_uri(); ?>/lightbox/css/lightbox.css" type="text/css" rel="stylesheet" media="all" />
<?php
wp_enqueue_script( "lightbox", get_template_directory_uri() . "/lightbox/js/lightbox.js", array( "jquery" ) );
?>
<?php endif; ?>