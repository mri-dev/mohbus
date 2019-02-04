<div class="wrapper">
  <div class="cont">
    <div class="date">
      <?php echo get_option('busojaras_ideje', ''); ?>
    </div>
    <div class="title"><?php echo get_option('busojaras_title', ''); ?></div>
    <div class="sep"></div>
    <div class="desc">
      <?php echo nl2br($post->post_excerpt); ?>
    </div>
    <div class="next-more">
      <div class="btn">
        <a href="<?php echo get_the_permalink($post); ?>"><?php echo __('Tovább', 'buso'); ?></a>
      </div>
      <div class="share">
        <a title="<?php echo __('Megosztás a Facebook-on!', 'buso'); ?>" href="https://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($post); ?>&t=<?php echo $post->post_title; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
      </div>
    </div>
  </div>
  <div class="image">
    <?php $image = get_the_post_thumbnail_url($post->ID);?>
    <img src="<?php echo $image; ?>" alt="<?php echo $post->post_title; ?>">
  </div>
</div>
