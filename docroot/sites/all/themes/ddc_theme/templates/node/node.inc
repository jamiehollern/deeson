<?php

/**
 * @file
 * Node template functions.
 */

/**
 * Implements hook_preprocess_node().
 */
function ddc_theme_preprocess_node(&$variables) {
  $node_type = $variables['node']->type;
  // We want to theme nodes by type and display mode.
  $variables['theme_hook_suggestions'][] = 'node__' . $node_type . '__' . $variables['view_mode'];
  $function_names = array(
    'ddc_theme_preprocess_node__' . $node_type . '__' . $variables['view_mode'],
    'ddc_theme_preprocess_node__' . $node_type,
  );
  foreach ($function_names as $function_name) {
    if (function_exists($function_name)) {
      $function_name($variables);
    }
  }
}

/**
 * Preprocess the teaser display mode of the article node.
 *
 * @param array $variables
 *   Drupal theme variables.
 */
function ddc_theme_preprocess_node__article__teaser(&$variables) {
  // Create linked title.
  $variables['linked_title'] = l($variables['title'], 'node/' . $variables['nid']);
  // Special article.
  $node = $variables['node'];
  $value = field_get_items('node', $node, 'field_article_special_article');
  $special = isset($value[0]['value']) ? $value[0]['value'] : 0;
  $variables['special_article'] = $special ? 'special-article' : '';
}
