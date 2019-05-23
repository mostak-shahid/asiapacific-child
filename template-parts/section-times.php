<?php 
global $mosacademy_options;
$animation = $mosacademy_options['sections-times-animation'];
$animation_delay = ( $mosacademy_options['sections-times-animation-delay'] ) ? $mosacademy_options['sections-times-animation-delay'] : 0;
$title = $mosacademy_options['sections-times-title'];
$content = $mosacademy_options['sections-times-content'];
$time_table = array();


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_times', $page_details ); 
?>
<section id="section-times" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_times hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_times', $page_details ); 
		?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php $categories = mos_get_terms ('class-category');?>


				<!-- Nav tabs -->
				<ul class="nav justify-content-center">
				<?php if (sizeof($categories)) : ?>
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#all">All</a>
					</li>
					<?php foreach ($categories as $category) : ?>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#class-cat-<?php echo $category["term_id"] ?>"><?php echo $category["name"] ?></a>
					</li>
					<?php endforeach; ?>
				<?php endif; ?>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<?php if (sizeof($categories)) : ?>
					<?php 
						$sun = $mon = $tue = $wed = $thu = $fri = $sat = array();
						$n = 1;
						$args = array(
							'post_type' => 'class',
							'posts_per_page' => -1,
							'order'   => 'ASC',
						);
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts()) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$day = get_post_meta( get_the_ID(), '_mosacademy_child_calass_day', true );
								if ($day == 'sun') $sun[] = get_the_ID();
								elseif ($day == 'mon') $mon[] = get_the_ID();
								elseif ($day == 'tue') $tue[] = get_the_ID();
								elseif ($day == 'wed') $wed[] = get_the_ID();
								elseif ($day == 'thu') $thu[] = get_the_ID();
								elseif ($day == 'fri') $fri[] = get_the_ID();
								elseif ($day == 'sat') $sat[] = get_the_ID();
							}
							wp_reset_postdata();
						}
						?>
					<div id="all" class="container tab-pane active">
						<div class="table-responsive">
							<table class="table text-center">
								<thead class="thead-dark">
									<tr>
										<th scope="col" style="width: 14.285714285%">Sunday</th>
										<th scope="col" style="width: 14.285714285%">Monday</th>
										<th scope="col" style="width: 14.285714285%">Tuesday</th>
										<th scope="col" style="width: 14.285714285%">Wednesday</th>
										<th scope="col" style="width: 14.285714285%">Thursday</th>
										<th scope="col" style="width: 14.285714285%">Friday</th>
										<th scope="col" style="width: 14.285714285%">Saturday</th>

									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<?php 
											function generate_func($value){
												$class_cats = get_the_terms( $value, 'class-category' );
												$n = 0;
												?>
												<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong><br><strong><?php foreach ($class_cats as $class_cat){echo $class_cat->name;if($n) echo ', '; $n++;}?></strong></span>
												<?php
											} 
											?>
											<?php if ($sun) : ?>
												<?php foreach ($sun as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($mon) : ?>
												<?php foreach ($mon as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($tue) : ?>
												<?php foreach ($tue as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($wed) : ?>
												<?php foreach ($wed as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($thu) : ?>
												<?php foreach ($thu as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($fri) : ?>
												<?php foreach ($fri as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($sat) : ?>
												<?php foreach ($sat as $value) : ?>
													<?php generate_func($value) ?>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<?php foreach ($categories as $category) : ?>
						<?php 
						$sun = $mon = $tue = $wed = $thu = $fri = $sat = array();
						$n = 1;
						$args = array(
							'post_type' => 'class',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => 'class-category',
									'field'    => 'slug',
									'terms'    => $category["slug"],
								),
							),
						);
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts()) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								$day = get_post_meta( get_the_ID(), '_mosacademy_child_calass_day', true );
								if ($day == 'sun') $sun[] = get_the_ID();
								elseif ($day == 'mon') $mon[] = get_the_ID();
								elseif ($day == 'tue') $tue[] = get_the_ID();
								elseif ($day == 'wed') $wed[] = get_the_ID();
								elseif ($day == 'thu') $thu[] = get_the_ID();
								elseif ($day == 'fri') $fri[] = get_the_ID();
								elseif ($day == 'sat') $sat[] = get_the_ID();
							}
							wp_reset_postdata();
						}
						?>
					<div id="class-cat-<?php echo $category["term_id"] ?>" class="container tab-pane">
						<div class="table-responsive">
							<table class="table text-center">
								<thead class="thead-dark">
									<tr>
										<th scope="col" style="width: 14.285714285%">Sunday</th>
										<th scope="col" style="width: 14.285714285%">Monday</th>
										<th scope="col" style="width: 14.285714285%">Tuesday</th>
										<th scope="col" style="width: 14.285714285%">Wednesday</th>
										<th scope="col" style="width: 14.285714285%">Thursday</th>
										<th scope="col" style="width: 14.285714285%">Friday</th>
										<th scope="col" style="width: 14.285714285%">Saturday</th>

									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<?php if ($sun) : ?>
												<?php foreach ($sun as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($mon) : ?>
												<?php foreach ($mon as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($tue) : ?>
												<?php foreach ($tue as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($wed) : ?>
												<?php foreach ($wed as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($thu) : ?>
												<?php foreach ($thu as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($fri) : ?>
												<?php foreach ($fri as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<?php if ($sat) : ?>
												<?php foreach ($sat as $value) : ?>
													<span class="table-span"><?php echo get_post_meta( $value, '_mosacademy_child_calass_start', true ) ?>-<?php echo get_post_meta( $value, '_mosacademy_child_calass_end', true ) ?><br><strong><?php echo get_the_title( $value ) ?></strong></span>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
				</div>
		<?php 
		/*
		* action_after_times hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_times', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_times', $page_details  ); ?>