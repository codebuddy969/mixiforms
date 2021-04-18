<?php

namespace MixiForms {

    use MixiHelpers\CommonHelpers;

    /**
     * Base class
     *
     * @since 1.0.0
     */
    final class MixiForms
    {

        /**
		 * The helper variable
		 *
		 * @since 1.0.0
		 *
		 * @var MixiHelpers\CommonHelpers;
		 */
        public $helpers;


        public function __construct()
        {
            add_action('admin_menu', array($this, 'display_menu_page'), 99);

            $this->inclusions();

            $this->helpers = new CommonHelpers;

            $this->helpers->create_mf_tables();

            add_action('wp_ajax_store', array($this->helpers, 'create_mf_forms_record'));
            add_action('wp_ajax_submit', array($this->helpers, 'create_mf_contact_record'));

            add_action('wp_ajax_delete_contact', array($this->helpers, 'delete_mf_contact_record'));
            add_action('wp_ajax_delete_form', array($this->helpers, 'delete_mf_forms_record'));

            add_filter('wp_insert_post_data', array($this->helpers, 'intercept_post_save'));

            wp_enqueue_style( 'mf_custom_styles', MF_PLUGIN_URL . 'assets/css/app.css' );

            wp_enqueue_script('mf_custom_script', MF_PLUGIN_URL . 'assets/js/app.js',array('jquery'),'',true);
        }


        /**
		 * Include plugin files.
		 *
		 * @since 1.0.0
		 */
        public function inclusions()
        {
            require_once  MF_PLUGIN_DIR . 'mf_helpers.php';
        }

        /**
		 * Register plugin inside of a Wordpress menu.
		 *
		 * @since 1.0.0
		 */
        function display_menu_page()
        {
            $mf_menu_icon = 'data:image/svg+xml;base64,' . base64_encode('<svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path fill="#9ea3a8" d="M643 911v128h-252v-128h252zm0-255v127h-252v-127h252zm758 511v128h-341v-128h341zm0-256v128h-672v-128h672zm0-255v127h-672v-127h672zm135 860v-1240q0-8-6-14t-14-6h-32l-378 256-210-171-210 171-378-256h-32q-8 0-14 6t-6 14v1240q0 8 6 14t14 6h1240q8 0 14-6t6-14zm-855-1110l185-150h-406zm430 0l221-150h-406zm553-130v1240q0 62-43 105t-105 43h-1240q-62 0-105-43t-43-105v-1240q0-62 43-105t105-43h1240q62 0 105 43t43 105z"/></svg>');

            add_menu_page(
                'Mixiforms',
                'Mixiforms',
                'manage_options',
                'mixiforms-main',
                array($this, 'forms_page_output'),
                $mf_menu_icon
            );
            add_submenu_page(
                'mixiforms-main',
                'Records',
                'Records',
                'manage_options',
                'mixiforms-records',
                array($this, 'records_page_output')
            );
            add_submenu_page(
                'mixiforms-main',
                'Builder',
                'Builder',
                'manage_options',
                'mixiforms-builder',
                array($this, 'builder_page_output')
            );
        }

        /**
         * Records page.
         *
         * @since 1.0.0
         */
        function records_page_output()
        {
            echo $this->helpers->inclusions('views/mf_records_view.php');
        }

        /**
		 * Builder page.
		 *
		 * @since 1.0.0
		 */
        function builder_page_output()
        {
            echo $this->helpers->inclusions('views/mf_builder_view.php');
        }

        /**
         * All Forms table.
         *
         * @since 1.0.0
         */
        function forms_page_output()
        {
            echo $this->helpers->inclusions('views/mf_forms_view.php');
        }
    }

    new Mixiforms();
}
