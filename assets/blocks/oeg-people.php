<?php
if (!defined('ABSPATH')) {
  exit; // Prevent access directly
}

// Create id attribute allowing for custom "anchor" value.
$id = 'peoplegrid-' . $block['id'];
if (!empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'peoplegrid';
if (!empty($block['className'])) {
  $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
  $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$peopleGrid = get_field('personas');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <?php

  // Check rows exists.
  if (have_rows('personas')) :

    // Loop through rows.
    while (have_rows('personas')) : the_row();

      // Load sub field value.
      $photo = get_sub_field('photo');
      $size = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
  ?>

      <div class="card">

        <?php
        $link = get_sub_field('profile_link');
        if ($link) :
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
          // create link only if available
          echo '<a href="' . $link_url . '">';
        endif;
        ?>

        <div class="inner-card">
          <div class="pic">
            <?php
            // Do something...
            if ($photo) :
              echo wp_get_attachment_image($photo, $size);
            else :
              echo '<img src="' . CHILD_DIR . '/img/user-avatar.png">';
            endif;
            ?>
          </div>

          <?php
          $lines = get_sub_field('lines');
          $name = $lines['line1'] ?: 'Ale José Yunuen';

          if ($lines['line1']) :
            echo '<p class="line1">' . $name . '</p>';
          else :
            echo '<p class="line1">Ale José Yunuen</p>';
          endif;

          if ($lines['line2']) :
            echo '<p class="line2">' . $lines['line2'] . '</p>';
          endif;

          if ($lines['line3']) :
            echo '<p class="line3 text-xs italic">' . $lines['line3'] . '</p>';
          endif;
          ?>
        </div>

        <?php if ($link) :
          echo '</a>';
        endif; ?>

      </div>

  <?php
    // End loop.
    endwhile;

  // No value.
  else :
  // Do something...
  endif; ?>
</div>