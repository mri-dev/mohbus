<?php
if ( $datas->have_posts() ):
while ( $datas->have_posts() ):
  $datas->the_post();
  $pid = get_the_ID();

  $title = get_the_title($pid);
  $img = get_the_post_thumbnail_url($pid);
  $img = (!$img) ? IMG . '/no-post-image.png' : $img;
  $url = get_the_permalink($pid);
  $date = get_the_date( 'Y. F j.', $pid );
  $cats = wp_get_post_categories( $pid, array('fields' => 'all') );
?>
<article class="<?=$type?>-item">
  <div class="wrapper">
    <div class="image">
      <a href="<?php echo $url; ?>"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>"></a>
    </div>
    <div class="datas">
      <div class="title">
        <h3><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h3>
      </div>
      <div class="incat">
        <?php $cat_links = ''; ?>
        <?php foreach ((array)$cats as $c ): $cat_links .= '<a href="'.get_category_link($c).'">'.$c->name.'</a>, '; endforeach; ?>
        <?php $cat_links = rtrim($cat_links,', '); echo $cat_links; ?>
      </div>
      <div class="more-to">
        <div class="date"><i class="fa fa-clock-o"></i> <?php echo $date; ?></div>
        <div class="goto"><a href="<?php echo $url; ?>"><?php echo __('Tovább', 'buso'); ?></a></div>
      </div>
    </div>
  </div>
</article>
<?php
endwhile;
endif;
?>
