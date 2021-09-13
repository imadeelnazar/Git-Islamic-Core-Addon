<?php
/**
 * Plugin Name: Kodeforest Contact Us
 * Plugin URI: http://kodeforest.com/
 * Description: A widget contains the contact information( Specified by category ).
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_contact_widget' );
if( !function_exists('islamic_center_contact_widget') ){
	function islamic_center_contact_widget() {
		register_widget( 'Kodeforest_Contact' );
	}
}

if( !class_exists('Kodeforest_Contact') ){
	class Kodeforest_Contact extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_contact_widget', 
				esc_html__('Kodeforest Contact Info Widget','islamic-center'), 
				array('description' => esc_html__('A widget that show contact information.', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {			
			
			$title = isset($instance['title'])? $instance['title']: '';
			$logo = isset($instance['logo'])? $instance['logo']: '';
			$style = isset($instance['style'])? $instance['style']: '';
			$desc = isset($instance['desc'])? $instance['desc']: '';
			$address = isset($instance['address'])? $instance['address']: '';
			$phone = isset($instance['phone'])? $instance['phone']: '';
			$email = isset($instance['email'])? $instance['email']: '';
			$facebook = isset($instance['facebook'])? $instance['facebook']: '';
			$twitter = isset($instance['twitter'])? $instance['twitter']: '';
			$vimeo = isset($instance['vimeo'])? $instance['vimeo']: '';
			$tumblr = isset($instance['tumblr'])? $instance['tumblr']: '';
			$camera = isset($instance['camera'])? $instance['camera']: '';
			

			// Opening of widget
			echo $args['before_widget'];
			if($style == 'style-1'){ ?>
				<div class="widget_logo">
					<a href="#"><img src="<?php echo esc_url($logo); ?>" alt=""></a>
					<p><?php echo esc_attr($desc); ?></p>
					<ul class="widget_call_info">
						<?php if(!empty($address)){ ?><li><a href="#"><i class="fa fa-map-marker"></i><p><?php echo esc_attr($address); ?></p></a></li><?php }?>
						<?php if(!empty($phone)){ ?><li><a href="#"><i class="fa fa-phone"></i><p><?php echo esc_attr($phone); ?></p></a></li><?php }?>
						<?php if(!empty($email)){ ?><li><a href="#"><i class="fa fa-envelope"></i><p><?php echo esc_attr($email); ?></p></a></li><?php }?>
					</ul>
					<ul class="widget_social_icon">
					<?php if(!empty($facebook)){ ?>
						<li><a class="hvr-ripple-out" href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
					<?php } if(!empty($twitter)){ ?>
						<li><a class="hvr-ripple-out" href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
					<?php } if(!empty($tumblr)){ ?>
						<li><a class="hvr-ripple-out" href="<?php echo esc_url($tumblr);?>"><i class="fa fa-tumblr"></i></a></li>
					<?php } if(!empty($vimeo)){ ?>	
						<li><a class="hvr-ripple-out" href="<?php echo esc_url($vimeo);?>"><i class="fa fa-vimeo"></i></a></li>
					<?php } if(!empty($camera)){ ?>	
						<li><a class="hvr-ripple-out" href="<?php echo esc_url($camera);?>"><i class="fa fa-camera-retro"></i></a></li>
					<?php } ?>	
					</ul>
				</div>
			<?php }else{ ?>
				<div class="siderbar_categories sidebar_bg">  
					<?php if( !empty($title) ){ 
						echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
					} ?>
					<div class="kode_side_contact_text">
						<p><?php echo esc_attr($desc); ?></p>
						<a href="#"><span><i class="fa fa-phone"></i></span><?php echo esc_attr($phone); ?></a>
						<a href="#"><span><i class="fa fa-envelope"></i></span><?php echo esc_attr($email); ?></a>
						<a href="#"><span><i class="fa fa-address-card"></i></span><?php echo esc_attr($address); ?></a>
					</div>
				</div>
			<?php }
			?>
			
			<!--// TextWidget //-->
				
			<!--// TextWidget //-->	
		<?php
				
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$style = isset($instance['style'])? $instance['style']: '';
			$logo = isset($instance['logo'])? $instance['logo']: '';
			$desc = isset($instance['desc'])? $instance['desc']: '';
			$address = isset($instance['address'])? $instance['address']: '';
			$phone = isset($instance['phone'])? $instance['phone']: '';
			$email = isset($instance['email'])? $instance['email']: '';
			$facebook = isset($instance['facebook'])? $instance['facebook']: '';
			$twitter = isset($instance['twitter'])? $instance['twitter']: '';
			$vimeo = isset($instance['vimeo'])? $instance['vimeo']: '';
			$tumblr = isset($instance['tumblr'])? $instance['tumblr']: '';
			$camera = isset($instance['camera'])? $instance['camera']: '';
			
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('logo')); ?>"><?php esc_html_e('Logo :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('logo')); ?>" name="<?php echo esc_attr($this->get_field_name('logo')); ?>" type="text" value="<?php echo esc_attr($logo); ?>" />
			</p>	
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php esc_html_e('Style :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
					<option value="style-1" <?php if ($style == 'style-1') echo ' selected '; ?>><?php echo esc_attr__('Style 1','islamic-center'); ?></option>
					<option value="style-2" <?php if ($style == 'style-2') echo ' selected '; ?>><?php echo esc_attr__('Style 2','islamic-center'); ?></option>				
				</select> 
			</p>
			<!-- Widget Description --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php esc_html_e('Description :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" type="text" value="<?php echo esc_attr($desc); ?>" />
			</p>
			
			<!-- Widget address --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_attr($address); ?>" />
			</p>
			
			<!-- Widget phone --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
			</p>
			
			<!-- Widget email --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
			</p>
					
			<!-- Widget Link --> 	
		
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook Social URL :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter Social URL :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php esc_html_e('Vimeo Social URL :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php esc_html_e('Tumblr Social URL :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('camera')); ?>"><?php esc_html_e('Camera Social URL :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('camera')); ?>" name="<?php echo esc_attr($this->get_field_name('camera')); ?>" type="text" value="<?php echo esc_attr($camera); ?>" />
			</p>

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['logo'] = (empty($new_instance['logo']))? '': strip_tags($new_instance['logo']);
			$instance['style'] = (empty($new_instance['style']))? '': strip_tags($new_instance['style']);
			$instance['desc'] = (empty($new_instance['desc']))? '': strip_tags($new_instance['desc']);
			$instance['address'] = (empty($new_instance['address']))? '': strip_tags($new_instance['address']);
			$instance['phone'] = (empty($new_instance['phone']))? '': strip_tags($new_instance['phone']);
			$instance['email'] = (empty($new_instance['email']))? '': strip_tags($new_instance['email']);
			$instance['facebook'] = (empty($new_instance['facebook']))? '': $new_instance['facebook'];	
			$instance['twitter'] = (empty($new_instance['twitter']))? '': $new_instance['twitter'];
			$instance['vimeo'] = (empty($new_instance['vimeo']))? '': $new_instance['vimeo'];
			$instance['tumblr'] = (empty($new_instance['tumblr']))? '': $new_instance['tumblr'];
			$instance['camera'] = (empty($new_instance['camera']))? '': $new_instance['camera'];

			return $instance;
		}	
	}
}
?>