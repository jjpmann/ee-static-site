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

    protected $settings_default = [
        'execution_time'    => 1,
        'memory_usage'      => 20,
        'total_queries'     => 60,
    ];

    protected $hooks = [
        'sessions_end'      => 'sessions_end_hook',
    ];

    /**
     * Settings.
     *
     * This function returns the settings for the extensions
     *
     * @return settings array
     */
    public function settings()
    {
        $settings['execution_time'] = $this->settings_default['execution_time'];
        $settings['memory_usage'] = $this->settings_default['memory_usage'];
        $settings['total_queries'] = $this->settings_default['total_queries'];

        return $settings;
    }

    /**
     * hook.
     */
    public function sessions_end_hook($sess)
    {
        $this->overloadOutput();
    }

    /**
     * Overload the output to run SPL.
     */
    public function overloadOutput()
    {
        ee()->output = $this->getOutput();
    }

    private function getOutput()
    {
        return new Output($this->getSPL());
    }

    private function getSPL()
    {
        return new SlowPageLogger(ee(), $this->settings);
    }
}
