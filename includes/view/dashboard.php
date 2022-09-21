<p>
    <?php
        global $current_user;

        printf(
            wp_kses_post( __( 'Hello %1$s, (not %1$s? <a href="%2$s">Sign out</a>)', 'wp-user-frontend' ) ),
            '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
            esc_url( wp_logout_url( get_permalink() ) )
        );
    ?>
</p>