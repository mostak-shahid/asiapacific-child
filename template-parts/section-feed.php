<?php 
global $mosacademy_options;
$animation = $mosacademy_options['sections-feed-animation'];
$animation_delay = ( $mosacademy_options['sections-feed-animation-delay'] ) ? $mosacademy_options['sections-feed-animation-delay'] : 0;
$title = $mosacademy_options['sections-feed-title'];
$content = $mosacademy_options['sections-feed-content'];
$slides = $mosacademy_options['sections-feed-slides'];

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_feed', $page_details ); 
?>
<section id="section-feed" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_feed hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_feed', $page_details ); 
		?>
			<?php if ($title) : ?>				
				<div class="title-wrapper">
					<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
				</div>
			<?php endif; ?>
			<?php if ($content) : ?>				
				<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
			<?php endif; ?>	
			<?php // var_dump($slides) ?>
			<?php if (@$slides) : ?>
				<div <?php if (sizeof($slides) > 1) : ?> id="feed-owl" class="owl-carousel owl-theme" <?php else : ?>  id="feeds" <?php endif; ?>>
				<?php foreach ($slides as $slide):?>
					<div class="row align-items-center">
						<?php if ($slide["link_title"]) : ?>
						<div class="col-lg-6">
							<div class="embed-responsive embed-responsive-4by3">
								<iframe class="embed-responsive-item" src="<?php echo esc_url( do_shortcode( $slide["link_title"] ) ) ?>"></iframe>
							</div>							
						</div>
						<?php endif; ?>
						<div class="col-lg-6">
							<?php if ($slide["title"]) : ?>				
								<div class="title-wrapper">
									<h2 class="title"><?php echo do_shortcode( $slide["title"] ); ?></h2>				
								</div>
							<?php endif; ?>

							<?php if ($slide["attachment_id"]) : ?>
								<?php
								$img_url = aq_resize(wp_get_attachment_url( $slide["attachment_id"] ), 540);
								list($width, $height, $type, $attr) = getimagesize($img_url);
								?>
								<img class="img-fluid img-feed" src="<?php echo $img_url ?>" alt="<?php echo $alt_tag['inner'] . strip_tags(do_shortcode( $title )) ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">							
							<?php endif; ?>
							<?php if ($slide["description"]) : ?>				
								<div class="content-wrapper"><?php echo do_shortcode( $slide["description"] ) ?></div>
							<?php endif; ?>	
							<?php if ($slide["link_url"]) : ?>			
								<div class="url-wrapper"><a href="<?php echo do_shortcode( $slide["link_url"] ) ?>" class="btn btn-feed" <?php if ($slide['target']) echo 'target="_blank"' ?>>Read More</a></div>
							<?php endif; ?>					
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			<?php endif ?>
		<?php 
		/*
		* action_after_feed hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_feed', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_feed', $page_details  ); ?>