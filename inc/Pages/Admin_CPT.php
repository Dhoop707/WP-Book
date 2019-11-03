<?php
/**
 * @package WpBook
 */

namespace Inc\Pages;

/*
    ======================
        Admin_CPT class
    ======================
*/
class Admin_CPT
{
    /**
     * Registering CPT, Hierarchical taxonomy, Non-hierarchical taxonomy related to book.
     */
    public function register() {

        add_action( 'init', array( $this, 'register_custom_post_type' ) );
        add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
    }

    /**
     * Register CPT book
     * @return
     */
    public function register_custom_post_type() {

        $labels = array(
            'name'                  => __( 'Books', 'rt-book' ),
            'singular_name'         => __( 'Book', 'rt-book' ),
            'menu_name'             => __( 'Books', 'rt-book' ),
            'name_admin_bar'        => __( 'Book', 'rt-book' ),
            'add_new'               => __( 'Add New', 'rt-book' ),
            'add_new_item'          => __( 'Add New Book', 'rt-book' ),
            'new_item'              => __( 'New Book', 'rt-book' ),
            'edit_item'             => __( 'Edit Book', 'rt-book' ),
            'view_item'             => __( 'View Book', 'rt-book' ),
            'all_items'             => __( 'All Books', 'rt-book' ),
            'search_items'          => __( 'Search Books', 'rt-book' ),
            'parent_item_colon'     => __( 'Parent Books:', 'rt-book' ),
            'not_found'             => __( 'No books found.', 'rt-book' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'rt-book' ),
            'featured_image'        => __( 'Book Cover Image', 'rt-book' ),
            'set_featured_image'    => __( 'Set cover image', 'rt-book' ),
            'remove_featured_image' => __( 'Remove cover image', 'rt-book' ),
            'use_featured_image'    => __( 'Use as cover image', 'rt-book' ),
            'archives'              => __( 'Book archives', 'rt-book' ),
            'insert_into_item'      => __( 'Insert into book', 'rt-book' ),
            'uploaded_to_this_item' => __( 'Uploaded to this book', 'rt-book' ),
            'filter_items_list'     => __( 'Filter books list', 'rt-book' ),
            'items_list_navigation' => __( 'Books list navigation', 'rt-book' ),
            'items_list'            => __( 'Books list', 'rt-book' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type( 'book', $args );

    }

    /**
     * register taxonomy for CPT book
     */
    public function register_custom_taxonomy() {

        // Hierarchical
        $args = [
            'labels' => $this->get_labels( 'Categorie' ),
            'public' => true,
            'rewrite' => array( 'slug' => 'books/categories' ),
            'hierarchical' => true,
        ];
        register_taxonomy( 'book-categories', 'book', $args );

        // Non-Hierarchical
        $args = [
            'labels' => $this->get_labels( 'Tag' ),
            'public' => true,
            'rewrite' => array( 'slug' => 'books/tags' ),
            'hierarchical' => false,
        ];
        register_taxonomy( 'book-tags', 'book', $args );
    }

    /**
     * generate labels for taxonomy
     * @return array    array of labels
     */
    public function get_labels( string $type ) {
        return [
            'name'              => __( 'Book ' . $type . 's', 'rt-book' ),
            'singular_name'     => __( 'Book ' . $type, 'rt-book' ),
            'popular_items'     => __( 'Popular Book ' . $type . 's', 'rt-book' ),
            'edit_item'         => __( 'Edit Book '. $type, 'rt-book'),
            'view_item'         => __( 'View Book ' . $type, 'rt-book' ),
            'update_item'       => __( 'Update Book ' . $type, 'rt-book' ),
            'add_new_item'      => __( 'Add New Book ' . $type, 'rt-book' ),
            'most_used'         => __( 'Most Used Book ' . $type . 's', 'rt-book' ),
        ];
    }

}