<?php
/**
 * Plugin Name: Kodeforest Latest Comment
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show Latest comment.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_recent_comment_widget' );
if( !function_exists('islamic_center_recent_comment_widget') ){
	function islamic_center_recent_comment_widget() {
		register_widget( 'Kodeforest_Recent_Comment' );
	}
}

if( !class_exists('Kodeforest_Recent_Comment') ){
	class Kodeforest_Recent_Comment extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_recent_comment_widget', 
				esc_html__('Kodeforest Recent Comment Widget','islamic-center'), 
				array('description' => esc_html__('A widget that show lastest comment', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {			
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$num_fetch = $instance['num_fetch'];
			
			// Opening of widget
			echo $args['before_widget'];			
				
			// Widget Content
			$posts_list = get_posts(array('category_name' => $category, 'numberposts'=>9999));
			$post_ids = array();
			foreach ($posts_list as $post) {
				$post_ids[] = $post->ID;
			}			
			
			$recent_comments = get_comments( array(
				'post_id__in' => $post_ids, 
				'number' => $num_fetch, 
				'status' => 'approve') 
			);		
                               
                        
			echo '<div class="widget-recentpost">';                        
						// Open of title tag
					if( !empty($title) ){ 
						echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
					}					
                echo '<ul>';
			foreach( $recent_comments as $recent_comment ){
					$comment_permalink = get_permalink($recent_comment->comment_post_ID) . '#comment-' . $recent_comment->comment_ID;
					echo '<li>
							<a href="' . esc_url($comment_permalink) . '">' . substr(esc_attr($recent_comment->comment_content),0,20) . '<span>'.esc_attr(get_comment_date('F', $recent_comment->comment_ID)).' '.esc_attr(get_comment_date('d', $recent_comment->comment_ID)).'</span></a>
						  </li>';
			}
			echo '</ul></div>';
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 3;
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>		

			<!-- Post Category -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Category :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>" id="<?php echo esc_attr($this->get_field_id('category')); ?>">
				<option value="" <?php if(empty($category)) echo ' selected '; ?>><?php esc_html_e('All', 'islamic-center') ?></option>
				<?php 	
				$category_list = islamic_center_get_term_list('category'); 
				foreach($category_list as $cat_slug => $cat_name){ ?>
					<option value="<?php echo esc_attr($cat_slug); ?>" <?php if ($category == $cat_slug) echo ' selected '; ?>><?php echo esc_attr($cat_name); ?></option>				
				<?php } ?>	
				</select> 
			</p>
				
			<!-- Show Num --> 
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>"><?php esc_html_e('Num Fetch :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>" name="<?php echo esc_attr($this->get_field_name('num_fetch')); ?>" type="text" value="<?php echo esc_attr($num_fetch); ?>" />
			</p>

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);

			return $instance;
		}	
	}
}
?>