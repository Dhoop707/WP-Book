<?php
/**
 * @package WpBook
 */

namespace Inc\Pages;

/*
    ========================
       Custom_Widget class
    ========================
*/

class Custom_Widget
{
    /**
     * Register All the Widgets here.
     */
    public function register() {
        add_action( 'widgets_init', array( $this, 'loading_book_widget' ) );
    }

    public function loading_book_widget() {
        register_widget( 'Inc\\Pages\\My_Book_Widget' );
    } 

}

class My_Book_Widget extends \WP_Widget{

    /**
     * Constructor for initialization of widget title, discription
    */

    public function __construct()
    {
        parent::__construct(
            'my_book_widget',
            __( 'Books', 'rt-book'),
            [
                'classname' => 'My_Book_Widget',
                'description' => __( 'Display Books of selected categories', 'rt-book' ),
            ]
        );
    }

    /**
     * Widget Back-end
     */
    public function form( $instance ) {

        global $wpdb;
        $categories = $wpdb->get_results( 'select name, slug from wp_terms where term_id in ( select term_id from wp_term_taxonomy where taxonomy = "book-categories" )' );

        foreach( $categories as $cate ) {
            if( ! isset($instance[ $cate->slug ]) ) {
                $instance[ $cate->slug ] = 0;   
            }
        }

        foreach( $categories as $cate ) { ?>
            
            <p>
                <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( $cate->slug ); ?>" name="<?php echo $this->get_field_name( $cate->slug ); ?>" value="1" <?php if ( 1 == $instance[ $cate->slug ] ) echo 'checked="checked"'; ?> /> 
                <label for="<?php echo $this->get_field_id( $cate->slug ); ?>"> <?php echo $cate->name; ?> </label>
            </p>

        <?php } 

    }

    /**
     * Update old value to new
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance = $new_instance;
        return $instance;
    }

    /**
     * Widget Front-end
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];
        echo $args['before_title'];
        echo __( 'Books' , 'rt-book');
        echo $args['after_title'];

        global $wpdb;
        $categories = $wpdb->get_results( 'select name, slug from wp_terms where term_id in ( select term_id from wp_term_taxonomy where taxonomy = "book-categories" )' );
        $cat = array();
        foreach( $categories as $cate ) {
            if( isset( $instance[ $cate->slug] ) ) {
                $cat[] = $cate->slug;
            }
        }        

        $argss = array(
            'post_type' => 'book',
            'tax_query' => array(
                array(
                    'taxonomy'  => 'book-categories',
                    'field'     => 'slug',
                    'terms'     => $cat,
                ),
            ),
        );

        $content = '<div>';
        $query = new \WP_Query( $argss );
        if( $query->have_posts() ):
            
            while( $query->have_posts() ): $query->the_post();
                $id = get_the_ID();
                $content .= the_title( '<li><a href="'. esc_attr( get_post_permalink( $id ) ) .'">', "</a></li>", false );
            endwhile;
            wp_reset_postdata();
        else:
            $content .= 'Not Found any books';
        endif;
        $content .= "</div>";

        echo $content;
        echo $args['after_widget'];
    }


}