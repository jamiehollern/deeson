<?php
/**
 * @file
 * ddc_content_author.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function ddc_content_author_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_eck_bundle_info().
 */
function ddc_content_author_eck_bundle_info() {
  $items = array(
    'content_author_content_author' => array(
      'machine_name' => 'content_author_content_author',
      'entity_type' => 'content_author',
      'name' => 'content_author',
      'label' => 'Content author',
      'config' => array(
        'managed_properties' => array(
          'title' => 'title',
          'uid' => 0,
          'created' => 0,
          'changed' => 0,
        ),
      ),
    ),
  );
  return $items;
}
