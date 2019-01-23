<?php
/**
 * Template for the secondary header.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       http://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php
  $cont_phone = get_option('phone', true);
  $cont_email = get_option('admin_email', true);
  $cont_address = get_option('address', true);

  $social_icons = (new Avada_Social_Icons())->render_social_icons(array(
    'position' => 'header'
  ));
?>

<div class="fusion-secondary-header">
	<div class="fusion-row">
		  <div class="top-header-holder">
        <div class="language-changer">
          lang
        </div>
        <?php if ($social_icons): ?>
        <div class="social-icons">
          <?php echo $social_icons; ?>
        </div>
        <?php endif; ?>
        <?php if ($cont_email): ?>
        <div class="contact-email">
          <a href="mail:<?php echo $cont_email; ?>"><i class="fa fa-envelope"></i> <?php echo $cont_email; ?></a>
        </div>
        <?php endif; ?>
        <?php if ($cont_phone): ?>
        <div class="contact-phone">
          <a href="tel:<?php echo $cont_phone; ?>"><i class="fa fa-phone"></i> <?php echo $cont_phone; ?></a>
        </div>
        <?php endif; ?>
        <?php if ($cont_address): ?>
        <div class="contact-address">
          <i class="fa fa-map-marker"></i> <?php echo $cont_address; ?>
        </div>
        <?php endif; ?>
        <div class="searcher">
          <div class="searcher-holder">
            <form class="" action="" method="get">
              <input type="text" name="s" placeholder="<?php echo __('Keresés...', 'buso'); ?>" value="<?php echo $_GET['s']; ?>">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
	</div>
</div>
