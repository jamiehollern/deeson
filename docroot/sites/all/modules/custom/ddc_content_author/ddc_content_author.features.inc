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

/**
 * Implements hook_eck_entity_type_info().
 */
function ddc_content_author_eck_entity_type_info() {
  $items = array(
    'content_author' => array(
      'name' => 'content_author',
      'label' => 'Content author',
      'properties' => array(
        'uid' => array(
          'label' => 'Author',
          'type' => 'integer',
          'behavior' => 'author',
        ),
        'created' => array(
          'label' => 'Created',
          'type' => 'integer',
          'behavior' => 'created',
        ),
        'changed' => array(
          'label' => 'Changed',
          'type' => 'integer',
          'behavior' => 'changed',
        ),
        'title' => array(
          'label' => 'Name',
          'type' => 'text',
          'behavior' => 'title',
        ),
      ),
    ),
  );
  return $items;
}
