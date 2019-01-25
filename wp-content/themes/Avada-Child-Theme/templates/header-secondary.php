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

$languages = get_languages();
$current_lang = false;

foreach ((array)$languages as $lang) {
	if ($lang->current) {
		$current_lang = $lang;
		break;
	}
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
          <div class="wrapper">
          	<div class="current">
          		<div class="flag"><img src="<?php echo $current_lang->flag; ?>" alt="<?php echo $current_lang->lang; ?>"></div>
							<div class="lang-text"><?php echo $current_lang->lang; ?></div>
							<?php if (count($languages) != 1): ?>
							<div class="sep">
								<i class="fa fa-angle-down"></i>
							</div>
							<?php endif; ?>
          	</div>
						<?php if (count($languages) != 1): ?>
						<div class="lang-list">
							<?php foreach ((array)$languages as $l): ?>
							<div class="lang <?=($l->current)?'current-lang':''?>">
								<a href="https://<?php echo $l->domain; ?>">
									<div class="flag"><img src="<?php echo $l->flag; ?>" alt="<?php echo $l->lang; ?>"></div>
									<div class="lang-text"><?php echo $l->lang; ?></div>
								</a>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
          </div>
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
