<?php
	/*	
	*	Kodeforest Admin Panel
	*	---------------------------------------------------------------------
	*	This file create the class that help you create the controls page builder  
	*	option for custom theme
	*	---------------------------------------------------------------------
	*/	
	
	if( !class_exists('islamic_center_page_builder') ){
		
		class islamic_center_page_builder{

			
			public $options;
			public $settings;
		
			function __construct($options = array(),$settings = array()){
				
				$default_config = array(
					'post_type' => array('page'),
					'meta_title' => esc_html__('Page Builder Options', 'islamic-center'),
					'meta_slug' => 'page-builder',
					'position' => 'normal',
					'priority' => 'high',
					'section' => array(
						// 'above-sidebar' => array( 
							// 'title' => esc_html__('Above Sidebar Section', 'islamic-center'),
							// 'class' => 'above-sidebar-section',
						// ),
						'islamic_center_content' => array( 
							'title' => esc_html__('Click and Drop Element Here', 'islamic-center'),
							'class' => 'with-sidebar-section',
						),
						// 'below-sidebar' => array( 
							// 'title' => esc_html__('Below Sidebar Section', 'islamic-center'),
							// 'class' => 'below-sidebar-section',
						// )					
					)
				);
				
				$this->settings = wp_parse_args($settings, $default_config);
				$this->options = $options;
				
				// send the hook to create custom meta box
				add_action('add_meta_boxes', array(&$this, 'islamic_center_add_page_builder_meta'));
				
				// add hook to save the page builder option
				add_action('pre_post_update', array(&$this, 'save_page_builder'));
				
				// add action for ajax call to print the tiny mce editor
				add_action('wp_ajax_islamic_center_print_tinymce_editor', array(&$this, 'islamic_center_print_tinymce_editor'));					
			}		
			
			// load the necessary script for the page builder item
			function islamic_center_load_admin_scripts(){
				global $post;
				
				add_action('admin_enqueue_scripts', array(&$this, 'islamic_center_enqueue_wp_media') );
			
				// include the sidebar generator style
				wp_enqueue_style('wp-color-picker');
				wp_enqueue_style('islamic-center-page-builder', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_pagebuilder.css');	
				wp_enqueue_style('islamic-center-alert-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_msg.css');	
				wp_enqueue_style( 'font-awesome', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/font-awesome/css/font-awesome.min.css' );  //Font Awesome
				wp_enqueue_style('islamic-center-edit-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_popup_window.css');
				wp_enqueue_style('islamic-center-admin-chosen', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kode-chosen/chosen.min.css');
				wp_enqueue_style('islamic-center-page-option', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/css/kf_pageoption.css');					
				wp_enqueue_script('islamic-center-save-settings', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_save_settings.js');
				wp_enqueue_script('wp-color-picker');
				wp_enqueue_script('islamic-center-utility', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_filter.js');	
				wp_enqueue_script('islamic-center-alert-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_msg.js');
				
				wp_enqueue_script('islamic-center-edit-box', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_popup_window.js');				
				wp_enqueue_script('islamic-center-slider-selection', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_media_center.js');
				wp_enqueue_script('islamic-center-gallery-selection', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kode-gallery-selection.js');
				wp_enqueue_script('islamic-center-admin-chosen', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kode-chosen/chosen.jquery.min.js');
				wp_enqueue_script('islamic-center-page-builder', ISLAMIC_CENTER_PATH . '/framework/include/backend_assets/js/kf_pagebuilder.js');
				
				
				
				wp_localize_script( 'islamic-center-edit-box', 'KODE', array('ajax_url'=>ISLAMIC_CENTER_AJAX_URL) );
			}	
			function islamic_center_enqueue_wp_media(){
				if(function_exists( 'wp_enqueue_media' )){
					wp_enqueue_media();
				}		
			}			
			
			// create the page builder meta at the add_meta_boxes hook
			function islamic_center_add_page_builder_meta(){
				global $post; 
				if(!empty($post)){
					if( in_array($post->post_type, $this->settings['post_type']) ){
						$this->islamic_center_load_admin_scripts();
						
						foreach( $this->settings['post_type'] as $post_type ){
							add_meta_box(
								$this->settings['meta_slug'],
								$this->settings['meta_title'],
								array(&$this, 'create_page_builder_elements'),
								$post_type,
								$this->settings['position'],
								$this->settings['priority']
							);			
						}
					}
				}
				
			}
		
			// start creating the page builder element
			function create_page_builder_elements(){		
				echo '<div class="kode-page-builder" id="kode-page-builder">';
				
				echo '<div id="page-builder-add-item" class="page-builder-creator-wrapper">';
				$this->islamic_center_print_page_builder_creator();
				echo '</div>';
				
				echo '<div id="page-builder-default-item">';
				$this->islamic_center_print_page_builder_default_item();
				echo '</div>';
				
				echo '<div id="page-builder-content-item" class="page-builder-content-wrapper">';
				$this->islamic_center_print_page_builder_content();
				echo '</div>';
				
				echo '</div>'; // kode-page-builder
			}
			
			// add page builder section
			function islamic_center_print_page_builder_creator(){
				
				// head section
				echo '<div class="page-builder-head-wrapper">';
				echo '<h4 class="page-builder-head add-content">' . esc_html__('Add Content Item', 'islamic-center') . '</h4>';
				echo '</div>';
				
				echo '<div class="page-builder-creator row">';
				foreach( $this->options as $add_item_slug => $add_item_wrapper ){
					echo '<div class="item-selector-wrapper">';
					echo '<h5 class="item-selector-header">' . $add_item_wrapper['title'] . '</h5>'; 
					
					echo '<div class="kode-combobox-wrapper" >';
					//echo '<select class="content-item-selector" >';
					//echo '<option>' . esc_attr($add_item_wrapper['blank_option']) . '</option>';
					$size = '';
					echo '<div class="kode-list-item">';
					foreach( $add_item_wrapper['options'] as $item_slug => $item_wrapper ){
						if( !empty($item_wrapper) ){
							//echo '<option value="' . esc_attr($item_slug) . '" >';
							$size = (!empty($item_wrapper['size']))? esc_attr($item_wrapper['size']) . ' ': '';
							$icon = (!empty($item_wrapper['icon']))? esc_attr($item_wrapper['icon']) . ' ': '';
							// echo esc_attr($item_wrapper['title']) . '</option>';
							echo '
								<div class="k_list_item" data-slug="'.esc_attr($item_slug).'" data-size="'.esc_attr($size).'">
									<span><i class="fa '.esc_attr($icon).'"></i></span>
									<p>'. esc_attr($item_wrapper['title']).'</p>
								</div>';
						}
					}
					echo '</div>';
					//echo '</select>';
					echo '</div>'; // kode-combobox-wrapper
					
					//echo '<input class="kdf-add-item" type="button" value="+" />';
					//echo '<a class="kdf-add-item"><i class="fa fa-plus"></i> Add Element</a>';
					echo '</div>'; // item selector wrapper
				}
				
				echo '<div class="clear"></div>';
				echo '</div>';
			
			}
			
			// print default item to be a prototype
			function islamic_center_print_page_builder_default_item(){
				$islamic_center_page_builder_html = new islamic_center_page_builder_html();
			
				foreach( $this->options as $add_item_slug => $add_item_wrapper ){
					foreach( $add_item_wrapper['options'] as $item_slug => $item_wrapper ){
						echo '<div id="' . esc_attr($item_slug) . '-default" >';

						// dragable section
						$item_wrapper['slug'] = $item_slug; 
						if( $item_wrapper['type'] == 'wrapper' ){
							$islamic_center_page_builder_html->islamic_center_print_draggable_wrapper($item_wrapper);
						}else{
							$islamic_center_page_builder_html->islamic_center_print_draggable_item($item_wrapper);
						}

						echo '</div>';
					}
				}
			}
			
			// merge all options to use in html section
			function islamic_center_merge_page_builder_items(){
				$all_items = array();
				
				foreach( $this->options as $items ){
					if( !empty($items['options']) ){
						$all_items = array_merge($all_items, $items['options']);
					}
				}
				
				return $all_items;
			}
			
			// page builder content section
			function islamic_center_print_page_builder_content(){
				global $post;
				
				$islamic_center_page_builder_html = new islamic_center_page_builder_html( $this->islamic_center_merge_page_builder_items() );
				
				// head section
				echo '<div class="page-builder-head-wrapper">';
				echo '<h4 class="page-builder-head page-builder">' . esc_html__('Page Builder Section', 'islamic-center') . '</h4>';
				
				// echo '<div class="command-button-wrapper">';
				// echo '<input class="undo-button" type="button" value="' . esc_html__('Undo', 'islamic-center') . '" />';
				// echo '<input class="redo-button" type="button" value="' . esc_html__('Redo', 'islamic-center') . '" />';
				// echo '</div>';	
				echo '</div>'; // page-builder-head-wrapper
				
				echo '<div class="page-builder-content">';
				
				foreach( $this->settings['section'] as $section_slug => $section ){
					$value = islamic_center_decode_stopbackslashes(get_post_meta($post->ID, $section_slug, true));
					$array_value = json_decode( $value, true );
					
					echo '<div class="content-section-wrapper ' . $section['class'] . '">';
					// echo '<div class="content-section-head-wrapper active">';
					// echo '<h6 class="content-section-head">' . $section['title'] . '</h6>';
					// echo '</div>';
					
					echo '<div class="kode-sortable-wrapper" data-type="' . $section['class'] . '" >';
					echo '<div class="page-builder-item-area kode-sortable clear-fix row ';
					echo (!empty($array_value))? '': 'blank';
					echo '" >';
					$islamic_center_page_builder_html->islamic_center_print_page_builder( $array_value );	
					echo '</div>';
					echo '</div>'; // kode-sortable-wrapper
					
					echo '<textarea class="kode-input-hidden" name="' . esc_attr($section_slug) . '" >' . esc_textarea($value) . '</textarea>';
					echo '</div>'; // content-section-wrapper
					
					echo '<div class="clear"></div>';
				}
				echo '</div>'; // page-builder-content
			
			}
			
			// function to allow printing the editor on ajax call
			
			function islamic_center_print_tinymce_editor(){
				wp_editor( islamic_center_stopbackslashes($_POST['content']), 
					$_POST['id'], array('textarea_name'=> $_POST['name']) );			
				die();
			}	
			
			// save page builder setting
			function save_page_builder( $post_id ){
				foreach( $this->settings['section'] as $section_slug => $section ){
					if( isset($_POST[$section_slug]) ){
						update_post_meta($post_id, $section_slug, islamic_center_stopbackslashes($_POST[$section_slug]));
					}
				}
			}
			
		}
		
		
	}

?>