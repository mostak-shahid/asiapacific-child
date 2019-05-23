<?php /*Template Name: Price Page Template*/ ?>
<?php 
global $mosacademy_options;
$avobe_page = get_post_meta( get_the_ID(), '_mosacademy_avobe_page', true );
$before_page = get_post_meta( get_the_ID(), '_mosacademy_before_page', true );
$after_page = get_post_meta( get_the_ID(), '_mosacademy_after_page', true );
$below_page = get_post_meta( get_the_ID(), '_mosacademy_below_page', true );

$all_sections = get_post_meta( get_the_ID(), '_mosacademy_page_section_layout', true );
$sections = ( @$all_sections["Enabled"] ) ? @$all_sections["Enabled"] : $mosacademy_options['page-layout-settings']['Enabled'];
?>
<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
?>
<?php 
get_header(); 
echo do_shortcode( $avobe_page );
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_page', $page_details ); 
?>
<?php $image_per_page =  get_post_meta( get_the_ID(), '_mosacademy_image_per_page', true ) ? get_post_meta( get_the_ID(), '_mosacademy_image_per_page', true ) : 6;?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mosacademy_page_layout', true )? get_post_meta( get_the_ID(), '_mosacademy_page_layout', true ) : $mosacademy_options['general-page-layout']; ?>
<section id="price-page" class="page-content">
	<div class="content-wrap">

		<?php 
		/*
		* action_before_gallery_page hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_page', $page_details ); 
		echo do_shortcode( $before_page );
		?>
		<?php if($page_layout != 'ns') : ?>
			<div class="row">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
			<?php endif; ?>
				<?php if ( have_posts() ) :?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php do_action( 'action_before_page_content_area', $page_details ); ?>	
					<?php get_template_part( 'content', 'page' ); ?>
					<?php $price_details = get_post_meta( get_the_ID(), '_mosacademy_child_price_details_group', true );?>
					<?php if (@$price_details) : ?>
						<div class="prices">
							<div class="row">
							<?php foreach ($price_details as $price):?>
								<div class="col-lg-4 unit text-center">
									<div class="price-header"><?php echo $price['_mosacademy_child_price_title'] ?></div>
									<div class="price-desc"><?php echo do_shortcode( $price['_mosacademy_child_price_details'] ) ?></div>
								</div>
							<?php endforeach; ?>								
							</div>
						</div>
					<?php endif;?>	
					<?php do_action( 'action_after_page_content_area', $page_details ); ?>
					</div>				
				<?php endif; ?>
			<?php if($page_layout != 'ns') : ?>
				</div>
				<div class="page-widgets col-md-4 <?php if($page_layout == 'ls') echo 'col-md-pull-8' ?>">
					<?php get_sidebar('page');?>
				</div>
			</div>
			<?php endif; ?>
		<?php 
		/*
		* action_after_gallery_page hook
		* @hooked end_div 10
		*/
		echo do_shortcode( $after_page ); 
		do_action( 'action_after_page', $page_details );
		?>
	</div>
</section>
<?php 
echo do_shortcode( $below_page );
do_action( 'action_below_page', $page_details ); 
?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>
