<?php

$master_stage_modules = array(
  'admin_views',
  'coder',
  'coder_review',
  'dblog',
  'devel',
  'devel_generate',
  'diff',
  'features_ui',
  'field_ui',
  'strongarm',
  'views_ui',
);

$master_local_modules = $master_stage_modules;

$conf['install_profile'] = 'standard';
$conf['master_version'] = 2;
$conf['master_modules'] = array(
  'base' => array(
    'coffee',
    'shortcut',
    'search',
    'rdf',
    'path',
    'number',
    'navbar',
    'menu',
    'list',
    'libraries',
    'help',
    'contextual',
    'comment',
    'color',
    'block',
    'strongarm',
    'features',
    'fe_block',
    'admin_views',
    'acquia_agent',
    'xautoload',
    'date',
    'conditional_fields',
    'views_show_more',
    'acquia_search',
    'apachesolr_access',

    //Features
    'ddc_article',
    'ddc_article_list',
    'ddc_block',
    'ddc_blog',
    'ddc_common',
    'ddc_content_author',
    'ddc_filter',
    'ddc_homepage',
    'ddc_image',
    'ddc_permission',
    'ddc_search',
    'ddc_system',

    //Custom
    'ddc_scheduled_access',

    // Theme
    'ddc_theme',
  ),
  'local' => $master_local_modules,
  'dev' => $master_local_modules,
  'test' => $master_stage_modules,
  'prod' => array(),
);
$conf['master_uninstall_blacklist'] = array(
  'base' => array(
    'stage_file_proxy',
    'inese_migrate',
  ),
  'local' => array(),
  'prod' => array(),
);
$conf['master_removable_blacklist'] = array(
  0 => 'modules/*',
);
