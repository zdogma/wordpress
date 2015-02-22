<?php //カテゴリ情報から関連記事をランダムに呼び出す
$args = get_related_wp_query_args();
$query = new WP_Query( $args ); ?>
  <?php if( $query -> have_posts() && !empty($args) ): //関連記事があるとき?>
  <?php while ($query -> have_posts()) : $query -> the_post(); ?>
    <div class="related-entry">
      <div class="related-entry-thumb">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
        <?php if ( has_post_thumbnail() ): // サムネイルを持っているとき ?>
        <?php echo get_the_post_thumbnail($post->ID, 'thumb100', array('style' => 'width:100px;height:100px;', 'class' => 'related-entry-thumb-image', 'alt' => get_the_title()) ); //サムネイルを呼び出す?>
        <?php else: // サムネイルを持っていないとき ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="NO IMAGE" style="width:100px;height:100px;" class="no-image related-entry-no-image" />
        <?php endif; ?>
        </a>
      </div><!-- /.related-entry-thumb -->

      <div class="related-entry-content">
        <h4 class="related-entry-title">
          <a href="<?php the_permalink(); ?>" class="related-entry-title-link" title="<?php the_title(); ?>">
          <?php the_title(); //記事のタイトル?>
          </a></h4>
        <p class="related-entry-snippet">
       <?php echo get_the_custom_excerpt( $post->post_content, get_excerpt_length() ) . ''; //カスタマイズで指定した文字の長さだけ本文抜粋?></p>

        <?php if ( get_theme_text_read_entry() ): //「記事を読む」のようなテキストが設定されている時 ?>
        <p class="related-entry-read"><a href="<?php the_permalink(); ?>"><?php echo get_theme_text_read_entry(); //デフォルト：記事を読む ?></a></p>
        <?php endif; ?>

      </div><!-- /.related-entry-content -->
    </div><!-- /.elated-entry -->

  <?php endwhile;?>

  <?php else:?>
  <p><?php echo get_theme_text_not_found_message();//記事は見つかりませんでした ?></p>
  <?php
endif;
wp_reset_postdata();
?>
<br style="clear:both;">