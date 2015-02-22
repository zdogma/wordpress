<?php //カテゴリ用のパンくずリスト
$cat = is_single() ? get_the_category() : array(get_category($cat));
if($cat && !is_wp_error($cat)){
    $echo = null;
    $par = get_category($cat[0]->parent);
    echo '<div id="breadcrumb" class="breadcrumb-category">';
    echo '<div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><i class="fa fa-home fa-fw"></i><a href="'.home_url().'" itemprop="url"><span itemprop="title">ホーム</span></a><span class="sp"><i class="fa fa-angle-right"></i></span></div>';
    while($par && !is_wp_error($par) && $par->term_id != 0){
	    $echo = '<div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><i class="fa fa-folder fa-fw"></i><a href="'.get_category_link($par->term_id).'" itemprop="url"><span itemprop="title">'.$par->name.'</span></a><span class="sp"><i class="fa fa-angle-right"></i></span></div>'.$echo;
	    $par = get_category($par->parent);
    }
    echo $echo.'<div itemtype="http://data-vocabulary.org/Breadcrumb" itemscope=""><i class="fa fa-folder fa-fw"></i><a href="'.get_category_link($cat[0]->term_id).'" itemprop="url"><span itemprop="title">'.$cat[0]->name.'</span></a></div>';
    echo '</div><!-- /#breadcrumb -->';
}
?>
