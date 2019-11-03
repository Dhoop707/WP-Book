<?php
/**
 * @package WpBook
 */

namespace Inc\Pages;

use Inc\Api\Meta_Table;

class Book_Metabox
{

    public $book_meta;

    public function __construct()
    {
        $this->book_meta = new Meta_Table;   
    }

    public function register() {
        
    }

}
