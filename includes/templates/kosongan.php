<?php
/**
 * Template Name: Kosongan
 * Template Post Type: page
 * A simple template for blank pages.
 */

?>

<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>

<!-- STARTR HEADER -->
<?php get_header(); ?>
<!-- END HEADER -->

<!-- START CONTENT -->
<?php the_content(); ?>
<!-- END CONTENT -->

<!-- START FOOTER -->
<?php get_footer(); ?>
<!-- END FOOTER -->