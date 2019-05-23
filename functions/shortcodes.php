<?php
function final_social_func( $atts = array(), $content = '' ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
		$alt_tag = mos_alt_generator(get_the_ID());
	} 
	global $mosacademy_options;
	$html = '';

	$html .= '<ul class="list-inline social-menu">';
	   $html .= '<li class="social-list facebook list-inline-item"><a class="dropdown-activator" href="javascript:void(0)" target="_blank"><span class="social-img"><img src="'.$mosacademy_options['contact-social'][0]['basic_icon'].'" alt="'.$alt_tag['social'].' | Facebook" width="8" height="17"></span><span class="social-img-hover"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/facebook-hover.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | Facebook" width="8" height="17"></span></a><div class="dropdown"><a href="'.esc_url(do_shortcode($mosacademy_options['contact-social']['0']['link_url'])).'" target="_blank">'.do_shortcode($mosacademy_options['contact-social']['0']['title']).'</a><a href="'.esc_url(do_shortcode($mosacademy_options['contact-social']['1']['link_url'])).'" target="_blank">'.do_shortcode($mosacademy_options['contact-social']['1']['title']).'</a></div></li>';
	   $html .= '<li class="social-list instagram list-inline-item"><a href="https://www.instagram.com/asiapacificselfdefence/" target="_blank"><span class="social-img"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/instgram.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | instagram" width="18" height="16"></span><span class="social-img-hover"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/instgram-hover.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | instagram" width="18" height="16"></span></a></li>';
	   $html .= '<li class="social-list twitter list-inline-item"><a href="https://twitter.com/PacificSelfdefe" target="_blank"><span class="social-img"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/twitter.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | Twitter" width="18" height="16"></span><span class="social-img-hover"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/twitter-hover.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | Twitter" width="18" height="16"></span></a></li>';
	   $html .= '<li class="social-review list-inline-item"><a href="https://goo.gl/rtZ7Pm" target="_blank"><span class="social-img"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/google-review.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | Google Review" width="21" height="20"></span><span class="social-img-hover"><img src="http://asiapacificdefence.belocal.today/wp-content/uploads/2019/04/google-review.png" alt="Martial Arts | Mount Ommaney | Asia Pacific Self Defence | Google Review" width="21" height="20"></span></a></li>';
	$html .= '</ul>';
	return $html;
}
add_shortcode( 'final-social', 'final_social_func' );
?>

