<?php

namespace MixiHelpers {

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    class CommonHelpers
    {
        public function inclusions($path)
        {
            ob_start();
            include_once MF_PLUGIN_DIR . $path;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }

        public function create_mf_tables()
        {
            global $wpdb;

            $charset_collate = $wpdb->get_charset_collate();

            $forms = "CREATE TABLE IF NOT EXISTS mf_forms (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    name varchar(50) DEFAULT '' NOT NULL,
                    template text NOT NULL,
                    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                    ) $charset_collate;";

            $records = "CREATE TABLE IF NOT EXISTS mf_records (
                    id mediumint(9) NOT NULL AUTO_INCREMENT,
                    formdata text NOT NULL,
                    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                    ) $charset_collate;";

            dbDelta($forms);
            dbDelta($records);
        }

        public function intercept_post_save($data)
        {
            global $wpdb;

            preg_match_all("/{{(.*)}}/", $data['post_content'], $names);

            foreach ($names[1] as $key => $value) {
                $value = preg_replace('/[^a-zA-Z0-9]/', '', $value);
                $row = array_shift($wpdb->get_results( "SELECT * FROM mf_forms WHERE name='$value'" ));
                $data['post_content'] = preg_replace("/{$names[0][$key]}/", "$row->template", $data['post_content']);
            }

            return $data;
        }

        public function create_mf_forms_record() {

            global $wpdb;

            $result = $wpdb->insert('mf_forms', array(
                'name' => preg_replace('/\s+/', '-', $_POST['name']),
                'template' => stripslashes($_POST['form'])
            ));

            $result ? wp_send_json("Record added successfully") : wp_send_json_error("Something went wrong, please try again");
        }

        public function create_mf_contact_record() {

            global $wpdb;

            $fields = explode("&", $_POST['form']);

            foreach ($fields as $key => $value) {
                $fields[$key] = htmlspecialchars(preg_replace('/.+?_/', '', $value));
            }

            $result = $wpdb->insert('mf_records', array('name' => 'contact', 'data' => wp_json_encode($fields)));

            $result ? wp_send_json("Record added successfully") : wp_send_json_error("Something went wrong, please try again");
        }

        public function delete_mf_contact_record() {
            global $wpdb;

            $result = $wpdb->delete('mf_records', array( 'id' => htmlspecialchars($_POST['id']) ) );

            $result ? wp_send_json("Record deleted successfully") : wp_send_json_error("Something went wrong, please try again");
        }

        public function delete_mf_forms_record() {
            global $wpdb;

            $result = $wpdb->delete('mf_forms', array( 'id' => htmlspecialchars($_POST['id']) ) );

            $result ? wp_send_json("Record deleted successfully") : wp_send_json_error("Something went wrong, please try again");
        }
    }
}
