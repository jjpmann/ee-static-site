<?php

namespace EE\StaticSites;

use EE\Addons\Extension\BaseExtension;

class Extension extends BaseExtension
{
    public $name = STATIC_SITE_NAME;
    public $version = STATIC_SITE_VER;
    public $description = STATIC_SITE_DESC;
    public $settings_exist = 'y';
    public $docs_url = '';
    public $settings = [];

    protected $settings_default = [];

    protected $hooks = [
        'sessions_end'                  => 'hookSessionsEnd',
        'after_channel_entry_insert'    => 'hookEntryInsert',
        'after_channel_entry_update'    => 'hookEntryUpdate',
        'after_channel_entry_save'      => 'hookEntrySave',
        'after_channel_entry_delete'    => 'hookEntryDelete',
    ];


    protected function sync($what)
    {
        die($what);
    }

    /**
     * Run after entry is added
     * @param  object $entry  Current ChannelEntry model object
     * @param  array $values The ChannelEntry model object data as an array
     * @return void
     */
    public function hookEntryInsert($entry, $values)
    {
        $this->sync('hookEntryInsert');
    }

    /**
     * Run after entry is added
     * @param  object $entry  Current ChannelEntry model object
     * @param  array $values The ChannelEntry model object data as an array
     * @param  array $modified An array of all the old values that were changed
     * @return void
     */
    public function hookEntryUpdate($entry, $values, $modified)
    {
        $this->sync('hookEntryUpdate');
    }

    /**
     * Run after entry is added
     * @param  object $entry  Current ChannelEntry model object
     * @param  array $values The ChannelEntry model object data as an array
     * @return void
     */
    public function hookEntrySave($entry, $values)
    {
        $this->sync('hookEntrySave');
    }

    /**
     * Run after entry is added
     * @param  object $entry  Current ChannelEntry model object
     * @param  array $values The ChannelEntry model object data as an array
     * @return void
     */
    public function hookEntryDelete($entry, $values)
    {
        $this->sync('hookEntryDelete');
    }


}
