<?php
if ( $datas->have_posts() ):
while ( $datas->have_posts() ):
  $datas->the_post();
  $pid = get_the_ID();
  $title = get_the_title($pid);
  $img = get_the_post_thumbnail_url($pid);
  $img = (!$img) ? IMG . '/no-post-image.png' : $img;
  $url = get_the_permalink($pid);
  $desc = get_the_content($pid);
?>
<div class="video-item">
  <?php echo apply_filters('the_content', $desc); ?>
</div>
<?php
endwhile;
endif;
?>
