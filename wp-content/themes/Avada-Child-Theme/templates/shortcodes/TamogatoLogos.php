<?php
if ( $datas->have_posts() ):
while ( $datas->have_posts() ):
  $datas->the_post();
  $pid = get_the_ID();

  $title = get_the_title($pid);
  $img = get_the_post_thumbnail_url($pid);
  $img = (!$img) ? IMG . '/no-post-image.png' : $img;
  $url = trim(get_the_excerpt($pid));
?>
<article class="logo">
  <div class="wrapper">
    <div class="image">
      <a href="<?php echo $url; ?>"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>"></a>
    </div>
  </div>
</article>
<?php
endwhile;
endif;
?>
