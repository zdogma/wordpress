<?php
include 'lib/customizer.php';//テーマカスタマイザー関係の関数
include 'lib/widget.php';//ウイジェット関係の関数
include 'lib/ad.php';    //広告関係の関数
include 'lib/sns.php';  //SNS関係の関数
include 'lib/admin.php';  //管理画面用の関数
include 'lib/utility.php';  //自作のユーティリティー関数
require_once(ABSPATH . 'wp-admin/includes/file.php');//WP_Filesystemの使用

// アイキャッチ画像を有効化
add_theme_support('post-thumbnails');
//サムネイルサイズ
//add_image_size('thumb75',75,75,true);
add_image_size('thumb100',100,100,true);
add_image_size('thumb150',150,150,true);
add_image_size('thumb320',320,180,true);
////サムネイルリストカードのとき or タイル状リストのとき
//if ( is_list_style_thumb_cards() || is_list_style_tile_thumb_cards() ) {
//  add_image_size('thumb320',320,180,true);
//}
//画像の縦横比を保存したタイル状リストのとき
if ( is_list_style_tile_thumb_cards_raw() ) {
  add_image_size('thumb320_raw',320,0,false);
}

//コンテンツの幅の指定
if ( ! isset( $content_width ) ) $content_width = 680;

////カテゴリー説明文からPタグを除去
//remove_filter('term_description', 'wpautop');
//カテゴリー説明文でHTMLタグを使う
remove_filter( 'pre_term_description', 'wp_filter_kses' );

//ビジュアルエディターとテーマ表示のスタイルを合わせる
add_editor_style();

// RSS2 の feed リンクを出力
add_theme_support( 'automatic-feed-links' );

// カスタムメニューを有効化
add_theme_support( 'menus' );

// カスタムメニューの「場所」を設定
register_nav_menu( 'header-navi', 'ヘッダーのナビゲーション' );

// サイドバーウィジットを有効化
register_sidebars(1,
  array(
  'name' => 'サイドバーウイジェット',
  'id' => 'sidebar-1',
  'description' => 'サイドバーのウィジットエリアです。',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title'  => '<h4 class="widgettitle">',
  'after_title'   => '</h4>',
));

register_sidebars(1,
  array(
  'name'=>'スクロール追従領域',
  'id' => 'sidebar-scroll',
  'description' => 'サイドバーで下にスクロールすると追いかけてくるエリアです。※モバイルでは表示されません。（ここにGoogle AdSenseを貼るのはポリシー違反です。）',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',
));

register_sidebars(1,
  array(
  'name'=>'広告 336x280',
  'id' => 'adsense-336',
  'description' => '336×280pxの広告を入力してください。',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<div class="widget-ad">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name'=>'広告 300x250',
  'id' => 'adsense-300',
  'description' => '300×250pxの広告を入力してください。',
  'before_widget' => '',
  'after_widget' => '',
  'before_title' => '<div class="widget-ad">',
  'after_title' => '</div>',
));

if ( is_ads_performance_visible() ):
  if ( !is_ads_custum_ad_space() ) {//ビッグバナーのとき
    $adw_name = '広告 728×90';
    $adw_desc = '広告が2つしか表示されていないPC表示ページのトップにビッグバナーを表示します。728×90のビッグバナー推奨です。完全レスポンシブのときは設定しても表示されません。（デフォルト状態をなるべくシンプルにするためカスタマイザーから設定しないと、このウイジェット設定は表示されません。）';
  } else {//カスタム広告の時
    $adw_name = '広告 custum 680×150など';
    $adw_desc = '広告が2つしか表示されていないPC表示ページのトップにカスタムサイズ広告を表示します。680×150など推奨です。完全レスポンシブのときは設定しても表示されません。（デフォルト状態をなるべくシンプルにするためカスタマイザーから設定しないと、このウイジェット設定は表示されません。）';
  }
  register_sidebars(1,
    array(
    'name'=>$adw_name,
    'id' => 'adsense-728',
    'description' => $adw_desc,
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="widget-ad">',
    'after_title' => '</div>',
  ));

  register_sidebars(1,
    array(
    'name'=>'広告 320x100',
    'id' => 'adsense-320',
    'description' => '広告が2つしか表示されていないモバイルページのトップにラージモバイルバナーを表示します。320×100のラージモバイルバナー推奨です。完全レスポンシブのときは設定しても表示されません。（デフォルト状態をなるべくシンプルにするためカスタマイザーから設定しないと、このウイジェット設定は表示されません。）',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<div class="widget-ad">',
    'after_title' => '</div>',
  ));
endif;

//if ( is_responsive_enable() ):
//  register_sidebars(1,
//    array(
//    'name'=>'広告 レスポンシブ',
//    'id' => 'adsense-responsive',
//    'description' => 'レスポンシブ広告設置用のウイジェットです。',
//    'before_widget' => '',
//    'after_widget' => '',
//    'before_title' => '<div class="widget-ad">',
//    'after_title' => '</div>',
//  ));
//endif;

register_sidebars(1,
  array(
  'name'=>'投稿本文上',
  'id' => 'widget-over-article',
  'description' => '投稿本文上に表示されるウイジェット。設定しないと表示されません。',
  'before_widget' => '<div class="widget-over-article">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-article-title">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name'=>'投稿本文下',
  'id' => 'widget-under-article',
  'description' => '投稿本文下に表示されるウイジェット。設定しないと表示されません。',
  'before_widget' => '<div class="widget-under-article">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-article-title">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name'=>'投稿SNSボタン上',
  'id' => 'widget-over-sns-buttons',
  'description' => '投稿のメインカラムの一番下となるSNSボタンの上に表示されるウイジェット。広告を表示している場合は、広告の下になります。設定しないと表示されません。',
  'before_widget' => '<div class="widget-over-sns-buttons">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-over-sns-buttons-title">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name'=>'投稿SNSボタン下',
  'id' => 'widget-under-sns-buttons',
  'description' => '投稿のメインカラムの一番下となるSNSボタンの下に表示されるウイジェット。設定しないと表示されません。',
  'before_widget' => '<div class="widget-under-sns-buttons">',
  'after_widget' => '</div>',
  'before_title' => '<div class="widget-under-sns-buttons-title">',
  'after_title' => '</div>',
));

register_sidebars(1,
  array(
  'name'=>'フッター左',
  'id' => 'footer-left',
  'description' => 'フッター左側のウィジットエリアです。',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',
));

register_sidebars(1,
  array(
  'id' => 'footer-center',
  'name'=>'フッター中',
  'description' => 'フッター中間のウィジットエリアです。',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',
));

register_sidebars(1,
  array(
  'name'=>'フッター右',
  'id' => 'footer-right',
  'description' => 'フッター右側フッター中のウィジットエリアです。',
  'before_widget' => '<div id="%1$s" class="widget %2$s">',
  'after_widget' => '</div>',
  'before_title' => '<h4>',
  'after_title' => '</h4>',
));

//カスタムヘッダー
$custom_header_defaults = array(
 'random-default' => false,
 'width' => (is_sidebar_width_336() ? 1106 : 1070),//サイドバーの幅によって変更
 'height' => intval(get_header_height()),
 'flex-height' => false,
 'flex-width' => false,
 'default-text-color' => '',
 'header-text' => false,
 'uploads' => true,
);
add_theme_support( 'custom-header', $custom_header_defaults );

//カスタム背景
$custom_background_defaults = array(
        'default-color' => 'ffffff',
);
add_theme_support( 'custom-background', $custom_background_defaults );

//カスタマイズした値をCSSに反映させる
function celtisone_customize_css(){
  get_template_part('css-custom');
}
add_action( 'wp_head', 'celtisone_customize_css');

/*
  get_the_modified_time()の結果がget_the_time()より古い場合はget_the_time()を返す。
  同じ場合はnullをかえす。
  それ以外はget_the_modified_time()をかえす。
*/
function get_mtime($format) {
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if ($ptime > $mtime) {
        return get_the_time($format);
    } elseif ($ptime === $mtime) {
        return null;
    } else {
        return get_the_modified_time($format);
    }
}

// 抜粋の長さを変更する
function custom_excerpt_length() {
  return intval(get_excerpt_length());
}
add_filter('excerpt_length', 'custom_excerpt_length');

// 文末文字を変更する
function custom_excerpt_more($more) {
  return get_excerpt_more();
}
add_filter('excerpt_more', 'custom_excerpt_more');

//本文抜粋を取得する関数
//使用方法：http://nelog.jp/get_the_custom_excerpt
function get_the_custom_excerpt($content, $length, $is_card = false) {
  global $post;
  if ( is_wordpress_excerpt() && $post->post_excerpt ) {//Wordpress固有の抜粋文を使用するとき
    return  $post->post_excerpt;
  } else {//Simplicity固有の抜粋文を使用するとき
    $length = ($length ? $length : 70);//デフォルトの長さを指定する
    $content =  preg_replace('/<!--more-->.+/is',"",$content); //moreタグ以降削除
    $content =  strip_shortcodes($content);//ショートコード削除
    $content =  strip_tags($content);//タグの除去
    $content =  str_replace("&nbsp;","",$content);//特殊文字の削除（今回はスペースのみ）
    // $content =  preg_replace('/\s/iu',"",$content); //余分な空白を削除
    $over    =  intval(mb_strlen($content)) > intval($length);
    $content =  mb_substr($content,0,$length);//文字列を指定した長さで切り取る
    if ( get_excerpt_more() && $over ) {
      $content = $content.get_excerpt_more();
    }
    return $content;
  }
}

//外部ファイルのURLに付加されるver=を取り除く
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

//セルフピンバック禁止
function sp_no_self_ping( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'sp_no_self_ping' );

//ファビコンタグを表示
function the_favicon_tag(){
  if (is_favicon_enable()) {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_the_favicon_url().'" />'."\n";
  }
}

//アップルタッチアイコンを表示
function the_apple_touch_icon_tag(){
  if ( is_apple_touch_icon_enable() && wp_is_mobile() ) {
    if ( get_apple_touch_icon_url() ) {
      echo '<link rel="apple-touch-icon-precomposed" href="'.get_apple_touch_icon_url().'" />'."\n";
    } else {
      echo '<link rel="apple-touch-icon-precomposed" href="'.get_stylesheet_directory_uri().'/images/apple-touch-icon.png" />'."\n";
    }
  }
}

//ファビコン表示(フロント)
function blog_favicon() {
  the_favicon_tag();
}
add_action('wp_head', 'blog_favicon');

//ファビコン表示(管理画面)
function admin_favicon() {
  the_favicon_tag();
}
add_action('admin_head', 'admin_favicon');

//iframeのレスポンシブ対応
function wrap_iframe_in_div($the_content) {
  if ( is_singular() ) {
    //YouTube動画にラッパーを装着
    $the_content = preg_replace('/<iframe[^>]+?youtube\.com[^<]+?<\/iframe>/is', '<div class="video-container"><div class="video">${0}</div></div>', $the_content);
    //Instagram動画にラッパーを装着
    $the_content = preg_replace('/<iframe[^>]+?instagram\.com[^<]+?<\/iframe>/is', '<div class="instagram-container"><div class="instagram">${0}</div></div>', $the_content);
    //Facebook埋め込みにラッパーを装着
    //$the_content = preg_replace('/<iframe[^>]+?www\.facebook\.com[^<]+?<\/iframe>/is', '<div class="facebook-container"><div class="facebook">${0}</div></div>', $the_content);
  }
  return $the_content;
}
add_filter('the_content','wrap_iframe_in_div');

//サイト概要の取得
function get_the_description(){
  $o = get_sns_options();
  if ($o['ogp_description'] == 'meta') {
    global $post;//All in One SEO PackプラグインのDescriptionを取得
    $s = get_post_meta($post->ID, _aioseop_description, true);
  } else {
    $s = strip_shortcodes(get_the_excerpt());
    $s = mb_substr(str_replace(array("\r\n", "\r", "\n"), '', strip_tags($s)), 0, 100);
  }
  return $s;
}

//WordPress の投稿スラッグを自動的に生成する
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) &&
       ( $post_type == 'post' || $post_type == 'page') ) {//投稿もしくは固定ページのときのみ実行する
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
if ( !is_japanese_slug_enable()) {
  add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );
}



//feedlyの購読者数取得
function get_feedly_count(){
  $feed_url = rawurlencode( get_bloginfo( 'rss2_url' ) );
  $res = '0';
  $subscribers = wp_remote_get( "http://cloud.feedly.com/v3/feeds/feed%2F$feed_url" );
  if (!is_wp_error( $subscribers ) && $subscribers["response"]["code"] === 200) {
    $subscribers = json_decode( $subscribers['body'] );
    if ( $subscribers ) {
      $subscribers = $subscribers->subscribers;
      set_transient( 'feedly_subscribers', $subscribers, 60 * 60 * 12 );
      $res = ($subscribers ? $subscribers : '0');
    }
  }
  return $res;
}

//投稿ページ以外ではhentryクラスを削除する関数
function remove_hentry( $classes ) {
  if ( !is_single() ) {
    $classes = array_diff($classes, array('hentry'));
  }
  //これらのクラスが含まれたページではhentryを削除する
  $ng_classes = array('type-forum', 'type-topic');//ここに追加していく
  $is_include = false;
  foreach ($ng_classes as $ng_class) {
    //NGのクラス名が含まれていないか調べる
    if ( in_array($ng_class, $classes) ) {
      $is_include = true;
    }
  }
  //含まれていたらhentryを削除する
  if ($is_include) {
    $classes = array_diff($classes, array('hentry'));
  }
  return $classes;
}
add_filter('post_class', 'remove_hentry');

//はてな oEmbed対応
wp_oembed_add_provider('http://*', 'http://hatenablog.com/oembed');

//子テーマ内に指定のファイルがあるかどうか調べる
//ファイルがあった場合は子テーマ内ファイルのローカルパスを（true）
//ファイルが存在しなかった場合はfalseを返す
function file_exists_in_child_theme($filename){
  $dir = str_replace('\\','/', dirname(__FILE__));//置換しているのはWindows環境対策
  $theme_dir_uri = get_template_directory_uri();//親テーマのディレクトリURIを取得
  $child_theme_dir_uri = get_stylesheet_directory_uri();//子テーマのディレクトリURIの取得
  if ($theme_dir_uri == $child_theme_dir_uri) return;//同一の場合は子テーマが存在しないのでfalseを返す
  preg_match('/[^\/]+$/i', $theme_dir_uri, $m);//親テーマのディレクトリ名のみ取得
  $theme_dir_name = $m[0];
  preg_match('/[^\/]+$/i', $child_theme_dir_uri, $m);//子テーマのディレクトリ名のみ取得
  $child_theme_dir_name = $m[0];
  $path = preg_replace('/'.$theme_dir_name.'$/i', $child_theme_dir_name, $dir, 1);//文末のディレクトリ名だけ置換
  $path = $path.'/'.$filename;//ローカルパスの作成
  if ( file_exists($path) ) {
    return $path;//ファイルが存在していたらファイルのローカルパスを返す
  }
}

//スキンファイルリストの並べ替え用の関数
function skin_files_comp($a, $b) {
  //優先度（priority）で比較する
  if ($a['priority'] == $b['priority']) {
      return 0;
  }
  return ($a['priority'] < $b['priority']) ? -1 : 1;
}

//フォルダ以下のファイルをすべて取得
function get_file_list($dir) {
  $list = array();
  $files = scandir($dir);
  foreach($files as $file){
    if($file == '.' || $file == '..'){
      continue;
    } else if (is_file($dir . $file)){
      $list[] = $dir . $file;
    } else if( is_dir($dir . $file) ) {
        //$list[] = $dir;
      $list = array_merge($list, get_file_list($dir . $file . DIRECTORY_SEPARATOR));
    }
  }
  return $list;
}

//スキンとなるファイルの取得
function get_skin_files(){
  define( 'FS_METHOD', 'direct' );

  $parent = true;
  // 子テーマで 親skins の取得有無の設定
  if(function_exists('include_parent_skins')){
    $parent = include_parent_skins();
  }

  $files  = array();
  $child_files  = array();
  $parent_files  = array();

  //子skinsフォルダ内を検索
  $dir = get_stylesheet_directory().'/skins/';
  if(is_child_theme() && file_exists($dir)){
    $child_files = get_file_list($dir);
  }

  //親skinsフォルダ内を検索
  if ( $parent || !is_child_theme() ){//排除フラグが立っていないときと親テーマのときは取得
    $dir = get_template_directory().'/skins/';
    $parent_files = get_file_list($dir);
  }

  //親テーマと子テーマのファイル配列をマージ
  $files = array_merge( $child_files, $parent_files );

  //置換DIR
  $this_dir = str_replace('\\', '/', dirname(__FILE__));
  $this_ary = explode('/', $this_dir);
  array_pop($this_ary);
  $search = implode ('/',$this_ary);

  //置換URI
  $uri_dir = get_template_directory_uri();
  $uri_ary = explode('/', $uri_dir);
  array_pop($uri_ary);
  $replace = implode ('/',$uri_ary);

  $results = array();
  foreach($files as $pathname){
    $pathname = str_replace('\\', '/', $pathname);

    if (preg_match('/([a-zA-Z0-9\-_]+).style\.css$/i', $pathname, $matches)){//フォルダ名の正規表現が[a-zA-Z\-_]+のとき
      $dir_name = strip_tags($matches[1]);
      if ( WP_Filesystem() ) {//WP_Filesystemの初期化
        global $wp_filesystem;//$wp_filesystemオブジェクトの呼び出し
        $css = $wp_filesystem->get_contents($pathname);//$wp_filesystemオブジェクトのメソッドとして呼び出す
        if (preg_match('/Name: *(.+)/i', $css, $matches)) {//CSSファイルの中にName:の記述があるとき
          if (preg_match('/Priority: *(.+)/i', $css, $m)) {//優先度（順番）が設定されている場合は順番取得
            $priority = intval($m[1]);
          } else {
            $priority = 9999;
          }
          //返り値の設定
          $results[] = array(
            'name' => trim(strip_tags($matches[1])),
            'dir' => $dir_name,
            'priority' => $priority,
            'path' => str_replace($search, $replace , $pathname),
          );
        }
      }
    }
  }
  uasort($results, 'skin_files_comp');//スキンを優先度順に並び替え

  return $results;
}

//WP_Queryの引数を取得
function get_related_wp_query_args(){
  global $post;
  if ( is_related_entry_association_category() ) {
    //カテゴリ情報から関連記事をランダムに呼び出す
    $categories = get_the_category($post->ID);
    $category_IDs = array();
    foreach($categories as $category):
      array_push( $category_IDs, $category -> cat_ID);
    endforeach ;
    if ( empty($category_IDs) ) return;
    return $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> intval(get_related_entry_count()),
      'category__in' => $category_IDs,
      'orderby' => 'rand',
    );
  } else {
    //タグ情報から関連記事をランダムに呼び出す
    $tags = wp_get_post_tags($post->ID);
    $tag_IDs = array();
    foreach($tags as $tag):
      array_push( $tag_IDs, $tag -> term_id);
    endforeach ;
    if ( empty($tag_IDs) ) return;
    return $args = array(
      'post__not_in' => array($post -> ID),
      'posts_per_page'=> intval(get_related_entry_count()),
      'tag__in' => $tag_IDs,
      'orderby' => 'rand',
    );
  }
}

//本文中のURLをブログカードタグに変更する
function url_to_blog_card($the_content) {
  if ( is_singular() ) {//投稿ページもしくは固定ページのとき
    //1行にURLのみが期待されている行（URL）を全て$mに取得
    $res = preg_match_all('/^(<p>)?(<a.+?>)?https?:\/\/'.preg_quote(get_this_site_domain()).'\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+(<\/a>)?(<\/p>)?(<br ? \/>)?$/im', $the_content,$m);
    //マッチしたURL一つ一つをループしてカードを作成
    foreach ($m[0] as $match) {
      $url = strip_tags($match);//URL
      $id = url_to_postid( $url );//IDを取得（URLから投稿ID変換）
      if ( !$id ) continue;//IDを取得できない場合はループを飛ばす
      //global $post;
//      $posts = get_posts('id='.$id);
//      $post = $posts[0];
      //$post = get_post($id);//IDから投稿情報の取得

      global $post;
      $post_id = get_post($id);
      setup_postdata($post_id);
      $exce = $post_id->post_excerpt;

      $title = $post_id->post_title;//タイトルの取得
      $date = mysql2date('Y-m-d H:i', $post_id->post_date);//投稿日の取得
      if ( is_wordpress_excerpt() ) {//Wordpress固有の抜粋のとき
        $excerpt = $exce;
      } else {
        $excerpt = get_the_custom_excerpt($post_id->post_content, get_excerpt_length());//抜粋の取得
      }
      //新しいタブで開く場合
      $target = is_blog_card_target_blank() ? ' target="_blank"' : '';
      //はてブを表示する場合
      $hatebu = is_blog_card_hatena_visible() ? '<span class="blog-card-hatebu"><a href="http://b.hatena.ne.jp/entry/'.$url.'"'.$target.'><img src="http://b.hatena.ne.jp/entry/image/'.$url.'" alt="はてブ数" /></a></span>' : '';
      //サイトロゴを表示する場合
      $favicon_tag = '';
      if ( is_favicon_enable() && get_the_favicon_url() ) {//ファビコンが有効か確認
        $favicon_tag = '<span class="blog-card-favicon"><img src="'.get_the_favicon_url().'" class="blog-card-favicon-img" alt="ファビコン" /></span>';
      }
      $site_logo = is_blog_card_site_logo_visible() ? '<div class="blog-card-site">'.$favicon_tag.'<a href="'.get_bloginfo('url').'"'.$target.'>'.get_bloginfo('name').'</a></div>' : '';
      //サムネイルの取得（要100×100のサムネイル設定）
      $thumbnail = get_the_post_thumbnail($id, 'thumb100', array('style' => 'width:100px;height:100px;', 'class' => 'blog-card-thumb-image', alt => $title));
      if ( !$thumbnail ) {//サムネイルが存在しない場合
        $thumbnail = '<img src="'.get_template_directory_uri().'/images/no-image.png" style="width:100px;height:100px;" alt="'.$title.'" />';
      }
      //取得した情報からブログカードのHTMLタグを作成
      $tag = '<div class="blog-card"><div class="blog-card-thumbnail"><a href="'.$url.'" class="blog-card-thumbnail-link"'.$target.'>'.$thumbnail.'</a></div><div class="blog-card-content"><div class="blog-card-title"><a href="'.$url.'" class="blog-card-title-link"'.$target.'>'.$title.'</a></div><div class="blog-card-excerpt">'.$excerpt.'</div></div><div class="blog-card-footer">'.$site_logo.'<span class="blog-card-date">'.$date.'</span>'.$hatebu.'</div></div>';
      //本文中のURLをブログカードタグで置換
      $the_content = preg_replace('{'.preg_quote($match).'}', $tag , $the_content, 1);
    }
  }
  return $the_content;//置換後のコンテンツを返す
}
if ( is_blog_card_enable() ) {
  add_filter('the_content','url_to_blog_card');//本文表示をフック
}

//アップロード可能なファイルの設定
function my_upload_mimes($mimes = array()) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'my_upload_mimes');


//無記名のコメント投稿者名を変更する
function rename_anonymous_name() {
  global $comment;
  if( empty( $comment->comment_author ) ) {
    if( !empty( $comment->user_id ) ) {
      $user = get_userdata( $comment->user_id );
      $author = $user->user_login;
    } else {
      $author = get_theme_text_comment_anonymous_name();//匿名ユーザー名の取得
    }
  } else {
    $author = $comment->comment_author;
  }
  return $author;
}
add_filter( 'get_comment_author', 'rename_anonymous_name' );

//コメントリスト表示用カスタマイズコード
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-listCon">
        <div class="comment-info">
            <?php echo get_avatar( $comment, 48 );//アバター画像 ?>
            <?php printf(__('<span class="admin">名前:<cite class="fn comment-author">%s</a></cite> </span> '), get_comment_author_link()); //投稿者の設定 ?>
            <span class="comment-datetime">投稿日：<?php printf(__('%1$s at %2$s'), get_comment_date('Y/m/d(D)'),  get_comment_time('H:i:s')); //投稿日の設定 ?></span>
            <span class="comment-id">
            ID：<?php //IDっぽい文字列の表示（あくまでIDっぽいものです。）
                $ip01 = get_comment_author_IP(); //書き込んだユーザーのIPアドレスを取得
                $ip02 = get_comment_date(jn); //今日の日付
                $ip03 = ip2long($ip01); //IPアドレスの数値化
                $ip04 = ($ip02) * ($ip03); //ip02とip03を掛け合わせる
                echo mb_substr(sha1($ip04), 2, 9); //sha1でハッシュ化、頭から9文字まで出力
                //echo mb_substr(base64_encode($ip04), 2, 9); //base64でエンコード、頭から9文字まで出力
            ?>
            </span>
            <span class="comment-edit"><?php edit_comment_link(__('Edit'),'  ',''); //編集リンク ?></span>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
        <?php endif; ?>
        <div class="comment-text"></div>
        <?php comment_text(); //コメント本文 ?>

        <?php //返信機能は不要なので削除 ?>
    </div>
</div>
<?php
}

//投稿ページと固定ページを一覧リストに表示する
function post_page_all( $query ) {
  if ( is_admin() || ! $query->is_main_query() )
    return;

  if ( $query->is_home() ) {
    $query->set( 'post_type', array( 'post', 'page' ) );
    return;
  }
}
if ( is_page_include_in_list() ) {//固定ページをリスト表示する設定のとき
  add_action( 'pre_get_posts', 'post_page_all' );
}

//アップデートチェックの初期化
require 'theme-update-checker.php'; //ライブラリのパス
$example_update_checker = new ThemeUpdateChecker(
'simplicity', //テーマフォルダ名
'http://wp-simplicity.com/wp-content/themes/simplicity/update-info.json' //JSONファイルのURL
);

// functions.php(子テーマのでも可)に追加
function my_comment_form_defaults($defaults){
    $defaults['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="expanding" name="comment" cols="45" rows="8" aria-required="true" placeholder=""></textarea></p>';
    return $defaults;
}
add_filter( "comment_form_defaults", "my_comment_form_defaults");

//画像タグにLazyLoad用の属性などを追加
function add_image_tag_placeholders( $content ) {
    //プレビューやフィードモバイルなどで遅延させない
    if( is_feed() || is_preview() || wp_is_mobile() )
        return $content;

    //既に適用させているところは処理しない
    if ( false !== strpos( $content, 'data-original' ) )
        return $content;

    //画像正規表現で置換
    $content = preg_replace(
        '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#',//IMGタグの正規表現
        sprintf( '<img${1}src="%s" data-original="${2}"${3} data-lazy="true"><noscript><img${1}src="${2}"${3}></noscript>', get_template_directory_uri().'/images/1x1.trans.gif' ),//置換するIMGタグ（JavaScriptがオフのとき用のnoscriptタグも追加）
        $content );//投稿本文（置換する文章）

    return $content;
}
if ( is_lazy_load_enable() ) {//Lazy Loadが有効の場合のみ
  add_filter( 'the_content', 'add_image_tag_placeholders', 99 );
  //add_filter( 'post_thumbnail_html', 'add_image_tag_placeholders', 99 );
  add_filter( 'get_avatar', 'add_image_tag_placeholders', 11 );
}

//画像リンクのAタグをLightboxに対応するように付け替え
function add_lightbox_property( $content ) {
  //プレビューやフィードで表示しない
  if( is_feed() || is_preview() || wp_is_mobile() )
    return $content;

  //既に適用させているところは処理しない
   if ( false !== strpos( $content, 'data-lightbox="image-set"' ) )
    return $content;

  //Aタグを正規表現で置換
  $content = preg_replace(
    '/<a([^>]+?(\.jpg|\.png|\.gif)[\'\"][^>]*?)>\s*(<img[^>]+?>)\s*<\/a>/i',//Aタグの正規表現
    '<a${1} data-lightbox="image-set">${3}</a>',//置換する
    $content );//投稿本文（置換する文章）

  return $content;
}
if ( is_lightbox_enable() ) {
  add_filter( 'the_content', 'add_lightbox_property', 11 );
}

//thickboxを呼び出さない
function deregister_thickbox_files() {
  wp_dequeue_style( 'thickbox' );
  wp_dequeue_script( 'thickbox' );
}

add_action( 'wp_enqueue_scripts', 'deregister_thickbox_files' );

//Android Chromeで&nbsp;が・に表示される不具合対策
function replace_nbsp_to_ensp($the_content) {
  if ( is_singular() ) {
    $the_content = str_replace('&nbsp;', '&ensp;', $the_content);
  }
  return $the_content;
}
add_filter('the_content','replace_nbsp_to_ensp');

// //Twitterの絵文字対策のフィルタ
// function twitter_emoji_oembed_filter($html, $url, $attr, $post_ID) {
//   var_dump(htmlspecialchars($html));
//   return  preg_replace('/(?:
// (?:(?:\x0023|[\x0030-x0039])\x20E3)|
// (?:\x1F1E8\x1F1F3|\x1F1E9\x1F1EA|\x1F1EA\x1F1F8|\x1F1EB\x1F1F7|\x1F1EC\x1F1E7|\x1F1EE\x1F1F9|\x1F1EF\x1F1F5|\x1F1F0\x1F1F7|\x1F1F7\x1F1FA|\x1F1FA\x1F1F8)|
// (?:\x00A9|\x00AE|\x2002|\x2003|\x2005|\x203C|\x2049|\x2122|\x2139|[\x2194-x2199]|\x21A9|\x21AA|\x231A|\x231B|\x23E9|\x23EA|\x23EB|\x23EC|\x23F0|\x23F3|\x24C2|\x25AA|\x25AB|\x25B6|\x25C0|\x25FB|\x25FC|\x25FD|\x25FE|\x2600|\x2601|\x260E|\x2611|\x2614|\x2615|\x261D|\x263A|\x2648|\x2649|\x264A|\x264B|\x264C|\x264D|\x264E|\x264F|\x2650|\x2651|\x2652|\x2653|\x2660|\x2663|\x2665|\x2666|\x2668|\x267B|\x267F|\x2693|\x26A0|\x26A1|\x26AA|\x26AB|\x26BD|\x26BE|\x26C4|\x26C5|\x26CE|\x26D4|\x26EA|\x26F2|\x26F3|\x26F5|\x26FA|\x26FD|\x2702|\x2705|\x2708|\x2709|\x270A|\x270B|\x270C|\x270F|\x2712|\x2714|\x2716|\x2728|\x2733|\x2734|\x2744|\x2747|\x274C|\x274E|\x2753|\x2754|\x2755|\x2757|\x2764|\x2795|\x2796|\x2797|\x27A1|\x27B0|\x2934|\x2935|\x2B05|\x2B06|\x2B07|\x2B1B|\x2B1C|\x2B50|\x2B55|\x3030|\x303D|\x3297|\x3299|\x1F004|\x1F0CF|\x1F170|\x1F171|\x1F17E|\x1F17F|\x1F18E|[\x1F191-x1F19A]|\x1F201|\x1F202|\x1F21A|\x1F22F|[\x1F232-x1F23A]|\x1F250|\x1F251|[\x1F300-x1F30C]|\x1F30F|\x1F311|\x1F313|\x1F314|\x1F315|\x1F319|\x1F31B|\x1F31F|\x1F320|\x1F330|\x1F331|\x1F334|\x1F335|[\x1F337-x1F34F]|[\x1F351-x1F37B|[\x1F380-x1F393]|[\x1F3A0-x1F3C4]|\x1F3C6|\x1F3C8|\x1F3CA|[\x1F3E0-x1F3E3]|[\x1F3E5-x1F3F0]|\x1F40C|\x1F40D|\x1F40E|\x1F411|\x1F412|\x1F414|\x1F417|\x1F418|\x1F419|[\x1F41A-x1F429]|[\x1F42B-x1F43E]|\x1F440|[\x1F442-x1F464]|[\x1F466-x1F46B]|[\x1F46E-x1F4AC]|[\x1F4AE-x1F4B5]|[\x1F4B8-x1F4EB]|[\x1F4EE|[\x1F4F0-x1F4F7]|[\x1F4F9-x1F4FC]|\x1F503|[\x1F50A-x1F514]|[[\x1F516-x1F52B]|[\x1F52E-x1F53D]|[\x1F550-x1F55B]|[\x1F5FB-x1F5FF]|[\x1F601-x1F606]|[\x1F609-x1F60D]|\x1F60F|\x1F612|\x1F613|\x1F614|\x1F616|\x1F618|\x1F61A|\x1F61C|\x1F61D|\x1F61E|[\x1F620-x1F625]|[\x1F628-x1F62B]|\x1F62D|[\x1F630-x1F633]|\x1F635|[\x1F637-x1F640]|[\x1F645-x1F680]|\x1F683|\x1F684|\x1F685|\x1F687|\x1F689|\x1F68C|\x1F68F|\x1F691|\x1F692|\x1F693|\x1F695|\x1F697|\x1F699|\x1F69A|\x1F6A2|\x1F6A4|\x1F6A5|[\x1F6A7-x1F6AD]|\x1F6B2|\x1F6B6|\x1F6B9|[\x1F6BA-x1F6BE]|\x1F6C0)
// )/u', '', $html);
// }
// add_filter( 'embed_oembed_html', 'twitter_emoji_oembed_filter', 99, 4 );
