<?php
	/*	
	*	Kodeforest Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls page builder  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('islamic_center_page_options') ){
		
		class islamic_center_page_options{

			public $settings;
			public $options;
		
			function __construct($options = array(),$settings = array() ){
				
				$default_setting = array(
					'post_type' => array('page'),
					'meta_title' => esc_html__('Page Option', 'islamic-center'),
					'meta_slug' => 'kodeforest-page-option',
					'option_name' => 'post-option',
					'position' => 'side',
					'priority' => 'high',
				);
				
				$this->settings = wp_parse_args($settings, $default_setting);
				$this->options = $options;
				
				// send the hook to create custom meta box
				add_action('add_meta_boxes', array(&$this, 'add_page_option_meta'));

				// add hook to save page options
				add_action('pre_post_update', array(&$this, 'islamic_center_save_page_option'));
			}			
			
			// load the necessary script for the page builder item
			function islamic_center_load_admin_script(){
				global $post,$islamic_center_theme_option;
				if(isset($_GET['post-id'])){
					$post_option = islamic_center_decode_stopbackslashes(get_post_meta($_GET['post-id'], 'post-option', true));
				}else{
					$post_option = array();
				}
				
				
				
				
				add_action('admin_enqueue_scripts', array(&$this, 'islamic_center_enqueue_wp_media') );
				wp_deregister_style('accordion');
				wp_register_script('acordion', ISLAMIC_CENTER_PATH.'/framework/include/frontend_assets/default/js/jquery.accordion.js', false, '1.0', true);
				wp_enqueue_script('acordion');
				
				// include the sidebar generator style
				wp_enqueue_style('wp-color-picker');
				
				wp_enqueue_script( 'wp-color-picker-alpha', ISLAMIC_CENTER_PATH. '/framework/include/backend_assets/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.0.0', true );
				
				wp_enqueue_style('islamic-center-alert-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_msg.css');	
				wp_enqueue_style('islamic-center-page-option', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_pageoption.css');
				wp_enqueue_style( 'font-awesome', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/font-awesome/css/font-awesome.min.css' );  //Font Awesome
				wp_enqueue_style('islamic-center-admin-panel-html', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_element_meta.css');	
				wp_enqueue_style('islamic-center-admin-chosen', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kode-chosen/chosen.min.css');
				wp_enqueue_style('islamic-center-edit-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_popup_window.css');		
				wp_enqueue_style('islamic-center-page-builder', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_pagebuilder.css');		
				// wp_enqueue_script('islamic-center-datetime', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/islamic-center-datetime.css');	
				wp_enqueue_style('islamic-center-date-picker', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/jquery-ui.css');

				// include the sidebar generator script
				wp_enqueue_script('wp-color-picker');
				wp_enqueue_script('islamic-center-utility', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_filter.js');	
				// wp_enqueue_script('islamic-center-datetime', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/islamic-center-datetime.js');	
				
				
				wp_enqueue_script('islamic-center-alert-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_msg.js');
				wp_enqueue_script('islamic-center-admin-panel-html', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_element_meta.js');
				wp_enqueue_script('islamic-center-edit-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_popup_window.js');	
				wp_enqueue_script('islamic-center-save-settings', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_save_settings.js');
				wp_enqueue_script('islamic-center-slider-selection', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_media_center.js');
				wp_enqueue_script('islamic-center-gallery-selection', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kode-gallery-selection.js');
				wp_enqueue_script('islamic-center-admin-chosen', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kode-chosen/chosen.jquery.min.js');
				wp_enqueue_script('islamic-center-page-builder', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_pagebuilder.js');
				wp_enqueue_script('jquery-ui-datepicker');	
			}			
			
			//Media Manager
			function islamic_center_enqueue_wp_media(){
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
			}
			
			// create the page builder meta at the add_meta_boxes hook
			function add_page_option_meta(){
				global $post;
				if(!empty($post)){
					if( in_array($post->post_type, $this->settings['post_type']) ){
						$this->islamic_center_load_admin_script();
					
						foreach( $this->settings['post_type'] as $post_type ){
							add_meta_box(
								$this->settings['meta_slug'],
								$this->settings['meta_title'],
								array(&$this, 'create_page_option_elements'),
								$post_type,
								$this->settings['position'],
								$this->settings['priority']
							);			
						}
					}
				}
			}
		
			// start creating the page builder element
			function create_page_option_elements(){
				global $post;

				$option_value = islamic_center_decode_stopbackslashes(get_post_meta( $post->ID, $this->settings['option_name'], true ));
				if( !empty($option_value) ){
					$option_value = json_decode( $option_value, true );					
				}
	
				$option_generator = new islamic_center_generate_admin_html();
				
				echo '<div class="kode-page-option-wrapper position-' . esc_attr($this->settings['position']) . '" >';
				
				foreach( $this->options as $option_section ){
					echo '<div class="kode-page-option">';
					echo '<div class="kode-page-option-title">' . esc_attr($option_section['title']) . '</div>';
					echo '<div class="kode-page-option-input-wrapper row">';
					
					foreach ( $option_section['options'] as $option_slug => $option ){
						$option['slug'] = $option_slug;
						$option['name'] = $option_slug;
						if( !empty($option_value) && isset($option_value[$option_slug]) ){
							$option['value'] = $option_value[$option_slug];
						}else{
							$option['value'] = get_post_meta($post->ID,$option_slug,true);	
						}
						
						$option_generator->islamic_center_generate_html( $option );
					}
					
					echo '</div>'; // page-option-input-wrapper
					echo '</div>'; // page-option-title
					
					
				}
				echo '<textarea class="kode-input-hidden" name="' . esc_attr($this->settings['option_name']) . '"></textarea>';
				echo '</div>'; // kode-page-option-wrapper
			}
			
			// save page option setting
			function islamic_center_save_page_option( $post_id ){
				if( isset($_POST[$this->settings['option_name']]) ){
					update_post_meta($post_id, $this->settings['option_name'], islamic_center_stopbackslashes($_POST[$this->settings['option_name']]));
				}
				if( get_post_type() == 'page' && isset($_POST['show-sub']) ){
					
					if(!empty($_POST['show-sub'])){
						update_post_meta($post_id, 'show-sub', $_POST['show-sub']);
					}else{
						delete_post_meta($post_id, 'show-sub');
					}
					if(!empty($_POST['page-caption'])){
						update_post_meta($post_id, 'page-caption',$_POST['page-caption']);
					}else{
						delete_post_meta($post_id, 'page-caption');
					}
					if(!empty($_POST['enable-title-top'])){
						update_post_meta($post_id, 'enable-title-top',$_POST['enable-title-top']);
					}else{
						delete_post_meta($post_id, 'enable-title-top');
					}
				}
			}
			
		}
		
		
	}

?>