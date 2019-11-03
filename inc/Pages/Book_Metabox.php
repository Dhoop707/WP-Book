<?php
/**
 * @package WpBook
 */

namespace Inc\Pages;

use Inc\Api\Callbacks\Book_Callback;
use Inc\Api\Meta_Table;

class Book_Metabox
{
    public $book_callback;
    public $meta_tab;

    public function __construct()
    {
        $this->meta_tab = new Meta_Table;
        $this->book_callback = new Book_Callback;

        add_action( 'init', array( $this->meta_tab , 'register_table_with_wpdb' ), 0 );
    }

    public function register() {
        add_action( 'add_meta_boxes', array( $this, 'add_book_metadata') );
        add_action( 'save_post', array( $this, 'save_book_metadata' ) );
    }

    public function add_book_metadata() {
        add_meta_box( 'book_meta_data', __( 'Additional Information', 'rt-book' ), array( $this->book_callback, 'book_metabox_callback' ), 'book' );
    }

    public function save_book_metadata( $id ) {
        $this->book_callback->save_book_meta( $id );
    }

}
