<form method="post" action="options.php">

    <?php
        settings_fields( 'wp-book-option-group' );
        do_settings_sections( 'edit.php?post_type=book' );
        submit_button();
    ?>

</form>