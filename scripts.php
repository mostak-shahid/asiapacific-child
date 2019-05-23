<?php 
global $mosacademy_options; 
function child_gradient_manager($options) {
	$from = $options['from'];
	$to = $options['to'];
	echo 'background: '.$from.';';
	echo 'background: -moz-linear-gradient(top,  '.$from.' 0%, '.$to. ' 100%);';
	echo 'background: -webkit-linear-gradient(top,  '.$from.' 0%, '.$to. ' 100%);';
	echo 'background: linear-gradient(to bottom, '.$from.' 0%, '.$to. ' 100%);';
	echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$from.'", endColorstr="'.$to.'",GradientType=0 );';
}
function child_background_manager ($options) {
    foreach ($options as $key => $value){
		if($key != 'media' AND $value) {
			if( $key !='background-image') {
				echo $key . ':' . $value . ';';
			} else {
				echo $key . ':url(' . $value . ');';					
			}
		}
    }
}
function child_rgba_manager ($options) {
	echo 'background-color: '. $options['rgba'];
}
function child_theme_css () {
	global $mosacademy_options; 
?>
<style>
#section-feed {<?php if ($mosacademy_options['sections-feed-background-type'] == 1) : ?>
	<?php child_gradient_manager($mosacademy_options['sections-feed-background-gradient'])?>
<?php elseif ($mosacademy_options['sections-feed-background-type'] == 2) : ?>
	<?php child_background_manager($mosacademy_options['sections-feed-background-solid'])?>
<?php elseif ($mosacademy_options['sections-feed-background-type'] == 3 AND $mosacademy_options['sections-feed-background-rgba']['rgba']) : ?>
	<?php child_rgba_manager($mosacademy_options['sections-feed-background-rgba'])?>
<?php endif; ?>}
#section-times {<?php if ($mosacademy_options['sections-times-background-type'] == 1) : ?>
	<?php child_gradient_manager($mosacademy_options['sections-times-background-gradient'])?>
<?php elseif ($mosacademy_options['sections-times-background-type'] == 2) : ?>
	<?php child_background_manager($mosacademy_options['sections-times-background-solid'])?>
<?php elseif ($mosacademy_options['sections-times-background-type'] == 3 AND $mosacademy_options['sections-times-background-rgba']['rgba']) : ?>
	<?php child_rgba_manager($mosacademy_options['sections-times-background-rgba'])?>
<?php endif; ?>}
#section-testimonial {<?php if ($mosacademy_options['sections-testimonial-background-type'] == 1) : ?>
	<?php child_gradient_manager($mosacademy_options['sections-testimonial-background-gradient'])?>
<?php elseif ($mosacademy_options['sections-testimonial-background-type'] == 2) : ?>
	<?php child_background_manager($mosacademy_options['sections-testimonial-background-solid'])?>
<?php elseif ($mosacademy_options['sections-testimonial-background-type'] == 3 AND $mosacademy_options['sections-testimonial-background-rgba']['rgba']) : ?>
	<?php child_rgba_manager($mosacademy_options['sections-testimonial-background-rgba'])?>
<?php endif; ?>}
</style>
<?php
}
add_action( 'wp_head', 'child_theme_css', 999, 1 );
function child_theme_js () {
	global $mosacademy_options; 
?>
<script>
	jQuery(document).ready(function($) {
	});
</script>
	<?php
}
add_action( 'wp_footer', 'child_theme_js', 998, 1 );