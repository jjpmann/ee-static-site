<?php

class Static_sites_ext extends EE\StaticSites\Extension
{

    public $version = STATIC_SITE_VER;

    /**
     * Constructor
     *
     * @param   mixed   Settings array or empty string if none exist.
     */
    function __construct($settings='')
    {
        $this->settings = $settings;
    }

    /**
     * Activate Extension
     *
     * This function enters the extension into the exp_extensions table
     *
     * @see https://ellislab.com/codeigniter/user-guide/database/index.html for
     * more information on the db class.
     *
     * @return void
     */
    function activate_extension()
    {
        $this->settings = array();

        // after_channel_entry_insert
        // after_channel_entry_update
        // after_channel_entry_save
        // after_channel_entry_delete

        $data = array(
            'class'     => __CLASS__,
            'method'    => 'process',
            'hook'      => 'after_channel_entry_save',
            'settings'  => serialize($this->settings),
            'priority'  => 10,
            'version'   => $this->version,
            'enabled'   => 'y'
        );

        ee()->db->insert('extensions', $data);
    }

    /**
     * Update Extension
     *
     * This function performs any necessary db updates when the extension
     * page is visited
     *
     * @return  mixed   void on update / false if none
     */
    function update_extension($current = '')
    {
        if ($current == '' OR $current == $this->version)
        {
            return FALSE;
        }

        if ($current < '1.0')
        {
            // Update to version 1.0
        }

        ee()->db->where('class', __CLASS__);
        ee()->db->update(
                    'extensions',
                    array('version' => $this->version)
        );
    }

    /**
     * Disable Extension
     *
     * This method removes information from the exp_extensions table
     *
     * @return void
     */
    function disable_extension()
    {
        ee()->db->where('class', __CLASS__);
        ee()->db->delete('extensions');
    }

    // --------------------------------
    //  Settings
    // --------------------------------

    function settings()
    {
        $settings = array();

        // Creates a text input with a default value of "EllisLab Brand Butter"
        $settings['brand']      = array('i', '', "EllisLab Brand Butter");

        // Creates a textarea with 20 rows and an empty default value
        $settings['description']    = array('t', array('rows' => '20'), '');

        // Creates a set of radio buttons, one for "Yes" (y), one for "No" (n) and a default of "Yes"
        $settings['tasty']      = array('r', array('y' => "Yes", 'n' => "No"), 'y');

        // Creates a set of checkboxes, one for "Lowfat" (l) and one for "Salty" (s), and a
        // default of both items being checked
        $settings['details']    = array('c', array('l' => "Lowfat", 's' => "Salty"), array('l', 's'));

        // Creates a select dropdown with the options "France" (fr), "Germany" (de), and "United States"
        // (us), with a default of "United States"
        $settings['country']    = array('s', array('fr' => 'France', 'de' => 'Germany', 'us' => 'United States'), 'us');

        // Creates a multi-select box with the options "Derek" (dj), "Leslie" (lc), and "Rick" (re) with
        // Derek and Rick selected by default
        $settings['enjoyed_by'] = array('ms', array('dj' => 'Derek', 'lc' => 'Leslie', 're' => 'Rick'), array('dj', 're'));


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
    // END
}
