<?php

namespace EE\StaticSites;

use EE\Addons\Extension\BaseExtension;

class Extension extends BaseExtension
{

    public $name = STATIC_SITE_NAME;
    public $version = STATIC_SITE_VER;
    public $description = STATIC_SITE_DESC;
    public $settings_exist = 'n';
    public $docs_url = '';
    public $settings = [];

    protected $settings_default = [];

    protected $hooks = [
        'sessions_end'                  => 'hookSessionsEnd',
        'after_channel_entry_insert'    => 'sync',
        'after_channel_entry_update'    => 'sync',
        'after_channel_entry_save'      => 'sync',
        'after_channel_entry_delete'    => 'sync',
    ];

    public function settings()
    {
        return [];
    }

    public function sync()
    {

    }

    public function hookSessionsEnd() 
    {

    }

}
