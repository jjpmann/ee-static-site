<?php

namespace EE\StaticSites;

use EE\Addons\Extension\BaseExtension;
use Illuminate\Config\Repository;

class Extension extends BaseExtension
{
    public $name = STATIC_SITES_NAME;
    public $slug = STATIC_SITES_SLUG;
    public $version = STATIC_SITES_VER;
    public $description = STATIC_SITES_DESC;
    public $settings_exist = 'y';
    public $docs_url = '';
    public $settings = [];

    protected $settings_default = [
        'static_sites_domain'    => '',
        'static_sites_list'      => '',
        'static_sites_dump_path' => '',
    ];

    protected $hooks = [
        'sessions_end'                  => 'hookSessionsEnd',
        'after_channel_entry_insert'    => 'hookEntryInsert',
        'after_channel_entry_update'    => 'hookEntryUpdate',
        'after_channel_entry_save'      => 'hookEntrySave',
        'after_channel_entry_delete'    => 'hookEntryDelete',
    ];

    public function __construct($settings = [])
    {
        //$this->config = new Repository($settings);
        parent::__construct($settings);
    }

    protected function sync($what)
    {
    }

    public function settingsForm($current)
    {
        $name = STATIC_SITES_SLUG;

        if ($current == '') {
            $current = [];
        }

        $values = array_replace($this->settings_default, $this->settings, $current);

        $vars = [
            'base_url'              => ee('CP/URL')->make('addons/settings/'.$name.'/save'),
            'cp_page_title'         => STATIC_SITES_NAME.' Settings',
            'save_btn_text'         => 'static_sites_save_button',
            'save_btn_text_working' => 'static_sites_save_button_working',
            'alerts_name'           => 'link-truncator-save',
            'sections'              => [],
        ];

        $vars['sections'][] = [[
            'title'  => 'static_sites_domain',
            'desc'   => 'static_sites_domain_desc',
            'fields' => [
                'static_sites_domain' => [
                    'type' => 'text',
                    // 'name' => 'static_sites_domain',
                    'attrs'    => 'id="input__domain" placeholder="http://www.example.com"',
                    'value'    => $values['static_sites_domain'],
                    'required' => true,
                ],
            ],
        ], [
            'title'  => 'static_sites_list',
            'desc'   => 'static_sites_list_desc',
            'fields' => [
                'static_sites_list' => [
                    'type'     => 'textarea',
                    'attrs'    => 'id="input__list" placeholder="http://www.example.com/about"',
                    'value'    => $values['static_sites_list'],
                    'required' => true,
                ],
            ],
        ], [
            'title'  => 'static_sites_dump_path',
            'desc'   => 'static_sites_dump_path_desc',
            'fields' => [
                'static_sites_dump_path' => [
                    'type'     => 'text',
                    'attrs'    => 'id="input__dump_path" placeholder="site_dump/html_pages"',
                    'value'    => $values['static_sites_dump_path'],
                    'required' => true,
                ],
            ],
        ]];

        $view = STATIC_SITES_SLUG.':index';

        return ee('View')->make($view)->render($vars);
    }

    public function settingsSave()
    {
        if (empty($_POST)) {
            show_error(lang('unauthorized_access'));
        }

        if (Form::validate() !== false) {
            ee()->db->where('class', STATIC_SITES_EXT);
            ee()->db->update('extensions', ['settings' => serialize($_POST)]);
        }

        // ee()->db->where('class', __CLASS__);
        // ee()->db->update('extensions', array('settings' => serialize($_POST)));

        $this->redirectHome();
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
     * Run after entry is added.
     *
     * @param object $entry  Current ChannelEntry model object
     * @param array  $values The ChannelEntry model object data as an array
     *
     * @return void
     */
    public function hookEntryInsert($entry, $values)
    {
        $this->sync('hookEntryInsert');
    }

    /**
     * Run after entry is added.
     *
     * @param object $entry    Current ChannelEntry model object
     * @param array  $values   The ChannelEntry model object data as an array
     * @param array  $modified An array of all the old values that were changed
     *
     * @return void
     */
    public function hookEntryUpdate($entry, $values, $modified)
    {
        $this->sync('hookEntryUpdate');
    }

    /**
     * Run after entry is added.
     *
     * @param object $entry  Current ChannelEntry model object
     * @param array  $values The ChannelEntry model object data as an array
     *
     * @return void
     */
    public function hookEntrySave($entry, $values)
    {
        $this->sync('hookEntrySave');
    }

    /**
     * Run after entry is added.
     *
     * @param object $entry  Current ChannelEntry model object
     * @param array  $values The ChannelEntry model object data as an array
     *
     * @return void
     */
    public function hookEntryDelete($entry, $values)
    {
        $this->sync('hookEntryDelete');
    }
}
