<?php
/**
 * Template Name: Single Post Projek
 * Template Post Type: projek
 * 
 * Template Description...
 **/
?>
<?php get_header();?>
<?php get_sidebar(); ?>

<div class="container pt-5 pb-5">


    <?php if (has_post_thumbnail()):?>

        <img src="<?php the_post_thumbnail_url('largest');?>" class="img-fluid">

    <?php endif;?>

    <?php if (have_posts()) : while (have_posts()) : the_post();?>

        <?php the_content();?>

    <?php endwhile; endif;?>


</div>

<?php get_footer();?>

<h2>custom template post</h2>