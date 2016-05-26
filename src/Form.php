<?php

namespace EE\StaticSites;

class Form
{
    protected static $fields = [[
            'field'   => 'static_sites_domain',
            'label'   => 'static_sites_domain',
            'rules'   => 'required',
        ], [
            'field'   => 'static_sites_list',
            'label'   => 'static_sites_list',
            'rules'   => 'required|callback_list_check',
        ], [
            'field'   => 'static_sites_dump_path',
            'label'   => 'static_sites_dump_path',
            'rules'   => 'required|callback_dump_path_check',
    ]];

    private function __construct()
    {
    }

    public static function validate()
    {
        ee()->load->library('form_validation');
        ee()->load->helper(['form', 'url']);
        $form = ee()->form_validation;

        $form->set_message('required', 'The field %s is required.');

        $form->_error_prefix = '<li>';
        $form->_error_suffix = '</li>';

        $form->set_rules(self::$fields);

        if ($form->run() === false) {
            ee('CP/Alert')->makeInline('link-truncator-save')
                ->asIssue()
                ->withTitle(lang('message_failure'))
                ->addToBody(self::errors())
                ->defer();
        } else {
            ee('CP/Alert')->makeInline('link-truncator-save')
                ->asSuccess()
                ->withTitle(lang('message_success'))
                ->addToBody(lang('preferences_updated'))
                ->defer();
        }
    }

    public function list_check($str)
    {
        if ($str == 'test') {
            ee()->form_validation->set_message('list_check', 'Error Message');

            return false;
        } else {
            return true;
        }
    }

    public function dump_path_check($str)
    {
        ee()->form_validation->set_message('dump_path_check', 'Error message');

        return false;
    }

    public static function errors()
    {
        return '<ul>'.validation_errors().'</ul>';
    }
}
