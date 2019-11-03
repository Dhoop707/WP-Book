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
        
        // flush rewrite rules
        flush_rewrite_rules();
    }
}