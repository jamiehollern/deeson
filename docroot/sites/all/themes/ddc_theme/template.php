<?php

/**
 * @file
 * template.php
 */

require_once 'sites/all/themes/ddc_theme/templates/node/node.inc';
require_once 'sites/all/themes/ddc_theme/templates/entity/entity.inc';

/**
 * Implements hook_preprocess_page().
 */
function ddc_theme_preprocess_page($variables) {

  // Hide page title.
  drupal_set_title(FALSE);
}
