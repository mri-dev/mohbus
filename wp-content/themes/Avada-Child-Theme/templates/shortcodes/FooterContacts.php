<?php
$social_icons = (new Avada_Social_Icons())->render_social_icons(array(
  'position' => 'footer'
));
$cont_phone = get_option('phone', true);
$cont_email = get_option('admin_email', true);
$cont_address = get_option('address', true);
?>
<h2><?php echo __('Kapcsolat', 'buso'); ?></h2>
<div class="contact-lines">
  <?php if ($cont_phone): ?>
  <div class="phone">
    <a href="tel:<?php echo $cont_phone; ?>"><i class="fa fa-phone"></i> <?php echo $cont_phone; ?></a>
  </div>
  <?php endif; ?>
  <?php if ($cont_email): ?>
  <div class="email">
    <a href="mail:<?php echo $cont_email; ?>"><i class="fa fa-envelope"></i> <?php echo $cont_email; ?></a>
  </div>
  <?php endif; ?>
  <?php if ($cont_address): ?>
  <div class="address">
    <i class="fa fa-map-marker"></i> <?php echo __('Cím', 'buso'); ?>: <?php echo $cont_address; ?>
  </div>
  <?php endif; ?>
</div>
<div class="socials">
  <?php echo $social_icons; ?>
</div>
