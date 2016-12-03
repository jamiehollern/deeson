<?php
/**
 * @file
 * ddc_search.apachesolr_environments.inc
 */

/**
 * Implements hook_apachesolr_environments().
 */
function ddc_search_apachesolr_environments() {
  $export = array();

  $environment = new stdClass();
  $environment->api_version = 1;
  $environment->env_id = 'acquia_search_server_1';
  $environment->name = 'Acquia Search';
  $environment->url = 'http://useast1-c68.acquia-search.com/solr/BHIJ-140238';
  $environment->service_class = 'AcquiaSearchService';
  $environment->conf = array();
  $environment->index_bundles = array(
    'node' => array(
      0 => 'article',
      1 => 'blog',
    ),
  );
  $export['acquia_search_server_1'] = $environment;

  return $export;
}
