<?php

/**
 * @file
 * Entity template functions.
 */

/**
 * Implements hook_preprocess_entity().
 */
function ddc_theme_preprocess_entity(&$variables) {
  if (isset($variables['elements']['#entity_type'])) {
    $function_names = array(
      'ddc_theme_preprocess_entity__' . $variables['elements']['#entity_type'],
      'ddc_theme_preprocess_entity__' . $variables['elements']['#entity_type'] . '__' . $variables['elements']['#view_mode'],
    );

    foreach ($function_names as $function_name) {
      if (function_exists($function_name)) {
        $function_name($variables);
      }
    }
  }
}

/**
 * Preprocess the full display mode of the author entity.
 *
 * @param array $variables
 *   Drupal theme variables.
 */
function ddc_theme_preprocess_entity__content_author__full(&$variables) {
  // Add the date to the entity render array.
  if ($node = menu_get_object()) {
    $created = $node->created;
    $variables['content']['published']['#markup'] = date('l jS \of F \a\t H:i', $created);
  }
}
