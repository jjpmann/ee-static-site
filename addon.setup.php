<?php

return array(
      'author'      => 'Jerry Price',
      'author_url'  => 'http://github.com/jjpmann',
      'name'        => 'Static Sites',
      'description' => 'Static html sites using EE for content.',
      'version'     => '0.0.1',
      'namespace'   => 'Example\HelloWorld'
);

<?php

define('STATIC_SITE_DESC', 'Static html sites using EE for content.');
define('STATIC_SITE_NAME', 'Static Site');
define('STATIC_SITE_VER',  '0.0.1');

return array(
    'author' => 'Jerry Price',
    'author_url'  => 'https://github.com/jjpmann',
    'description' => STATIC_SITE_DESC,
    'docs_url' => 'https://github.com/jjpmann/ee-static-site',
    'name' => STATIC_SITE_NAME,
    'namespace' => 'jjpmann\EE\StaticSite',
    'settings_exist' => true,
    'version' => STATIC_SITE_VER,
    // 'models' => array(
    //     'Settings' => 'Model\Settings',
    //     'Tree' => 'Model\Tree',
    //     'Node' => 'Model\Node',
    //     'Template' => 'Model\Template',
    //     'TreeMemberGroupAccess' => 'Model\TreeMemberGroupAccess',
    //     'TreeMemberGroupLockAccess' => 'Model\TreeMemberGroupLockAccess'
    // )
);
