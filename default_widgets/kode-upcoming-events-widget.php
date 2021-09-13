<?php
/**
 * Plugin Name: Upcoming Events Widget
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show Upcoming Events.
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_upcoming_events_widget' );
if( !function_exists('islamic_center_upcoming_events_widget') ){
	function islamic_center_upcoming_events_widget() {
		register_widget( 'Kodeforest_upcoming_events' );
	}
}

if( !class_exists('Kodeforest_upcoming_events') ){
	class Kodeforest_upcoming_events extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_upcoming_events_widget', 
				esc_attr__('Kodeforest Upcoming Events Widget','islamic-center'), 
				array('description' => esc_attr__('A widget that shows Next Match.', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $islamic_center_theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$category = $instance['category'];
			$num_fetch = $instance['num_fetch'];
			$event_style = $instance['event_style'];
			
			// Opening of widget
			echo $args['before_widget'];
				$evn = '';
				$order = 'DESC';
				//$limit = 10;//Default limit
				$offset = '';		
				$rowno = 0;
				$event_count = 0;
				$EM_Events = EM_Events::get( array('category'=>$category, 'group'=>'this','scope'=>'future', 'limit' => $num_fetch, 'order' => 'ASC') );
				$events_count = count ( $EM_Events );	
				if($event_style == 'style-1'){
					echo '<div class="kode_event_des">';
					// Open of title tag
					if( !empty($title) ){ 
						echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
					}
					foreach($EM_Events as $event){
						if($event_count == '1'){
							break;
						}
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
						$event_month = date('m',$event->start);
						$event_day = date('d',$event->start);
						// print_r($event->start_time);
						$event_start_time = date("H:i:s", strtotime($start_time));
						$event_end_time = date("H:i:s", strtotime($end_time));
						echo '
							<div class="koed_event_timer">
								<figure class="them_overlay">
									'.get_the_post_thumbnail($event->ID, 'full').'
									<figcaption>
										<h5><a href="'.esc_url($event->guid).'">'.esc_attr($event->post_title).'</a></h5>
										<ul id="countdown-1" class="countdown downcount" data-year="'.esc_attr($event_year).'" data-month="'.esc_attr($event_month).'" data-day="'.esc_attr($event_day).'" data-time="'.esc_attr($start_time).'">							
											<li>
												<span class="days">00</span>
												<p class="">'.esc_attr__('Days','islamic-center').'</p>
											</li>
											<li>
												<span class="hours">00</span>
												<p class="">'.esc_attr__('HRS','islamic-center').'</p>
											</li>
											<li>
												<span class="minutes">00</span>
												<p class="">'.esc_attr__('Mins','islamic-center').'</p>
											</li>
											<li>
												<span class="seconds">00</span>
												<p class="">'.esc_attr__('Secs','islamic-center').'</p>
											</li>
										</ul>
									</figcaption>
								</figure>
							</div>';
						$event_count++;	
					}
					$event = '';
					echo '<ul class="kode_calender_detail">';
					$event_count2 = 0;
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
						$event_start_time = date("H:i:s", strtotime($start_time));
						$event_end_time = date("H:i:s", strtotime($end_time));
						if($event_count2 == 0){
							
						}else{
							echo '
							<li>
								<div class="kode_calender_list">
									<span>'.esc_attr($event_day).' <i>'.esc_attr($event_month).'</i></span>
									<div class="kode_event_text">
										<h6><a href="'.esc_url(get_permalink($event->post_id)).'">'.esc_attr(get_the_title($event->post_id)).'</a></h6>
										<p>'.esc_attr($event_day_alpha).' <span>'.esc_attr($event_start_time).'</span> '.esc_attr__('to','islamic-center').' <span>'.esc_attr($event_end_time).'</span></p>
									</div>
								</div>
							</li>';
						}
						$event_count2++;
					}
					echo '</ul></div>';	
				}else{
					$event = '';
					wp_register_script('islamic-slick', ISLAMIC_CENTER_PATH.'/framework/include/frontend_assets/slick/slick.min.js', false, '1.0', true);
					wp_enqueue_script('islamic-slick');
					wp_enqueue_style( 'islamic-slick', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/slick/slick.css' );  //owl slider css
					wp_enqueue_style( 'islamic-slick-theme', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/slick/slick-theme.css' );  //owl slider css	
			
					echo'
					<div class="kode_coming_event margin">';
						if( !empty($title) ){ 
						echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
						} echo '
						<div class="coming-event-slide" data-slide="1">';
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
								$event_month = date('m',$event->start);
								$event_day = date('d',$event->start);
								// print_r($event->start_time);
								$event_start_time = date("H:i:s", strtotime($start_time));
								$event_end_time = date("H:i:s", strtotime($end_time));
								if(isset($event->get_location()->location_address)){
									$location = esc_attr($event->get_location()->location_address);	
								}else{
									$location = '';
								}
								echo '
							
								<div>
									<div class="kode_coming_fig">
										<figure class="them_overlay">
											'.get_the_post_thumbnail($event->ID, array(1600,900)).'
										</figure>
										<div class="kode_coming_event_text">
											<h5><a href="'.esc_url(get_permalink($event->post_id)).'">'.esc_attr(get_the_title($event->post_id)).'</a></h5>
											<a href="#"><i class="fa fa-map-marker"></i>'.esc_attr($location).'</a>
										</div>
									</div>
								</div>';
							}
							echo '
						</div>
					</div>';
				}
				
					
			// Closing of widget
			echo $args['after_widget'];	
			
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: '';
			$event_style = isset($instance['event_style'])? $instance['event_style']: '';
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>			
			<!-- Post Category -->
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
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('event_style')); ?>"><?php esc_html_e('Event Style :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('event_style')); ?>" id="<?php echo esc_attr($this->get_field_id('event_style')); ?>">
					<option value="style-1" <?php if ($event_style == 'style-1') echo ' selected '; ?>><?php echo esc_attr__('Style 1','islamic-center'); ?></option>				
					<option value="style-2" <?php if ($event_style == 'style-2') echo ' selected '; ?>><?php echo esc_attr__('Style 2','islamic-center'); ?></option>
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
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			$instance['event_style'] = (empty($new_instance['event_style']))? '': strip_tags($new_instance['event_style']);
			

			return $instance;
		}	
	}
}
?>