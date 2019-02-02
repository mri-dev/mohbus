<div class="wrapper">
  <div class="info">
    <div class="date">
      <div class="day">
        <?php echo utf8_encode(strftime('%Y. %B %d.')); ?>
      </div>
      <div class="weekday">
        <?php echo utf8_encode(strftime('%A')); ?>
      </div>
    </div>
    <div class="temp">
      <?php echo floor($weather->fok); ?>°
    </div>
  </div>
  <div class="pic">
    <img src="<?php echo $weather->kep; ?>" alt="Időjárás">
  </div>
</div>
