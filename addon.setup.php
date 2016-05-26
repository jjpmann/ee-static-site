<?php

define('STATIC_SITES_NAME', 'Static Sites');
define('STATIC_SITES_SLUG', 'static_sites');
define('STATIC_SITES_DESC', 'Static html sites using EE for content.');
define('STATIC_SITES_VER',  '0.0.1');
define('STATIC_SITES_EXT', 'Static_sites_ext');


return array(
    'author' => 'Jerry Price',
    'author_url'  => 'https://github.com/jjpmann',
    'description' => STATIC_SITES_DESC,
    'docs_url' => 'https://github.com/jjpmann/ee-static-sites',
    'name' => STATIC_SITES_NAME,
    'namespace' => 'jjpmann\EE\StaticSites',
    'settings_exist' => true,
    'version' => STATIC_SITES_VER,
    // 'models' => array(
    //     'Settings' => 'Model\Settings',
    //     'Tree' => 'Model\Tree',
    //     'Node' => 'Model\Node',
    //     'Template' => 'Model\Template',
    //     'TreeMemberGroupAccess' => 'Model\TreeMemberGroupAccess',
    //     'TreeMemberGroupLockAccess' => 'Model\TreeMemberGroupLockAccess'
    // )
);
