<!-- Twitter Card -->
<meta name="twitter:card" content="<?php echo get_twitter_card_type();//Twitterのカードタイプを取得 ?>">
<?php
if (is_singular()){//単一記事ページの場合
if(have_posts()): while(have_posts()): the_post();
  echo '<meta name="twitter:description" content="'.get_the_description().'">';echo "\n";//抜粋を表示
endwhile; endif;
  echo '<meta name="twitter:title" content="'; the_title(); echo '">';echo "\n";//単一記事タイトルを表示
  echo '<meta name="twitter:url" content="'; the_permalink(); echo '">';echo "\n";//単一記事URLを表示
  } else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  echo '<meta name="twitter:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログの説明文を表示
  echo '<meta name="twitter:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのタイトルを表示
  echo '<meta name="twitter:url" content="'; echo home_url(); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのURLを表示
}
$content = '';
if ( isset( $post->post_content ) ){
  $content = $post->post_content;
}
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿にイメージがあるか調べる
if (is_singular()){//単一記事ページの場合
  if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
    $image_id = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src( $image_id, 'full');
    $img_url = $image[0];
    echo '<meta name="twitter:image" content="'.$image[0].'">';echo "\n";
  } else if ( preg_match( $searchPattern, $content, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
    $img_url = $imgurl[2];
    echo '<meta name="twitter:image" content="'.$imgurl[2].'">';echo "\n";
  } else {//投稿にサムネイルも画像も無い場合の処理
    $ogp_image = get_stylesheet_directory_uri().'/images/og-image.jpg';
    $img_url = $ogp_image;
    echo '<meta name="twitter:image" content="'.$ogp_image.'">';echo "\n";
  }
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  if ( get_ogp_home_image() ) {
    $ogp_image = get_ogp_home_image();
  } else {
    if (get_header_image()){//ヘッダーイメージがある場合は、ヘッダーイメージを
      $ogp_image = get_header_image();
    } else {//ヘッダーイメージがない場合は、テーマのスクリーンショット
      $ogp_image = get_stylesheet_directory_uri().'/screenshot.png';
    }
  }
  echo '<meta name="twitter:image" content="'.$ogp_image.'">';echo "\n";

}
//ドメイン情報を$results[1]に取得する
//preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
//画像の縦横幅を取得
//list($width,$height) = getimagesize($img_url);
?>
<meta name="twitter:domain" content="<?php echo get_this_site_domain() ?>">
<?php if ( get_twitter_follow_id() )://TwitterIDが設定されている場合 ?>
<meta name="twitter:creator" content="@<?php echo esc_html( get_twitter_follow_id() ) ?>">
<meta name="twitter:site" content="@<?php echo esc_html( get_twitter_follow_id() ) ?>">
<?php endif; ?>
<!-- /Twitter Card -->
