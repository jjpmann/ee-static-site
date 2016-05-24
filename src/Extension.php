<?php

namespace EE\StaticSites;

use EE\Addons\Extension\BaseExtension;
use Illuminate\Config\Repository;

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

    public function __construct($settings = [])
    {
        $this->config = new Repository($settings);
        parent::__construct($settings);
    }

    protected function sync($what)
    {

    }

    public function settingsForm()
    {
        $settings = array();

        // Creates a text input with a default value of "EllisLab Brand Butter"
        $settings['path']      = array('i', '', "pages");

        $settings['domain']    = array('i', '', "http://mini-sites.app");

        // Creates a textarea with 20 rows and an empty default value
        $settings['list']    = array('t', array('rows' => '20'), '');

        

        // General pattern:
        //
        // $settings[variable_name] => array(type, options, default);
        //
        // variable_name: short name for the setting and the key for the language file variable
        // type:          i - text input, t - textarea, r - radio buttons, c - checkboxes, s - select, ms - multiselect
        // options:       can be string (i, t) or array (r, c, s, ms)
        // default:       array member, array of members, string, nothing

        return $settings;
    }

    public function settingsSave()
    {
        
    }

    protected function scrape()
    {
        $scraper = new Scraper($this->config);
        $scraper->scrape();
    }



    public function hookSessionsEnd($sess)
    {
        
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
