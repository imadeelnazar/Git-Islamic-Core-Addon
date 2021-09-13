<?php
	
	if( !function_exists('forest_get_woo_elementor') ){
		function forest_get_woo_elementor( $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $forest_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $forest_spaces['bottom-woo-item'])? 'margin-bottom: ' . esc_attr($settings['margin-bottom']) . 'px;': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			
			$ret = '';
			$ret .= '<div class="col-md-12 woo-item-wrapper"  ' . $item_id . $margin_style . '>';
			
			// query post and sticky post
			$args = array('post_type' => 'product', 'suppress_filters' => false);
			if( !empty($settings['category']) || !empty($settings['tag']) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['category']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'product_cat', 'field'=>'slug'));
				}
				if( !empty($settings['tag']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['tag']), 'taxonomy'=>'product_tag', 'field'=>'slug'));
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
			$settings['num_excerpt'] = (empty($settings['num_excerpt']))? '': $settings['num_excerpt'];
			$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? '': $settings['thumbnail_size'];
			$settings['style'] = (empty($settings['style']))? '': $settings['style'];
			$settings['column_size'] = (empty($settings['column_size']))? '': $settings['column_size'];

			// set the excerpt length
			if( !empty($settings['num_excerpt']) ){
				global $forest_excerpt_length; $forest_excerpt_length = $settings['num_excerpt'];
				// add_filter('excerpt_length', 'forest_set_excerpt_length');
			} 
			


			// get woo by the woo style
			global $settings, $forest_lightbox_id;
			$forest_lightbox_id++;
			
			$settings['thumbnail_size'] = $settings['thumbnail_size'];				
			
			
			$ret .= '<div class="woo-item-holder">';
			if(isset($settings['style'] ) && $settings['style'] == 'woo-full'){
				$settings['woo_size'] = 1;	
				$ret .= '<div class="kode-woo-list-full kode-large-woo row">';
				
				$ret .= forest_get_woo_full_elementor($query, $settings);
				$ret .= '</div>';
			}else if(isset($settings['style'] ) && $settings['style'] == 'woo-small'){
				$ret .= '<div class="kode-woo-small kode-small-woo row">';
				
				$ret .= forest_get_woo_small_elementor($query, $settings);	
				$ret .= '</div>';
			}else if(isset($settings['style'] ) && strpos($settings['style'], 'woo-widget') !== false){
				
				$ret .= '<div class="kode-woo-widget kode-widget-woo row">';
				$ret .= forest_get_woo_widget_elementor($query, $settings);
				$ret .= '</div>';
			}else if(isset($settings['style'] ) && strpos($settings['style'], 'woo-grid') !== false){
				
				$ret .= '<div class="kode-woo-grid kode-grid-woo row">';
				$ret .= forest_get_woo_grid_elementor($query, $settings);
				$ret .= '</div>';		
			}else{
				$ret .= '<div class="kode-woo-list-dd kode-grid-woo row">';
				$ret .= forest_get_woo_small_elementor($query, $settings);
				$ret .= '</div>';
			}
			$ret .= '</div>';
			
			if( isset($settings['pagination']) && $settings['pagination'] == 'true' ){
				$ret .= forest_get_pagination($query->max_num_pages, $args['paged']);
			}
			wp_reset_postdata();
			wp_reset_query();
			$ret .= '</div>'; // woo-item-wrapper
			
			
			return $ret;
		}
	}
	
	if( !function_exists('forest_get_woo_small_elementor') ){
		function forest_get_woo_small_elementor($query,$settings){
			global $settings;
			
			$settings['excerpt'] = (empty($settings['num_excerpt']))? 20: $settings['num_excerpt'];

			
			$size = 3;
			$settings = $settings;
			
			if(isset($settings['listing']) && $settings['listing'] == 'slider'){ return forest_get_woo_grid_elementor_carousel($query, $size); }
			
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){
				$query->the_post();
				global $settings,$forest_admin_option,$post;
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($settings['title_num_fetch'])){
					$title_num_fetch = $settings['title_num_fetch'];
				}		
				$settings['content'] = get_the_content();
				if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				$settings['post'] = $post;
				$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail_size']: $settings['thumbnail_size'];
				$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true);

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-woo-grid-ux">';
				ob_start(); 
				
				echo forest_get_woo_small_elementor_item($settings);
				
				$ret .= ob_get_contents();
				
				ob_end_clean();		
				
				$ret .= '</div>'; // kode-ux				
				$ret .= '</div>'; // column_class
				$current_size++;
			}
			wp_reset_postdata();
			
			return $ret;
			
		}
	}
	
	function forest_get_woo_small_elementor_item($settings){
		global $post, $product;
		$prices_precision = wc_get_price_decimals();
		$price = wc_format_decimal( $product->get_price(), $prices_precision );
		$price_regular = wc_format_decimal( $product->get_regular_price(), $prices_precision );
		$price_sale = $product->get_sale_price() ? floatval(wc_format_decimal( $product->get_sale_price(), $prices_precision )) : null;
		if(empty($price_sale)){
			$price_sale = $price_regular;
		}
		$get_currency = get_woocommerce_currency_symbol('');
		if($get_currency == ''){
			$get_currency = get_option('woocommerce_currency');
		}	
		if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($settings['title_num_fetch'])){
			$title_num_fetch = $settings['title_num_fetch'];
		}		
		
		if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		$woo_class = 'top-margin-push-image';
		$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? '': $settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true); 
		
		$html = '
			<div class="kode_shop_fig">
				<figure class="them_overlay">
				
					'.get_the_post_thumbnail($post->ID, $settings['thumbnail_size']).'
					 
					<ul class="shop_icon">
						<li>';
						$html .= apply_filters( 'woocommerce_loop_add_to_cart_link',
						sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="cart button %s product_type_%s"><i class="fa fa-cart-plus"></i></a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( isset( $quantity ) ? $quantity : 1 ),
							esc_attr( $product->get_id() ),
							esc_attr( $product->get_sku() ),
							esc_attr( isset( $class ) ? $class : 'button' ),
							esc_html( $product->add_to_cart_text() )
						),
						$product );	
						
						$html .= '</li>
						<li><a href="#"><i class="fa fa-heart"></i></a></li>
						<li><a href="'.esc_url(get_permalink()).'"><i class="fa fa-expand"></i></a></li>
					</ul>
				</figure>
				<div class="kode_shop_text">
					<h6><a href="'.esc_url(get_permalink()).'">'.esc_attr(get_the_title()).'</a></h6>
					<div class="event_rating pull-right">
						<a href="#"><i class="fa fa-star"></i></a>
						<a href="#"><i class="fa fa-star"></i></a>
						<a href="#"><i class="fa fa-star"></i></a>
						<a href="#"><i class="fa fa-star"></i></a>
						<a href="#"><i class="fa fa-star"></i></a>
					</div>
					<h5>'.esc_attr($get_currency).''.esc_attr($price_sale).'</h5>
				</div>
			</div>';

		return $html;
		
	}
	
	if( !function_exists('forest_get_woo_widget_elementor') ){
		function forest_get_woo_widget_elementor($query,$settings){
			global $settings;
			
			$size = $settings['woo_size'];
			
			$settings['excerpt'] = $settings['num_excerpt'];
			
			if($settings['woo_slider'] == 'slider'){ return forest_get_woo_grid_elementor_carousel($query, $size); }
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$settings['post'] = $post;
				if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($settings['title_num_fetch'])){
					$title_num_fetch = $settings['title_num_fetch'];
				}		
				$settings['content'] = get_the_content();
				if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				
				$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? '': $settings['thumbnail_size'];
				$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true);

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-woo-grid-ux">';
				ob_start();
				
				forest_get_woo_widget_elementor_item($settings);
				
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
	
	function forest_get_woo_widget_elementor_item($settings){
		global $post;
		if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($settings['title_num_fetch'])){
			$title_num_fetch = $settings['title_num_fetch'];
		}		
		
		$num_excerpt = '';
		if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		
		if(isset($settings['excerpt']) && $settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		$woo_class = 'top-margin-push-image';
		$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? '': $settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class('kode_woo_des'); ?>>
			<figure class="them_overlay">
				<?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
				<a data-rel="prettyPhoto" class="expand_btn btn_hover2" href="#"><i class="fa fa-expand"></i></a>
			</figure>
			<div class="kode_woo_text">
				<h4><a href="<?php echo esc_url(get_permalink())?>"><span><?php echo esc_attr(substr(get_the_title(),0,$title_num_fetch)); ?></span> <?php echo esc_attr__('In Eid woo','islamic-center'); ?></a></h4>
				<ul class="kode_meta meta_2">
					<?php echo islamic_center_get_woo_info(array('date'), false, '','li');?>
					<?php echo islamic_center_get_woo_info(array('author'), false, '','li');?>
				</ul>
				<?php 
					if(!empty($settings['excerpt']) && $settings['excerpt'] == 0){
						
					}else{					
						if( is_single() || $settings['excerpt'] < 0 || $settings['excerpt'] == 'full'){
							echo '<div class="kode-woo-content">';
							echo forest_content_filter(strip_tags($post->post_content), true);
							wp_link_pages( array( 
								'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'jobly' ) . '</span>', 
								'after' => '</div>', 
								'link_before' => '<span>', 
								'link_after' => '</span>' )
							);
							echo '</div>';
						}else if( $settings['excerpt'] != 0 ){
							echo '<div class="kode-woo-content"><p>' . substr(strip_tags($post->post_content),0,$settings['excerpt']) .'...</p>';
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
	
	if( !function_exists('forest_get_woo_grid_elementor') ){
		function forest_get_woo_grid_elementor($query,$settings){
			global $settings;
			
			$size = $settings['woo_size'];
			
			$settings['excerpt'] = $settings['num_excerpt'];
			
			//if($settings['woo_slider'] == 'slider'){ return forest_get_woo_grid_elementor_carousel($query, $size); }
			
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$settings['post'] = $post;
				if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
				if(isset($settings['title_num_fetch'])){
					$title_num_fetch = $settings['title_num_fetch'];
				}		
				$settings['content'] = get_the_content();
				if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
					$title_num_fetch = 100;
				}
				$woo_class = 'top-margin-push-image';
				$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? '': $settings['thumbnail_size'];
				$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true);

				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-woo-grid-ux">';
				ob_start(); 
				
				forest_get_woo_grid_elementor_item($settings);
				
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
	
	function forest_get_woo_grid_elementor_item($settings){
		global $post;
		if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($settings['title_num_fetch'])){
			$title_num_fetch = $settings['title_num_fetch'];
		}		
		$num_excerpt = '';
		if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		if(isset($settings['excerpt']) && $settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		
		$woo_class = 'top-margin-push-image';
		$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail_size']: $settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true); ?>
		
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
			<div class="kode_woo_fig">
				<figure class="them_overlay">
					<?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
					<a class="plus_icon hvr-ripple-out" href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-plus"></i></a>
				</figure>
				<div class="kode_woo_text">
					<ul class="kode_meta">
						<li><a href="#"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date('d F , Y'));?></a></li>
						<?php echo islamic_center_get_woo_info(array('author'),'','','li'); ?>
					</ul>
					<h5><?php echo substr(esc_attr(get_the_title()),0,$settings['title_num_fetch']);?> </h5>
					<ul class="kode_meta meta_2">
						<?php echo islamic_center_get_woo_info(array('comment'),'','','li'); ?>
						<?php echo islamic_center_get_woo_info(array('views'),'','','li'); ?>
					</ul>
				</div>
			</div>
		</article>
		
		<?php 
	}
	
	if( !function_exists('forest_get_woo_full_elementor') ){
		function forest_get_woo_full_elementor($query,$settings){
			
			$size = $settings['woo_size'];
			
			$settings['excerpt'] = $settings['num_excerpt'];
			
			if($settings['woo_slider'] == 'slider'){ return forest_get_woo_grid_elementor_carousel($query, $size); }
		
			$ret = ''; $current_size = 0;			
			while($query->have_posts()){ 
				global $settings,$forest_admin_option,$post;
				$query->the_post();
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clearfix clear"></div>';
				}
				$settings['content'] = get_the_content();
				$settings['post'] = $post;
				$ret .= '<div class="col-sm-6 col-xs-12 ' . esc_attr(islamic_center_get_column_class('1/' . $size)) . '">';
				$ret .= '<div class="kode-ux kode-woo-grid-ux">';
				ob_start(); 
				
				forest_get_woo_full_elementor_item($settings);
				
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


	function forest_get_woo_full_elementor_item($settings){ 
		global $post;
		if(isset($settings['excerpt']) && $settings['excerpt'] < 0) global $forest_more; $forest_more = 0;
		if(isset($settings['title_num_fetch'])){
			$title_num_fetch = $settings['title_num_fetch'];
		}		
		$num_excerpt = '';
		if(!isset($settings['title_num_fetch']) && empty($settings['title_num_fetch'])){
			$title_num_fetch = 100;
		}
		if(isset($settings['excerpt']) && $settings['excerpt'] == 0){
			$num_excerpt = 0;
		}
		
		$woo_class = 'top-margin-push-image';
		$settings['thumbnail_size'] = (empty($settings['thumbnail_size']))? $forest_admin_option['kode-post-thumbnail_size']: $settings['thumbnail_size'];
		$forest_get_image = islamic_center_get_image(get_post_thumbnail_id(), esc_attr($settings['thumbnail_size']), true); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="kode-standard-style">
				<?php echo get_the_post_thumbnail(get_the_ID(), $settings['thumbnail_size']); ?>
				<div class="woo-date-wrapper">
					<span class="woo-date-day"><?php echo esc_attr(get_the_time('j')); ?></span>
					<span class="woo-date-saperator"><i class="fa fa-times"></i></span>
					<span class="woo-date-month"><?php echo esc_attr(get_the_time('M')); ?></span>
				</div>
				<header class="post-header">
					<h3 class="kode-woo-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(substr(get_the_title(),0,$title_num_fetch)); ?></a></h3>

					<?php echo islamic_center_get_woo_info(array('author', 'comment')); ?>		
					<div class="clear"></div>
				</header><!-- entry-header -->
				<div class="clear"></div>
			</div>
		</article><!-- #post -->
		
		<?php 
	}
	
	if( !function_exists('forest_get_woo_grid_elementor_carousel') ){
		function forest_get_woo_grid_elementor_carousel($query, $size){
			global $settings;
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
	

	if( !function_exists('islamic_center_get_woo_info') ){
		function islamic_center_get_woo_info( $woo_id='', $array = array(), $wrapper = true, $sep = '',$div_wrap = 'div' ){
			global $islamic_center_theme_option; $ret = '';
			if( empty($array) ) return $ret;
			//$exclude_meta = empty($islamic_center_theme_option['post-meta-data'])? array(): esc_attr($islamic_center_theme_option['post-meta-data']);
			
			foreach($array as $post_info){
				
				if( !empty($sep) ) $ret .= $sep;

				switch( $post_info ){
					case 'date':
						$ret .= '<'.esc_attr($div_wrap).' class="woo-info woo-date"><i class="fa fa-clock-o"></i>';
						$ret .= '<a href="' . esc_url(get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d'))) . '">';
						$ret .= esc_attr(get_the_time());
						$ret .= '</a>';
						$ret .= '</'.esc_attr($div_wrap).'>';
						break;
					case 'tag':
						$tag = get_the_term_list($woo_id, 'product_tag', '', ' , ' , '' );
						if(empty($tag)) break;					
						
						$ret .= '<'.esc_attr($div_wrap).' class="woo-info woo-tags"><i class="fa fa-tag" aria-hidden="true"></i>';
						$ret .= $tag;						
						$ret .= '</'.esc_attr($div_wrap).'>';					
						break;
					case 'category':
						$category = get_the_term_list($woo_id, 'woo-categories', '', '<span class="sep">,</span> ' , '' );
						if(empty($category)) break;
						
						$ret .= '<'.esc_attr($div_wrap).' class="woo-info woo-category"><i class="fa fa-list"></i>';
						$ret .= $category;					
						$ret .= '</'.esc_attr($div_wrap).'>';			
						break;
					case 'comment':
						$ret .= '<'.esc_attr($div_wrap).' class="woo-info woo-comment">';
						$ret .= '<a class="eco_share" href="' . esc_url(get_permalink($woo_id)) . '#respond" ><i class="fa fa-comment-o"></i>' . esc_attr(get_comments_number()) . ' <span class="kode-comment-ite">'.esc_attr__('Comments','islamic-center').'</span></a>';
						$ret .= '</'.esc_attr($div_wrap).'>';					
						break;
					case 'author':
						ob_start();
						the_author_posts_link();
						$author = ob_get_contents();
						ob_end_clean();
						
						$ret .= '<'.esc_attr($div_wrap).' class="woo-info woo-author"><i class="fa fa-user"></i>';
						$ret .= $author;
						$ret .= '</'.esc_attr($div_wrap).'>';			
						break;						
				}
			}
			
			
			if($wrapper && !empty($ret)){
				return '<div class="kode-woo-info kode-info">' . $ret . '<div class="clear"></div></div>';
			}else if( !empty($ret) ){
				return $ret;
			}
			return '';			
		}
	}