<?php
/**
 * Template Name: Detail Product
 * Template Post Type: Post
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
<section id="content" class="full-width">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<!-- <?php avada_singular_featured_image(); ?> -->

			<div class="post-content">
				<div class="fusion-fullwidth fullwidth-box fusion-builder-row-2 fusion-flex-container fusion-parallax-none nonhundred-percent-fullwidth non-hundred-percent-height-scrolling" style="background-color: rgba(255,255,255,0);background-image: url(&quot;https://dewanstudio.biz/SIT/eria/wp-content/uploads/2022/08/bg-private-sector.jpg&quot;);background-position: center top;background-repeat: no-repeat;border-width: 0px 0px 0px 0px;border-color:#e2e2e2;border-style:solid;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;">
					<div class="fusion-builder-row fusion-row fusion-flex-align-items-center" style="max-width:1248px;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );">
						<div class="fusion-layout-column fusion_builder_column fusion-builder-column-1 fusion_builder_column_1_1 1_1 fusion-flex-column">
							
							<div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column" style="background-position: left top; background-repeat: no-repeat; background-size: cover; padding: 0px; min-height: 0px;">
								<style type="text/css">
									@media only screen and (max-width:1024px) {.fusion-title.fusion-title-2{margin-top:-20px!important; margin-right:0px!important;margin-bottom:15px!important;margin-left:0px!important;}}@media only screen and (max-width:640px) {.fusion-title.fusion-title-2{margin-top:10px!important; margin-right:0px!important;margin-bottom:10px!important; margin-left:0px!important;}}
								</style>
								<div class="fusion-title title fusion-title-2 fusion-sep-none fusion-title-center fusion-title-text fusion-title-size-one fusion-border-below-title" style="text-shadow:3px 3px 10px rgba(0,0,0,0.8);;margin-top:-20px;margin-right:0px;margin-bottom:15px;margin-left:0px;">
									<h1 class="title-heading-center" style="margin:0;color:#ffffff;"><?php echo get_the_title();?></h1>
								</div>
							</div>
							
							<style type="text/css">
								.fusion-body .fusion-builder-column-1{width:100% !important;margin-top : 0px;margin-bottom : 20px;}.fusion-builder-column-1 > .fusion-column-wrapper {padding-top : 0px !important;padding-right : 0px !important;margin-right : 1.92%;padding-bottom : 0px !important;padding-left : 0px !important;margin-left : 1.92%;}@media only screen and (max-width:1024px) {.fusion-body .fusion-builder-column-1{width:100% !important;order : 0;}.fusion-builder-column-1 > .fusion-column-wrapper {margin-right : 1.92%;margin-left : 1.92%;}}@media only screen and (max-width:640px) {.fusion-body .fusion-builder-column-1{width:100% !important;order : 0;}.fusion-builder-column-1 > .fusion-column-wrapper {margin-right : 1.92%;margin-left : 1.92%;}}</style></div></div><style type="text/css">.fusion-body .fusion-flex-container.fusion-builder-row-2{ padding-top : 15%;margin-top : 0px;padding-right : 30px;padding-bottom : 15%;margin-bottom : 0px;padding-left : 30px;}
							</style>
						</div>
					</div>
				</div>

				<div class="fusion-fullwidth fullwidth-box fusion-builder-row-3 fusion-flex-container nonhundred-percent-fullwidth non-hundred-percent-height-scrolling" style="padding: 0px 5rem;">
					<div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start">

						<div class="col-md-3">
							<div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column">
								<h3 class="custom-tab-left-title">Solution Types</h3>
								<div class="">
									<ul>
										<li>Lorem list kategori</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-md-9">
							<div class="fusion-column-wrapper fusion-flex-justify-content-flex-start fusion-content-layout-column">

								<div class="fusion-title title fusion-title-3 fusion-sep-none fusion-title-text fusion-title-size-one fusion-border-below-title">
									<h1 class="title-heading-left">
										<strong><?php echo get_the_title();?></strong>
									</h1>
								</div>

								<div class="fusion-title title fusion-title-4 fusion-sep-none fusion-title-text fusion-title-size-four fusion-border-below-title">
									<h4 class="title-heading-left">
										<strong>Lorem Kategori</strong>
										<p>Kategori : 
											<?php   $category_detail=get_the_category($_GET['id']);
												foreach($category_detail as $cd){
												echo $cd->cat_name;
												echo "<br>";
											}?>
										</p>
									</h4>
								</div>
								
								<div class="fusion-separator fusion-full-width-sep" style="align-self: center;margin-left: auto;margin-right: auto;margin-top:20px;width:100%;"></div>

								<div class="fusion-text fusion-text-1">
									<div class="pt-3 text-muted font-thin mb-0">
										<!-- <?php the_content(); ?> -->
										<?php echo get_post_meta( $post->ID,'long_description', true );?>
									</div>
								</div>

								<div class="fusion-separator fusion-full-width-sep" style="align-self: center;margin-left: auto;margin-right: auto;margin-top:70px;width:100%;"></div>

								<div class="">
									<div class="">
										<h2 class="title-heading-left">Company Information</h2>
									</div>

									<div class="fusion-text fusion-text-2">
										<p><?php echo get_user_meta($post->post_author,'company_name',true);?></p>
									</div>

									<div class="">
										<h4 class="title-heading-left title-heading-tag">
											<strong><?php echo get_user_meta($post->post_author,'company_city',true);?></strong>
										</h4>
									</div>
									<div class="fusion-text fusion-text-3">
										<p>Headquarter : <?php echo get_user_meta($post->post_author,'company_city',true);?>, <?php echo get_user_meta($post->post_author,'company_country',true);?></p>
									</div>

									<div class="">
										<h4 class="title-heading-left title-heading-tag">
											<strong>Contact</strong>
										</h4>
									</div>
									<div class="fusion-text fusion-text-3">
										<p>E : <a href="mailto:csr@ana.co.jp"><?php echo get_user_meta($post->post_author,'email',true);?></a></p>
										<p>W : <a href="https://www.ana.co.jp/"><?php echo get_user_meta($post->post_author,'website',true);?></a></p>
									</div>
									
								</div>

								<div class="fusion-separator fusion-full-width-sep" style="align-self: center;margin-left: auto;margin-right: auto;margin-top:70px;width:100%;"></div>

							</div>
						</div>
					</div>
				</div>
				
				<?php fusion_link_pages(); ?>
			</div>

			
			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php if ( Avada()->settings->get( 'comments_pages' ) ) : ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
</section>
<!-- END CONTENT -->

<!-- START FOOTER -->
<style>
html:not(.avada-has-site-width-percent) #main {
	padding: 0;
}
#main .fusion-row {
	max-width: 100%;
}
</style>
<?php get_footer(); ?>
<!-- END FOOTER -->