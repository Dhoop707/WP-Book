<?php
/**
 * @package WpBook
 */

namespace Inc\Base;

class Deactivate
{
    public static function deactivate()
    {
        // flush rewrite rules
        flush_rewrite_rules();
    }
}