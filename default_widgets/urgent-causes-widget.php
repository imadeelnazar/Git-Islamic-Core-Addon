<?php
/**
 * Plugin Name: Kodeforest Urgent Causes
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show Urgent Causes( Specified by category ).
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_urgent_causes_widget' );
if( !function_exists('islamic_center_urgent_causes_widget') ){
	function islamic_center_urgent_causes_widget() {
		register_widget( 'Kodeforest_Urgent_Causes' );
	}
}

if( !class_exists('Kodeforest_Urgent_Causes') ){
	class Kodeforest_Urgent_Causes extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_urgent_causes_widget', 
				esc_html__('Kodeforest Urgent Cause','islamic-center'), 
				array('description' => esc_html__('A widget that show Urgent Causes', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $islamic_center_theme_option;	
				
			$title = apply_filters( 'widget_title', $instance['title'] );
			$project_id = $instance['project_id'];
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			
			// Widget Content
			$query_args = array('post_type' => 'campaign', 'suppress_filters' => false);
			$query_args['p'] = $project_id;
			$query_args['ignore_sticky_posts'] = 1;
			
			$query = new WP_Query( $query_args );
			$counter = '0';
			if($query->have_posts()){
				wp_enqueue_style( 'prettyphoto', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/default/css/prettyphoto.css' );  //Prettyphoto
				wp_enqueue_script('prettyphoto', ISLAMIC_CENTER_PATH.'/framework/include/frontend_assets/default/js/jquery.prettyphoto.js',array('jquery'), '1.0', true);
				wp_enqueue_script('prettypp', ISLAMIC_CENTER_PATH.'/framework/include/frontend_assets/default/js/pp.js',array('jquery'), '1.0', true);
			
				$item_class = ''; ?>
			
				<?php
				while($query->have_posts()){ $query->the_post();
					global $post;
					$counter++;
					
					$islamic_center_post_option = islamic_center_decode_stopbackslashes(get_post_meta($post->ID, 'post-option', true ));
					if( !empty($islamic_center_post_option) ){
						$islamic_center_post_option = json_decode( $islamic_center_post_option, true );					
					}
					$islamic_center_post_option['campaign-goal-currency'] = empty($islamic_center_post_option['campaign-goal-currency'])? '$' : $islamic_center_post_option['campaign-goal-currency'];
					$islamic_center_paypal = get_option('islamic_center_paypal', array());
					
					$donated_percent = '';
					$donated_data = islamic_center_return_paypal_value($post->ID,'pay_amount');	
					$donators = islamic_center_return_paypal_value($post->ID,'pay_amount');	
					
					
					$islamic_center_thumbnail_id = get_post_thumbnail_id( $post->ID );
					$islamic_center_thumbnail = wp_get_attachment_image_src( $islamic_center_thumbnail_id , $settings['thumbnail-size'] );
					
					
					$donated_percent = islamic_center_get_percentage($donated_data,$islamic_center_post_option['campaign-goal']);
					$total_donation = array_sum($donated_data);
					$today = date('m/d/Y');
					$today = strtotime($today);
					
					$today = date('m/d/Y');
					$today = strtotime($today);
					$finish = $islamic_center_post_option['end-date'];
					$finish = strtotime($finish);
					//difference
					$diff = $finish - $today;
					
					$daysleft = floor($diff/(60*60*24));
					$social_icon = '';
					
					$islamic_center_thumbnail_id = get_post_thumbnail_id($post->ID);
					$islamic_center_thumbnail = wp_get_attachment_image_src( $islamic_center_thumbnail_id ,array(350,350) );
					
					
					?>
					<div class="widget-urgentcauses">
						<div class="main-heading text-left">
							<?php 
							if( !empty($title) ){ 
								echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
							}?>
						</div>
						<div class=" widget-campaing-thumb hover-effect gallery-item">
							<!-- Campaing Thumb Slider Start-->
							<figure>
								<img src="<?php echo esc_url($islamic_center_thumbnail[0]); ?>" alt="">
								<div class="effect_data">
									<ul>
										<li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-expand" aria-hidden="true"></i></a></li>
										<li><a data-rel="prettyphoto[]" href="<?php echo esc_url($islamic_center_thumbnail[0]); ?>"><i class="fa fa-picture-o" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</figure>
							<!-- Campaing Thumb Slider End-->
							<!-- Campaing Thumb Contant Start-->
							<div class="campaing-thumb-contant">
								<h4 class="campaing-title"><a href="<?php echo esc_url(get_permalink())?>"><?php echo substr(esc_attr(get_the_title()),0,25); ?></a></h4>
								<p><?php echo esc_attr(substr(get_the_content(),0,28)); ?></p>
								<!-- Donation Progress Start-->
								<div class="d-relf-donation-progress">
									<!-- Bar Progress Start-->
									<div class="barWrapper">
										<div class="progress ">
											<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr($donated_percent); ?>" aria-valuemin="10" aria-valuemax="100" style="">
												<span  class="popOver" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr($donated_percent); ?>%"> </span>  
											</div>
										</div>
									</div>
									<div class="goal-amount">
										<span> <?php echo esc_attr__('Goal','islamic-center'); ?></span>
										<h6> <?php echo esc_attr($islamic_center_post_option['campaign-goal-currency']);?><?php echo esc_attr($islamic_center_post_option['campaign-goal']); ?></h6>
									</div>
									<!-- Bar Progress End-->
									<div class="raised-amount goal-amount">
										<span><?php echo esc_attr__('Raised','islamic-center'); ?></span>
										<h6><?php echo esc_attr($total_donation); ?></h6>
									</div>
								</div>
								<!-- Donation Progress End-->
							</div>
							<!-- Campaing Thumb Contant End-->
						</div>
					</div>
				<?php
				}
			}
			wp_reset_postdata();
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$project_id = isset($instance['project_id'])? $instance['project_id']: '';
			
			?>

			<!-- Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title :', 'islamic-center'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</p>		

			<!-- Post project_id -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('project_id')); ?>"><?php esc_html_e('Select Project :', 'islamic-center'); ?></label>		
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('project_id')); ?>" id="<?php echo esc_attr($this->get_field_id('project_id')); ?>">
				<?php 	
				$projects = islamic_center_get_post_list_id('campaign'); 
				foreach($projects as $project_slug => $project_name){ ?>
					<option value="<?php echo esc_attr($project_slug); ?>" <?php if ($project_id == $project_slug) echo ' selected '; ?>><?php echo esc_attr($project_name); ?></option>				
				<?php } ?>	
				</select> 
			</p>

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['project_id'] = (empty($new_instance['project_id']))? '': strip_tags($new_instance['project_id']);

			return $instance;
		}	
	}
}
?>