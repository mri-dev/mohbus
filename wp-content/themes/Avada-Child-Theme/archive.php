<?php
/**
 * Archives template.
 *
 * @package Avada
 * @subpackage Templates
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
global $wp_query;
$posttype = $wp_query->query_vars['post_type'];
$posttype = (!$posttype) ? 'post' : $posttype;
?>
<?php get_header(); ?>
<section id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( category_description() ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'fusion-archive-description' ); ?>>
			<div class="post-content">
				<?php echo category_description(); ?>
			</div>
		</div>
	<?php endif; ?>
  <div class="bloglist-holder view-of-<?=$posttype?>">
		<?php if ($posttype == 'videok'): ?><div class="video-stack"><?php endif; ?>
    <?php $i = 0; while(have_posts()): ?>
      <?php
			$i++;
      the_post();
      $pid = get_the_ID();

      $title = get_the_title($pid);
      $img = get_the_post_thumbnail_url($pid);
      $img = (!$img) ? IMG . '/no-post-image.png' : $img;
      $url = get_the_permalink($pid);
      $date = get_the_date( 'Y. F j.', $pid );
      $cats = wp_get_post_categories( $pid, array('fields' => 'all') );
      $pt = get_post_type($pid);
		  $desc = get_the_content($pid);
      ?>
      <?php if ($pt == 'post'): ?>
      <article class="post-item">
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
      <?php elseif( $pt == 'videok' ): ?>
				<div class="video-item">
				  <div class="wrapper">
				    <?php echo apply_filters('the_content', $desc); ?>
				  </div>
				</div>
      <?php endif; ?>
    <?php endwhile; wp_reset_postdata(); ?>
		<?php if ($posttype == 'videok'): ?></div><?php endif; ?>
  </div>
  <div class="pagination">
    <?php echo paginate_links(); ?>
  </div>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
