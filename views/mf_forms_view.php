<?php

! class_exists( 'WP_List_Table' ) ? require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php' : false;

class MFMainPageClass extends WP_List_Table
{
    public function prepare_items()
    {
        global $wpdb;

        $this->items = $wpdb->get_results("SELECT * FROM mf_forms", ARRAY_A);
        $this->_column_headers = array($this->get_columns());
    }

    public function get_columns()
    {
        return array("id" => "ID", "name" => "Identifier", "template" => "Template", "options" => "Options");
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'name':
            case 'template':
                return $item[$column_name];
            case 'options':
                return "<button class='mf-delete' data-remove-form='". $item['id'] ."'>
                            <span class='dashicons dashicons-trash'></span>
                        </button>";
            default:
                return 'no value';
        }
    }
}

$mf_main_page = new MFMainPageClass;
$mf_main_page->prepare_items();
$mf_main_page->display();
