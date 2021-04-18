<?php

! class_exists( 'WP_List_Table' ) ? require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php' : false;

class MFRecordsPageClass extends WP_List_Table
{
    public function prepare_items()
    {
        global $wpdb;

        $this->items = $wpdb->get_results("SELECT * FROM mf_records", ARRAY_A);
        $this->_column_headers = array($this->get_columns());
    }

    public function get_columns()
    {
        return array("id" => "ID", "data" => "Form data", "options" => "Options");
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
                return $item[$column_name];
            case 'data':
                return implode("<br>", json_decode($item[$column_name]));
            case 'options':
                return "<button class='mf-delete' data-remove-record='". $item['id'] ."'>
                            <span class='dashicons dashicons-trash'></span>
                        </button>";
            default:
                return 'no value';
        }
    }
}

$mf_main_page = new MFRecordsPageClass;
$mf_main_page->prepare_items();
$mf_main_page->display();