<?php
/**
 * Plugin Name: Kodeforest Islamic Products
 * Plugin URI: http://kodeforest.com/
 * Description: A widget that show Islamic Products( Specified by category ).
 * Version: 1.0
 * Author: Kodeforest
 * Author URI: http://www.kodeforest.com
 *
 */

add_action( 'widgets_init', 'islamic_center_islamic_products_widget' );
if( !function_exists('islamic_center_islamic_products_widget') ){
	function islamic_center_islamic_products_widget() {
		register_widget( 'Kodeforest_Islamic_Products' );
	}
}

if( !class_exists('Kodeforest_Islamic_Products') ){
	class Kodeforest_Islamic_Products extends WP_Widget{

		// Initialize the widget
		function __construct() {
			parent::__construct(
				'islamic_center_islamic_products_widget', 
				esc_html__('Islamic Products Widget','islamic-center'), 
				array('description' => esc_html__('A widget that show Islamic Products(Specified by category)', 'islamic-center')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			global $islamic_center_theme_option;	
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: '';
			$custom_class = isset($instance['custom_class'])? $instance['custom_class']: '';
			$title = apply_filters( 'widget_title', $title );
			
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Widget Content
			$current_post = array(get_the_ID());		
			$query_args = array('post_type' => 'product', 'suppress_filters' => false);
			$query_args['posts_per_page'] = $num_fetch;
			$query_args['orderby'] = 'post_date';
			$query_args['order'] = 'desc';
			$query_args['paged'] = 1;
			$query_args['product_cat'] = $category;
			$query_args['ignore_sticky_posts'] = 1;
			$query_args['post__not_in'] = array(get_the_ID());
			$query = new WP_Query( $query_args );
			
			
			if($query->have_posts()){	
				wp_register_script('islamic-slick', ISLAMIC_CENTER_PATH.'/framework/include/frontend_assets/slick/slick.min.js', false, '1.0', true);
				wp_enqueue_script('islamic-slick');
				wp_enqueue_style( 'islamic-slick', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/slick/slick.css' );  //owl slider css
				wp_enqueue_style( 'islamic-slick-theme', ISLAMIC_CENTER_PATH . '/framework/include/frontend_assets/slick/slick-theme.css' );  //owl slider css
				
				echo '<div class="kode_product_list '.esc_attr($custom_class).'">';
						if( !empty($title) ){ 
							echo $args['before_title'] . esc_attr($title) . $args['after_title']; 
						}echo '<div class="kode-product-slide">';
							while($query->have_posts()){ $query->the_post();
								global $post, $product;
								
								$prices_precision = wc_get_price_decimals();
								$price = wc_format_decimal( $product->get_price(), $prices_precision );
								$price_regular = wc_format_decimal( $product->get_regular_price(), $prices_precision );
								$price_sale = $product->get_sale_price() ? floatval(wc_format_decimal( $product->get_sale_price(), $prices_precision )) : null;
								
								$currency = get_woocommerce_currency_symbol();
								if(isset($currency) && $currency <> '')
								{
									$currency = get_woocommerce_currency_symbol();
								}else{
									$currency = '$';
								}
								$thumbnail = islamic_center_get_image(get_post_thumbnail_id(), array(350,350));
								echo '
									<div>
										<figure>
											'.$thumbnail.'
											<h6>Sale</h6>
										</figure>
								
										<div class="kode_product_text">
											<h5><a href="'.esc_url(get_permalink()).'">'.substr(get_the_title(),0,30).'</a></h5>
											<span>'.esc_attr($currency).''.esc_attr($price_regular).'</span>
											<span>'.esc_attr($currency).''.esc_attr($price_sale).'</span>
										</div>
										<div class="kode_product_rating">
											<ul class="rating_star">
												<li><a href="#"><i class="fa fa-star"></i></a></li>
												<li><a href="#"><i class="fa fa-star"></i></a></li>
												<li><a href="#"><i class="fa fa-star"></i></a></li>
												<li><a href="#"><i class="fa fa-star"></i></a></li>
												<li><a href="#"><i class="fa fa-star"></i></a></li>
											</ul>
											<ul class="product_icon">
												<li><a href="#"><i class="fa fa-cart-plus"></i></a></li>
												<li><a href="#"><i class="fa fa-heart"></i></a></li>
											</ul>
										</div>
									</div>';
							}
						echo '</div>
					</div>';
			}
			wp_reset_postdata();
					
			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$category = isset($instance['category'])? $instance['category']: '';
			$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 3;
			$custom_class = isset($instance['custom_class'])? $instance['custom_class']:'';
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
				$category_list = islamic_center_get_term_list('product_cat'); 
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
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('custom_class')); ?>"><?php esc_html_e('Custom Class :', 'islamic-center'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('custom_class')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_class')); ?>" type="text" value="<?php echo esc_attr($custom_class); ?>" />
			</p>

		<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['category'] = (empty($new_instance['category']))? '': strip_tags($new_instance['category']);
			$instance['num_fetch'] = (empty($new_instance['num_fetch']))? '': strip_tags($new_instance['num_fetch']);
			$instance['custom_class'] = (empty($new_instance['custom_class']))? '': strip_tags($new_instance['custom_class']);

			return $instance;
		}	
	}
}
?>