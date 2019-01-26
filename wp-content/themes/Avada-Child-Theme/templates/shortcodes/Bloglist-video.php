<?php
if ( $datas->have_posts() ):
  $i = 0;
while ( $datas->have_posts() ):
  $i++;
  $datas->the_post();
  $pid = get_the_ID();
  $title = get_the_title($pid);
  $img = get_the_post_thumbnail_url($pid);
  $img = (!$img) ? IMG . '/no-post-image.png' : $img;
  $url = get_the_permalink($pid);
  $desc = get_the_content($pid);
?>
<?php if ($i == 1): ?>
<div class="video-stack">
<?php endif; ?>

<div class="video-item">
  <?php echo $i;//echo apply_filters('the_content', $desc); ?>
</div>
<?php if ($i%4!==false): ?>
</div>
<div class="video-stack">
<?php endif; ?>
<?php
endwhile;
endif;
?>
