<?php
/**
 * Plugin Name: Kodeforest Flickr Widget
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show flickr image.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_flickr_widget' );
if( !function_exists('islamic_center_flickr_widget') ){
	function islamic_center_flickr_widget() {
		register_widget( 'Kodeforest_Flickr_Widget' );
	}
}

if( !class_exists('Kodeforest_Flickr_Widget') ){
	class Kodeforest_Flickr_Widget extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_flickr_widget', 
				esc_html__('Kodeforest Flickr Widget (KodeForest)','islamic-center'), 
				array('description' => esc_html__('A widget that show image from flickr', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {			
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$id = $instance['id'];
			$num_fetch = $instance['num_fetch'];
			$orderby = $instance['orderby'];
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			

			// Widget Content
			if(!empty($id)){ 
				$flickr  = '?count=' . $num_fetch;
				$flickr .= '&amp;display=' . $orderby;
				$flickr .= '&amp;user=' . $id;
				$flickr .= '&amp;size=s&amp;layout=x&amp;source=user';
				?>
				
				<div class="widget">
					<?php echo $args['before_title'] . esc_attr($title) . $args['after_title']; ?>
					 <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne<?php echo esc_url($flickr); ?>"></script>
					 <div class="clear"></div>
				</div>

				<?php 
			}
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$id = isset($instance['id'])? $instance['id']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 6;
			$orderby = isset($instance['orderby'])? $instance['orderby']: 'latest';
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>	
			
			<!-- ID --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('id')); ?>"><?php esc_html_e('Flickr ID :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('id')); ?>" name="<?php echo esc_attr($this->get_field_name('id')); ?>" type="text" value="<?php echo esc_attr($id); ?>" />
			</p>			

			<!-- Show Num --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>"><?php esc_html_e('Num Fetch :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>" name="<?php echo esc_attr($this->get_field_name('num_fetch')); ?>" type="text" value="<?php echo esc_attr($num_fetch); ?>" />
			</p>			

			<!-- Order By -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php esc_html_e('Order By :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('orderby')); ?>" id="<?php echo esc_attr($this->get_field_id('orderby')); ?>">
					<option value="latest" <?php if(empty($orderby) || $orderby == 'latest') echo esc_html__(' selected ','islamic-center'); ?>><?php esc_html_e('Latest', 'islamic-center') ?></option>
					<option value="random" <?php if($orderby == 'random') echo esc_html__(' selected ','islamic-center'); ?>><?php esc_html_e('Random', 'islamic-center') ?></option>				
				</select> 
			</p>
			
		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['id'] = (empty($new_instance['id']))? '': strip_tags($new_instance['id']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			$instance['orderby'] = (empty($new_instance['orderby']))? '': strip_tags($new_instance['orderby']);
			
			return $instance;
		}	
	}
}
?>