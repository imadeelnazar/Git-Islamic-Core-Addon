<?php
/**
 * Plugin Name: Latest Events Widget
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show Latest Events.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_latest_events_widget' );
if( !function_exists('islamic_center_latest_events_widget') ){
	function islamic_center_latest_events_widget() {
		register_widget( 'Kodeforest_Latest_Events' );
	}
}

if( !class_exists('Kodeforest_Latest_Events') ){
	class Kodeforest_Latest_Events extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_latest_events_widget', 
				esc_attr__('Kodeforest Latest Events Widget','islamic-center'), 
				array('description' => esc_attr__('A widget that shows Next Match.', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $islamic_center_theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$num_fetch = $instance['num_fetch'];
			$style = $instance['style'];
			
			// Opening of widget
			echo $args['before_widget'];
			if($style == 'style-1'){
				echo '
				<div class="widget_event">';
					// Open of title tag
					if( !empty($title) ){ 
						echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
					}
					echo '
					<ul class="kode_calender_detail">';
						$evn = '';
						$order = 'DESC';
						$limit = 10;//Default limit
						$offset = '';		
						$rowno = 0;
						$event_count = 0;
						$EM_Events = EM_Events::get( array('category'=>$category, 'group'=>'this','scope'=>'all', 'limit' => $num_fetch, 'order' => 'desc') );
						$events_count = count ( $EM_Events );	
						foreach($EM_Events as $event){
							$event_post_data = islamic_center_decode_stopbackslashes(get_post_meta($event->post_id, 'post-option', true ));
							if( !empty($event_post_data)){
								if(!is_array($event_post_data)){
									$event_post_data = json_decode( $event_post_data, true );				
								}
							}					
							if($event->event_all_day <> 1){
								$start_time = $event->start_time;
								$end_time = $event->end_time;
							}else{

								$start_time = '12:00';
								$end_time = '12:00';
								
							}
							$event_year = date('Y',$event->start);
							$event_month = date('M',$event->start);
							$event_day = date('d',$event->start);
							$event_day_alpha = date('D',$event->start);
							// print_r($event->start_time);
							$event_start_time = date("G : i a", strtotime($start_time));
							$event_end_time = date("G : i a", strtotime($end_time));
							echo '
								<li>
									<div class="kode_calender_list">
										<span>'.esc_attr($event_day).' <i>'.esc_attr($event_month).'</i></span>
										<div class="kode_event_text">
											<h6><a href="'.esc_url($event->guid).'">'.esc_attr($event->post_title).'</a></h6>
											<p>'.esc_attr($event_day_alpha).' <span>'.esc_attr($event_start_time).'</span> '.esc_attr__('to','islamic-center').' <span>'.esc_attr($event_end_time).'</span></p>
										</div>
									</div>
								</li>';
						}
						
						echo '
					</ul>
				</div>';			
			}else{
				echo '
				<div class="kode_event_des">';
					if( !empty($title) ){ 
						echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
					}
					echo'<ul class="kode_calender_detail detail_2">';
						$evn = '';
						$order = 'DESC';
						$limit = 10;//Default limit
						$offset = '';		
						$rowno = 0;
						$event_count = 0;
						$EM_Events = EM_Events::get( array('category'=>$category, 'group'=>'this','scope'=>'all', 'limit' => $num_fetch, 'order' => 'desc') );
						$events_count = count ( $EM_Events );	
						foreach($EM_Events as $event){
							$event_post_data = islamic_center_decode_stopbackslashes(get_post_meta($event->post_id, 'post-option', true ));
							if( !empty($event_post_data)){
								if(!is_array($event_post_data)){
									$event_post_data = json_decode( $event_post_data, true );				
								}
							}					
							if($event->event_all_day <> 1){
								$start_time = $event->start_time;
								$end_time = $event->end_time;
							}else{

								$start_time = '12:00';
								$end_time = '12:00';
								
							}
							$event_year = date('Y',$event->start);
							$event_month = date('M',$event->start);
							$event_day = date('d',$event->start);
							// print_r($event->start_time);
							$event_start_time = date("G : i a", strtotime($start_time));
							$event_end_time = date("G : i a", strtotime($end_time));
							echo '
							<li>
								<div class="kode_calender_list">
									<span>'.esc_attr($event_day).' <i>'.esc_attr($event_month).'</i></span>
									<div class="kode_event_text">
										<h4><a href="'.esc_url($event->guid).'">'.esc_attr($event->post_title).'</a></h4>
										<p>'.substr(strip_tags($event->post_content),0,70).'</p>
										'.islamic_center_get_event_info($event->post_id , array('tag'),'','','span').'
									</div>
								</div>
							</li>';
						} echo'
					</ul>
				</div>
				';
			}
			echo '
			<!--Widget Next Match End-->';
					
			// Closing of widget
			echo $args['after_widget'];	
			
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: '';
			$style = isset($instance['style'])? $instance['style']: '';?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>			
			<!-- Post Category -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php esc_html_e('Style :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
					<option value="style-1" <?php if ($style == 'style-1') echo ' selected '; ?>><?php echo esc_attr__('Style 1','islamic-center'); ?></option>
					<option value="style-2" <?php if ($style == 'style-2') echo ' selected '; ?>><?php echo esc_attr__('Style 2','islamic-center'); ?></option>				
				</select> 
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Category :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>" id="<?php echo esc_attr($this->get_field_id('category')); ?>">
				<option value="" <?php if(empty($category)) echo ' selected '; ?>><?php esc_html_e('All', 'islamic-center') ?></option>
				<?php 	
				$category_list = islamic_center_get_term_list('event-categories'); 
				foreach($category_list as $cat_slug => $cat_name){ ?>
					<option value="<?php echo esc_attr($cat_slug); ?>" <?php if ($category == $cat_slug) echo ' selected '; ?>><?php echo esc_attr($cat_name); ?></option>				
				<?php } ?>	
				</select> 
			</p>
			<!-- Post Layout -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>"><?php esc_attr_e('Num Fetch :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>" name="<?php echo esc_attr($this->get_field_name('num_fetch')); ?>" type="text" value="<?php echo esc_attr($num_fetch); ?>" />
			</p>
			
		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['style'] = (empty($new_instance['style']))? '': strip_tags($new_instance['style']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			

			return $instance;
		}	
	}
}
?>