<?php
/**
 * Plugin Name: Kodeforest Ad Banner
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that contains the banner information.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_ad_banner_widget' );
if( !function_exists('islamic_center_ad_banner_widget') ){
	function islamic_center_ad_banner_widget() {
		register_widget( 'Kodeforest_Ad_Banner' );
	}
}

if( !class_exists('Kodeforest_Ad_Banner') ){
	class Kodeforest_Ad_Banner extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_ad_banner_widget', 
				esc_html__('Kodeforest Bannner Ad Widget','islamic-center'), 
				array('description' => esc_html__('A widget that show contact information.', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {			
			
			$image = isset($instance['image'])? $instance['image']: '';
			$title = isset($instance['title'])? $instance['title']: '';
			$title2 = isset($instance['title2'])? $instance['title2']: '';
			$caption = isset($instance['caption'])? $instance['caption']: '';
			$short_desc = isset($instance['short_desc'])? $instance['short_desc']: '';
			$button_text = isset($instance['button_text'])? $instance['button_text']: '';
			$button_link = isset($instance['button_link'])? $instance['button_link']: '';
			
			// Opening of widget
			echo $args['before_widget'];

			?>
			<div class="sidebar_add margin">
				<figure class="them_overlay">
					<a href="#"><img src="<?php echo esc_url($image); ?>"></a>
					<figcaption>
					<a>
						<h3><?php echo esc_attr($title); ?></h3>
						<h2><?php echo esc_attr($title2); ?></h2>
						<h4><?php echo esc_attr($caption); ?></h4>
						<h5><?php echo esc_attr($short_desc); ?></h5>
					</a>
					<a class="medium_btn theme_color_bg btn_hover2" href="<?php echo esc_url($button_link); ?>"><?php echo esc_attr($button_text); ?></a>
					</figcaption>
				</figure>
			</div>
			
			<!--// TextWidget //-->	
		<?php
				
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$image = isset($instance['image'])? $instance['image']: '';
			$title = isset($instance['title'])? $instance['title']: '';
			$title2 = isset($instance['title2'])? $instance['title2']: '';
			$caption = isset($instance['caption'])? $instance['caption']: '';
			$short_desc = isset($instance['short_desc'])? $instance['short_desc']: '';
			$button_text = isset($instance['button_text'])? $instance['button_text']: '';
			$button_link = isset($instance['button_link'])? $instance['button_link']: '';
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
			</p>	

			<!-- Widget Description --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>
			
			<!-- Widget address --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title2')); ?>"><?php esc_html_e('Title 2 :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title2')); ?>" name="<?php echo esc_attr($this->get_field_name('title2')); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />
			</p>
			
			<!-- Widget phone --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('caption')); ?>"><?php esc_html_e('Caption :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('caption')); ?>" name="<?php echo esc_attr($this->get_field_name('caption')); ?>" type="text" value="<?php echo esc_attr($caption); ?>" />
			</p>
			
			<!-- Widget email --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('short_desc')); ?>"><?php esc_html_e('Short Description :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('short_desc')); ?>" name="<?php echo esc_attr($this->get_field_name('short_desc')); ?>" type="text" value="<?php echo esc_attr($short_desc); ?>" />
			</p>
					
			<!-- Widget Link --> 	
		
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>"><?php esc_html_e('External Link Text :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('button_text')); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('button_link')); ?>"><?php esc_html_e('External Link URL :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_link')); ?>" name="<?php echo esc_attr($this->get_field_name('button_link')); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" />
			</p>
		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['image'] = (empty($new_instance['image']))? '': strip_tags($new_instance['image']);
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['title2'] = (empty($new_instance['title2']))? '': strip_tags($new_instance['title2']);
			$instance['caption'] = (empty($new_instance['caption']))? '': strip_tags($new_instance['caption']);
			$instance['short_desc'] = (empty($new_instance['short_desc']))? '': strip_tags($new_instance['short_desc']);
			$instance['button_text'] = (empty($new_instance['button_text']))? '': $new_instance['button_text'];	
			$instance['button_link'] = (empty($new_instance['button_link']))? '': $new_instance['button_link'];

			return $instance;
		}	
	}
}
?>