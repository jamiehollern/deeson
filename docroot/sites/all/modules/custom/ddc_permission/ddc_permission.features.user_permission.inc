<?php
/**
 * @file
 * ddc_permission.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function ddc_permission_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'eck view content_author content_author entities'.
  $permissions['eck view content_author content_author entities'] = array(
    'name' => 'eck view content_author content_author entities',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'eck',
  );

  return $permissions;
}
