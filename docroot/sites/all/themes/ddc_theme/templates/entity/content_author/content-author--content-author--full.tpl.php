<?php

/**
 * @file
 * Template file for the content author full view.
 */
?>
<div class="author-info <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content row "<?php print $content_attributes; ?>>
    <div class="author-image col-xs-2">
      <?php print render($content['field_ca_author_image']); ?>
    </div>
    <div class="post-info col-xs-10">
      <strong><?php print t('Posted by @author on @published', array(
        '@author' => $title,
        '@published' => render($content['published']))
      ); ?></strong>
      <?php print render($content['field_ca_author_description']); ?>
    </div>
  </div>
</div>
