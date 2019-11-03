<?php
/**
 * @package WpBook
 */

namespace Inc\Api\Callbacks;

class Book_Callback
{
    /**
     * Create Metabox in CPT book
     */
    public function book_metabox_callback( $post ) {

        wp_nonce_field( 'save_author_data', 'author_metabox_nonce' );
        $author = get_metadata( 'book', $post->ID, 'author', true );
        $publisher = get_metadata( 'book', $post->ID, 'publisher', true );
        $price = get_metadata( 'book', $post->ID, 'price', true );
        $year = get_metadata( 'book', $post->ID, 'year', true );
        $edition = get_metadata( 'book', $post->ID, 'edition', true );
        $url = get_metadata( 'book', $post->ID, 'url', true );
        
        ob_start();
        ?>
            
        <table>
            <tr>
                <td> <label for="author_book_field">Author Name: </label> </td>
                <td> <input type="text" id="author_book_field" name="author_book_field" value="<?php echo esc_attr( $author ); ?>" size="25"/> </td>
            </tr>
            <tr>
                <td> <label for="publisher_book_field">Publisher: </label> </td>
                <td> <input type="text" id="publisher_book_field" name="publisher_book_field" value="<?php echo esc_attr( $publisher ); ?>" size="25"/> </td>
            </tr>
            <tr>
                <td> <label for="price_book_field">Price of book: </label> </td>
                <td> <input type="number" id="price_book_field" name="price_book_field" value="<?php echo esc_attr( $price ); ?>" min="0" /> </td>
            </tr>
            <tr>
                <td> <label for="year_book_field">Year: </label> </td>
                <td> <input type="number" id="year_book_field" name="year_book_field" value="<?php echo esc_attr( $year ); ?>" min="0" /> </td>
            </tr>
            <tr>
                <td> <label for="edition_book_field">Edition: </label> </td>
                <td> <input type="number" id="edition_book_field" name="edition_book_field" value="<?php echo esc_attr( $edition ); ?>" min="0" /> </td>
            </tr>
            <tr>
                <td> <label for="url_book_field">Url: </label> </td>
                <td> <input type="url" id="url_book_field" name="url_book_field" value="<?php echo esc_attr( $url ); ?>" /> </td>
            </tr>

        </table>
        <?php
        $output = ob_get_clean();
        echo $output;
    }

    /**
     * Save the metadata of book
     */
    public function save_book_meta( $post_id ) {
        
        if( ! isset( $_POST['author_metabox_nonce'] ) ) {
            return;
        }
        if( ! wp_verify_nonce( $_POST['author_metabox_nonce'], 'save_author_data' ) ) {
            return;
        }
        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return;
        }
        if( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // author
        if( ! isset( $_POST['author_book_field'] ) ) {
            return;
        } else {
            $my_data = sanitize_text_field( $_POST['author_book_field'] );
            update_metadata( 'book', $post_id , 'author', $my_data );
        }

        // publisher
        if( ! isset( $_POST['publisher_book_field'] ) ) {
            return;
        } else {
            $my_data = sanitize_text_field( $_POST['publisher_book_field'] );
            update_metadata( 'book', $post_id , 'publisher', $my_data );
        }

        // price
        if( ! isset( $_POST['price_book_field'] ) ) {
            return;
        } else {
            $my_data = sanitize_text_field( $_POST['price_book_field'] );
            update_metadata( 'book', $post_id , 'price', $my_data );
        }

        // year
        if( ! isset( $_POST['year_book_field'] ) ) {
            return;
        } else {
            $my_data = sanitize_text_field( $_POST['year_book_field'] );
            update_metadata( 'book', $post_id , 'year', $my_data );
        }
    
        // edition
        if( ! isset( $_POST['edition_book_field'] ) ) {
            return;
        } else {
            $my_data = sanitize_text_field( $_POST['edition_book_field'] );
            update_metadata( 'book', $post_id , 'edition', $my_data );
        }

        // url
        if( ! isset( $_POST['url_book_field'] ) ) {
            return;
        } else {
            $my_data = sanitize_text_field( $_POST['url_book_field'] );
            update_metadata( 'book', $post_id , 'url', $my_data );
        }

    }
    
}