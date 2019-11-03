<?php
/**
 * @package WpBook
 */

namespace Inc\Base;
use Inc\Api\Meta_Table;


class Activate
{
    public static function activate() {

        // create bookmeta table 
        Meta_Table::create_table();
        Meta_Table::register_table_with_wpdb();
        
        // flush rewrite rules
        flush_rewrite_rules();
    }
}