<?php
	
	if( !function_exists('forest_get_blog_elementor') ){
		function forest_get_blog_elementor( $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $forest_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $forest_spaces['bottom-blog-item'])? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			
			$ret = '';
			$ret .= '<div class="col-md-12 blog-item-wrapper"  ' . $item_id . $margin_style . '>';
			
			// query post and sticky post
			$args = array('post_type' => 'post', 'suppress_filters' => false);
			if( !empty($settings['category']) || !empty($settings['tag']) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['category']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'category', 'field'=>'slug'));
				}
				if( !empty($settings['tag']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['tag']), 'taxonomy'=>'post_tag', 'field'=>'slug'));
				}				
			}

			$args['posts_per_page'] = (empty($settings['num_fetch']))? '5': $settings['num_fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
			$args['paged'] = empty($args['paged'])? 1: $args['paged'];
			$query = new WP_Query( $args );
			$settings['title_num_fetch'] = (empty($settings['title_num_fetch']))? '20': $settings['title_num_fetch'];
			if(isset($settings['title_num_fetch']) && $settings['title_num_fetch'] == '-1'){
				$settings['title_num_fetch'] = 500;
			}
			$settings['pagination'] = (empty($settings['pagination']))? 'disable': $settings['pagination'];

			// set the excerpt length
			if( !empty($settings['num_excerpt']) ){
				global $forest_excerpt_length; $forest_excerpt_length = $settings['num_excerpt'];
				// add_filter('excerpt_length', 'forest_set_excerpt_length');
			} 
			
			// get blog by the blog style
			global $forest_post_settings, $forest_lightbox_id;
			$forest_lightbox_id++;
			$forest_post_settings['excerpt'] = intval($settings['num_excerpt']);
			$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];	
			$forest_post_settings['blog_style'] = $settings['blog_style'];	
			
			$ret .= '<div class="blog-item-holder">';
			if($settings['blog_style'] == 'blog-full'){
				$settings['blog_size'] = 1;	
				$ret .= '<div class="kode-blog-list-full kode-large-blog row">';
				$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];
				$forest_post_settings['title_num_fetch'] = $settings['title_num_fetch'];
				$ret .= forest_get_blog_full_elementor($query, $settings);
				$ret .= '</div>';
			}else if($settings['blog_style'] == 'blog-small'){
				$ret .= '<div class="kode-blog-small kode-small-blog row">';
				$blog_size = $settings['blog_size'];	
				$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];
				$forest_post_settings['title_num_fetch'] = $settings['title_num_fetch'];
				$ret .= forest_get_blog_small_elementor($query, $settings);	
				$ret .= '</div>';
			}else if(strpos($settings['blog_style'], 'blog-widget') !== false){
				$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];
				$blog_size = $settings['blog_size'];	
				$forest_post_settings['title_num_fetch'] = $settings['title_num_fetch'];
				$ret .= '<div class="kode-blog-widget kode-widget-blog row">';
				$ret .= forest_get_blog_widget_elementor($query, $settings);
				$ret .= '</div>';
			}else if(strpos($settings['blog_style'], 'porfolio-widget') !== false){
				$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];
				$blog_size = $settings['porfolio_size'];	
				$forest_post_settings['title_num_fetch'] = $settings['title_num_fetch'];
				$ret .= '<div class="kode-porfolio-widget kode-widget-porfolio row">';
				$ret .= forest_get_portfolio_widget_elementor($query, $settings);
				$ret .= '</div>';
			}else if(strpos($settings['blog_style'], 'blog-grid') !== false){
				$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];
				$blog_size = $settings['blog_size'];
				$forest_post_settings['title_num_fetch'] = $settings['title_num_fetch'];
				$ret .= '<div class="kode-blog-grid kode-grid-blog row">';
				$ret .= forest_get_blog_grid_elementor($query, $settings);
				$ret .= '</div>';		
			}else{
				$forest_post_settings['thumbnail_size'] = $settings['thumbnail_size'];
				$blog_size = $settings['blog_size'];
				$forest_post_settings['title_num_fetch'] = $settings['title_num_fetch'];
				$ret .= '<div class="kode-blog-list-dd kode-grid-blog row">';
				$ret .= forest_get_blog_grid_elementor($query, $settings);
				$ret .= '</div>';
			}
			$ret .= '</div>';
			
			if( $settings['pagination'] == 'true' ){
				$ret .= forest_get_pagination($query->max_num_pages, $args['paged']);
			}
			wp_reset_postdata();
			wp_reset_query();
			$ret .= '</div>'; // blog-item-wrapper
			
			
			return $ret;
		}
	}
	
	if( !function_exists('forest_get_blog_small_elementor') ){
		function forest_get_blog_small_elementor($query,$settings){
			global $forest_post_settings;
			
			$forest_post_settings['excerpt'] = $settings['num_excerpt'];
			
			$size = $settings['blog_size'];
			
			if($settings['blog_slider'] == 'slider'){ return forest_get_blog_grid_elementor_carousel($query, $size); }
			
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $forest_post_settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = $forest_post_settings['title_num_fetch'];
				}		
				$forest_post_settings['content'] = get_the_content();
				if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				$forest_post_settings['post'] = $post;
				$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];
				$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true);

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-blog-grid-ux">';
				ob_start(); 
				
				forest_get_blog_small_elementor_item($forest_post_settings);
				
				$ret .= ob_get_contents();
				
				ob_end_clean();		
				
				$ret .= '</div>'; // kode-ux				
				$ret .= '</div>'; // column_class
				$current_size ++;
			}
			wp_reset_postdata();
			
			return $ret;
			
		}
	}
	
	function forest_get_blog_small_elementor_item($forest_post_settings){
		global $post;
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = $forest_post_settings['title_num_fetch'];
		}		
		
		if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		$blog_class = 'top-margin-push-image';
		$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true); ?>
		
		
		<article id="post-<?php the_ID(); ?>" <?php post_class('blog_detail_page hover-effect'); ?>>
			<div class="kode_blog_des">
				<figure class="them_overlay">
					<?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
				</figure>
				<div class="kode_blog_text">
					<?php if(get_the_title() <> ''){ ?>
						<h4><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(substr(get_the_title(),0,$title_num_fetch));?></a></h4>
						<ul class="kode_meta meta_2">
							<?php if( is_sticky(get_the_ID()) ){ ?>
								<li class="blog-info blog-date"><i class="fa fa-bullhorn"></i> <a href="#"> <?php esc_attr_e('Featured','islamic-center');?></a></li>
								<?php echo islamic_center_get_blog_info(array('date'), false, '','li');?>
							<?php }else{ ?>
								<?php echo islamic_center_get_blog_info(array('date'), false, '','li');?>
							<?php }?>
							<?php echo islamic_center_get_blog_info(array('views'), false, '','li');?>
							<?php echo islamic_center_get_blog_info(array('comment'), false, '','li');?>
						</ul>
					<?php }else{ ?>
						<ul class="kode_meta meta_2">
							<?php if( is_sticky(get_the_ID()) ){ ?>
								<li class="blog-info blog-date"><i class="fa fa-bullhorn"></i> <a href="#"> <?php esc_attr_e('Featured','islamic-center');?></a></li>
								<li class="blog-info blog-time"><i class="fa fa-calendar"></i><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_date(get_option('date_format')));?></a></li>
							<?php }else{ ?>
								<li class="blog-info blog-time"><i class="fa fa-calendar"></i><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_date(get_option('date_format')));?></a></li>
							<?php }?>
							<?php echo islamic_center_get_blog_info(array('views'), false, '','li');?>
							<?php echo islamic_center_get_blog_info(array('comment'), false, '','li');?>
						</ul>						
					<?php }
						// Content 
						if(!empty($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
							
						}else{					
							if( is_single() || $forest_post_settings['excerpt'] < 0 || $forest_post_settings['excerpt'] == 'full'){
								echo '<div class="kode-blog-content">';
								echo forest_content_filter(strip_tags($post->post_content), true);
								wp_link_pages( array( 
									'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jobly' ) . '</span>', 
									'after' => '</div>', 
									'link_before' => '<span>', 
									'link_after' => '</span>' )
								);
								echo '</div>';
							}else if( $forest_post_settings['excerpt'] != 0 ){
								echo '<div class="kode-blog-content"><p>' . substr(strip_tags($post->post_content),0,$forest_post_settings['excerpt']) .'...</p>';
								echo '</div>';	
							}
						}
					?>
				</div>
			</div>
		</article>
		
		<?php 
	}
	
	if( !function_exists('forest_get_blog_widget_elementor') ){
		function forest_get_blog_widget_elementor($query,$settings){
			global $forest_post_settings;
			
			$size = $settings['blog_size'];
			
			$forest_post_settings['excerpt'] = $settings['num_excerpt'];
			
			if($settings['blog_slider'] == 'slider'){ return forest_get_blog_grid_elementor_carousel($query, $size); }
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $forest_post_settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$forest_post_settings['post'] = $post;
				if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = $forest_post_settings['title_num_fetch'];
				}		
				$forest_post_settings['content'] = get_the_content();
				if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				
				$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];
				$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true);

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-blog-grid-ux">';
				ob_start();
				
				forest_get_blog_widget_elementor_item($forest_post_settings);
				
				$ret .= ob_get_contents();
				
				ob_end_clean();		
				
				$ret .= '</div>'; // kode-ux				
				$ret .= '</div>'; // column_class
				$current_size ++;
			}
			wp_reset_postdata();
			
			return $ret;
			
		}
	}
	
	function forest_get_blog_widget_elementor_item($forest_post_settings){
		global $post;
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = $forest_post_settings['title_num_fetch'];
		}		
		
		$num_excerpt = '';
		if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		$blog_class = 'top-margin-push-image';
		$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? '': $forest_post_settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class('kode_blog_des'); ?>>
			<figure class="them_overlay">
				<?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
				<a data-rel="prettyPhoto" class="expand_btn btn_hover2" href="#"><i class="fa fa-expand"></i></a>
			</figure>
			<div class="kode_blog_text">
				<h4><a href="<?php echo esc_url(get_permalink())?>"><span><?php echo esc_attr(substr(get_the_title(),0,$title_num_fetch)); ?></span> <?php echo esc_attr__('In Eid Event','islamic-center'); ?></a></h4>
				<ul class="kode_meta meta_2">
					<?php echo islamic_center_get_blog_info(array('date'), false, '','li');?>
					<?php echo islamic_center_get_blog_info(array('author'), false, '','li');?>
				</ul>
				<?php 
					if(!empty($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
						
					}else{					
						if( is_single() || $forest_post_settings['excerpt'] < 0 || $forest_post_settings['excerpt'] == 'full'){
							echo '<div class="kode-blog-content">';
							echo forest_content_filter(strip_tags($post->post_content), true);
							wp_link_pages( array( 
								'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jobly' ) . '</span>', 
								'after' => '</div>', 
								'link_before' => '<span>', 
								'link_after' => '</span>' )
							);
							echo '</div>';
						}else if( $forest_post_settings['excerpt'] != 0 ){
							echo '<div class="kode-blog-content"><p>' . substr(strip_tags($post->post_content),0,$forest_post_settings['excerpt']) .'...</p>';
							echo '</div>';	
						}
					}
				?>
				<a class="medium_btn background-bg-dark btn_hover hvr-wobble-bottom" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr__('See More','islamic-center'); ?></a>
				<a class="share_link hvr-ripple-out" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-share-alt"></i></a>
			</div>
		</article>
		
		<?php 
	}
	
	if( !function_exists('forest_get_blog_grid_elementor') ){
		function forest_get_blog_grid_elementor($query,$settings){
			global $forest_post_settings;
			
			$size = $settings['blog_size'];
			
			$forest_post_settings['excerpt'] = $settings['num_excerpt'];
			
			if($settings['blog_slider'] == 'slider'){ return forest_get_blog_grid_elementor_carousel($query, $size); }
			
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $forest_post_settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$forest_post_settings['post'] = $post;
				if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = $forest_post_settings['title_num_fetch'];
				}		
				$forest_post_settings['content'] = get_the_content();
				if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				$blog_class = 'top-margin-push-image';
				$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];
				$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true);

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-blog-grid-ux">';
				ob_start(); 
				
				forest_get_blog_grid_elementor_item($forest_post_settings);
				
				$ret .= ob_get_contents();
				
				ob_end_clean();		
				
				$ret .= '</div>'; // kode-ux				
				$ret .= '</div>'; // column_class
				$current_size ++;
			}
			$ret .= '<div class="clear"></div>';
			
			wp_reset_postdata();
			
			return $ret;
		}
	}	
	
	function forest_get_blog_grid_elementor_item($forest_post_settings){
		global $post;
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = $forest_post_settings['title_num_fetch'];
		}		
		$num_excerpt = '';
		if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		
		$blog_class = 'top-margin-push-image';
		$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true); ?>
		
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
			<div class="kode_blog_fig">
				<figure class="them_overlay">
					<?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
					<a class="plus_icon hvr-ripple-out" href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-plus"></i></a>
				</figure>
				<div class="kode_blog_text">
					<ul class="kode_meta">
						<li><a href="#"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date('d F , Y'));?></a></li>
						<?php echo islamic_center_get_blog_info(array('author'),'','','li'); ?>
					</ul>
					<div class="clearfix clear"></div>
					<h5><?php echo substr(esc_attr(get_the_title()),0,$forest_post_settings['title_num_fetch']);?> </h5>
					<ul class="kode_meta meta_2">
						<?php echo islamic_center_get_blog_info(array('comment'),'','','li'); ?>
						<?php echo islamic_center_get_blog_info(array('views'),'','','li'); ?>
					</ul>
				</div>
			</div>
		</article>
		
		<?php 
	}

	if( !function_exists('forest_get_portfolio_widget_elementor') ){
		function forest_get_portfolio_widget_elementor($query,$settings){
			global $forest_post_settings;
			
			$size = $settings['blog_size'];
			
			$forest_post_settings['excerpt'] = $settings['num_excerpt'];
			
			if($settings['blog_slider'] == 'slider'){ return forest_get_blog_grid_elementor_carousel($query, $size); }
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $forest_post_settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$forest_post_settings['post'] = $post;
				if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = $forest_post_settings['title_num_fetch'];
				}		
				$forest_post_settings['content'] = get_the_content();
				if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				
				$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(forest_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-blog-grid-ux">';
				ob_start();
				
				forest_get_portfolio_widget_elementor_item($forest_post_settings);
				
				$ret .= ob_get_contents();
				
				ob_end_clean();		
				
				$ret .= '</div>'; // kode-ux				
				$ret .= '</div>'; // column_class
				$current_size ++;
			}
			wp_reset_postdata();
			
			return $ret;
			
		}
	}
	
	function forest_get_portfolio_widget_elementor_item($forest_post_settings){
		global $post;
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = $forest_post_settings['title_num_fetch'];
		}		
		
		$num_excerpt = '';
		if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		$blog_class = 'top-margin-push-image';
		$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? '': $forest_post_settings['thumbnail_size'];
		$forest_get_image = forest_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('job_news_fig list'); ?>>
		<div class="kode_portfolio_des">
				<figure class="them_overlay">
					<?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
				</figure>
				<div class="kode_portfolio_text">
					<h6><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(substr(get_the_title(),0,$title_num_fetch)); ?></a></h6>
					<?php 
						if(!empty($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
							
						}else{					
							if( is_single() || $forest_post_settings['excerpt'] < 0 || $forest_post_settings['excerpt'] == 'full'){
								echo '<div class="kode-blog-content">';
								echo forest_content_filter(strip_tags($post->post_content), true);
								wp_link_pages( array( 
									'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jobly' ) . '</span>', 
									'after' => '</div>', 
									'link_before' => '<span>', 
									'link_after' => '</span>' )
								);
								echo '</div>';
							}else if( $forest_post_settings['excerpt'] != 0 ){
								echo '<div class="kode-blog-content"><p>' . substr(strip_tags($post->post_content),0,$forest_post_settings['excerpt']) .'...</p>';
								echo '</div>';	
							}
						}
					?>
				</div>
			</div>
		</article>
		
		<?php 
	}
	
	if( !function_exists('forest_get_blog_full_elementor') ){
		function forest_get_blog_full_elementor($query,$settings){
			
			$size = $settings['blog_size'];
			
			$forest_post_settings['excerpt'] = $settings['num_excerpt'];
			
			if($settings['blog_slider'] == 'slider'){ return forest_get_blog_grid_elementor_carousel($query, $size); }
		
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $forest_post_settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$forest_post_settings['content'] = get_the_content();
				$forest_post_settings['post'] = $post;
				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-blog-grid-ux">';
				ob_start(); 
				
				forest_get_blog_full_elementor_item($forest_post_settings);
				
				$ret .= ob_get_contents();
				
				ob_end_clean();		
				
				$ret .= '</div>'; // kode-ux				
				$ret .= '</div>'; // column_class
				$current_size ++;
			}
			$ret .= '<div class="clear"></div>';
			
			wp_reset_postdata();
			
			return $ret;
		}
	}	


	function forest_get_blog_full_elementor_item($forest_post_settings){ 
		global $post;
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = $forest_post_settings['title_num_fetch'];
		}		
		$num_excerpt = '';
		if(!isset($forest_post_settings['title_num_fetch']) && empty($forest_post_settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		if(isset($forest_post_settings['excerpt']) && $forest_post_settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		
		$blog_class = 'top-margin-push-image';
		$thumbnail_size = (empty($forest_post_settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail-size']: $forest_post_settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($thumbnail_size), true); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="kode-standard-style">
				<?php echo get_the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
				<div class="blog-date-wrapper">
					<span class="blog-date-day"><?php echo esc_attr(get_the_time('j')); ?></span>
					<span class="blog-date-saperator"><i class="fa fa-times"></i></span>
					<span class="blog-date-month"><?php echo esc_attr(get_the_time('M')); ?></span>
				</div>
				<header class="post-header">
					<h3 class="kode-blog-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(substr(get_the_title(),0,$title_num_fetch)); ?></a></h3>

					<?php echo islamic_center_get_blog_info(array('author', 'comment')); ?>		
					<div class="clear"></div>
				</header><!-- entry-header -->
				<div class="clear"></div>
			</div>
		</article><!-- #post -->
		
		<?php 
	}
	
	if( !function_exists('forest_get_blog_grid_elementor_carousel') ){
		function forest_get_blog_grid_elementor_carousel($query, $size){
			global $forest_post_settings;
			$ret = ''; 			
			$ret .= '<div class="owl-carousel owl-theme" data-slide="'.esc_attr($size).'" >';			
			while($query->have_posts()){ $query->the_post();
				$ret .= '<div class="item">';
					
				$ret .= '</div>'; // kode-item
			}
			$ret .= '</div>';
			$ret .= '<div class="clear"></div>';			
			wp_reset_postdata();
			
			return $ret;
		}
	}		
	