<?php

/**
 * @file
 * template.php
 */
require_once('sites/all/themes/ddc_theme/templates/node/node.inc');
require_once('sites/all/themes/ddc_theme/templates/entity/entity.inc');

function ddc_theme_preprocess_page($variables) {

  // Hide page title.
  drupal_set_title(FALSE);
}
