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

  // Exported permission: 'search content'.
  $permissions['search content'] = array(
    'name' => 'search content',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'search',
  );

  // Exported permission: 'use advanced search'.
  $permissions['use advanced search'] = array(
    'name' => 'use advanced search',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'search',
  );

  return $permissions;
}
