<?php
namespace ElementorDefaultCPT\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Project Facts
 *
 * Elementor widget for project facts.
 *
 * @since 1.0.0
 */
class Noble_Cause extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'noble-cause';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Noble Cause', 'elementor-call-to-action' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-alert';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'kodeforest' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		
		return [ 'core-style', 'progressbar-script-js', 'progressbar-script-css' ];	
		
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'noble_cause_settings',
			[
				'label' => __( 'Noble Cause', 'elementor-call-to-action' ),
			]
		);
		
		$this->add_control(
			'noble_cause_type',
			[
				'label' => esc_html__( 'Type', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' 	=> false,
				'default' => esc_html__( 'style-1', 'essential-addons-elementor' ),
		     	'options' 		=> [				
					'style-1' => esc_html__('Style 1', 'jobly'),
					'style-2' => esc_html__('Style 2', 'jobly'),
		     	],
			]
		);
		
		$this->add_control(
			'noble_cause_post',
			[
				'label' => esc_html__( 'Noble Cause Post Name', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' 	=> false,
				'default' => esc_html__( '', 'essential-addons-elementor' ),
				'condition' => [
					'noble_cause_type' => 'style-2'
				],
		     	'options' => wpha_get_post_list_id('campaign'),
			]
		);
		
		$this->add_control(
			'noble_cause_amount_donated_num',
			[
				'label' => esc_html__( 'Amount Donated Number', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				
				'label_block' => true,
				'default' => esc_html__( '77', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'noble_cause_amount_received_txt',
			[
				'label' => esc_html__( 'Amount Received Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				// 'condition' => [
					// 'noble_cause_type' => 'style-2'
				// ],
				'label_block' => true,
				'default' => esc_html__( 'Amount Received', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'noble_cause_amount_received_num',
			[
				'label' => esc_html__( 'Amount Received Number', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				
				'label_block' => true,
				'default' => esc_html__( '$2,0000', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'noble_cause_amount_target_txt',
			[
				'label' => esc_html__( 'Amount Target Text', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				
				'label_block' => true,
				'default' => esc_html__( 'Targeted Amount', 'essential-addons-elementor' )
			]
		);
		
		$this->add_control(
			'noble_cause_amount_target_num',
			[
				'label' => esc_html__( 'Amount Target Number', 'essential-addons-elementor' ),
				'type' => Controls_Manager::TEXT,
				
				'label_block' => true,
				'default' => esc_html__( '$3,0000', 'essential-addons-elementor' )
			]
		);
		
		
		
		$this->end_controls_section();

		/**
		 * Slider Text Settings
		 */
		$this->start_controls_section(
			'noble_cause_color_settings',
			[
				'label' => esc_html__( 'Color & Design', 'essential-addons-elementor' ),
			]
		);
	
		$this->add_control(
			'noble_cause_sec_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'condition' => [
					 'noble_cause_type' => 'style-1'
				 ],
				'selectors' => [
					'{{WRAPPER}} .kode_canvas_text h5 '=> 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'noble_cause_sec_number_color',
			[
				'label' => esc_html__( 'Number Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d2973b',
				'condition' => [
					'noble_cause_type' => 'style-1'
				],
				'selectors' => [
					'{{WRAPPER}} .kode_canvas_text h4 '=> 'color: {{VALUE}};',
				],
			]
		);

		/*	$this->add_control(
			'noble_cause_sec_number_border_color',
			[
				'label' => esc_html__( 'Border Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} ' => 'border-color: {{VALUE}} !important;',
				],
			]
		);*/

		$this->add_control(
			'noble_cause_sec_title_size',
			[
				'label' => esc_html__( 'Title Size', 'essential-addons-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 18
				],
				'condition' => [
					'noble_cause_type' => 'style-1'
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 60,
						'step' => 1
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kode_canvas_text h5' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'noble_cause_sec_title_weight',
				[
				 'label'       	=> esc_html__( 'Title Font Weight', 'essential-addons-elementor' ),
				   'type' 			=> Controls_Manager::SELECT,
				   'default' 		=> '400',
				   'condition' => [
					'noble_cause_type' => 'style-1'
				],
				   'label_block' 	=> false,
				   'options' 		=> [				
					  'normal' => esc_html__('normal', 'jobly'),  
					  '100' => esc_html__('100', 'jobly'),
					  '200' => esc_html__('200', 'jobly'),
					  '300' => esc_html__('300', 'jobly'),
					  '400' => esc_html__('400', 'jobly'),
					  '500' => esc_html__('500', 'jobly'),
					  '600' => esc_html__('600', 'jobly'),
					  '700' => esc_html__('700', 'jobly'),
					  '800' => esc_html__('800', 'jobly'),
					  'bold' => esc_html__('Bold', 'jobly')
				   ],
				   'selectors' => [
						'{{WRAPPER}} .kode_canvas_text h5' => 'font-weight: {{VALUE}};',
					]
				]
	   );
	   $this->add_control(
		'noble_cause_sec_number_size',
		[
			'label' => esc_html__( 'Number Size', 'essential-addons-elementor' ),
			'type' => Controls_Manager::SLIDER,
			'default' => [
				'size' => 20
			],
			'condition' => [
				'noble_cause_type' => 'style-1'
			],
			'range' => [
				'px' => [
					'min' => 10,
					'max' => 60,
					'step' => 1
				],
			],
			'selectors' => [
				'{{WRAPPER}} .kode_canvas_text h4' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_control(
		'noble_cause_sec_number_weight',
			[
			 'label'       	=> esc_html__( 'Number Font Weight', 'essential-addons-elementor' ),
			   'type' 			=> Controls_Manager::SELECT,
			   'default' 		=> '400',
			   'condition' => [
				'noble_cause_type' => 'style-1'
			],
			   'label_block' 	=> false,
			   'options' 		=> [				
				  'normal' => esc_html__('normal', 'jobly'),  
				  '100' => esc_html__('100', 'jobly'),
				  '200' => esc_html__('200', 'jobly'),
				  '300' => esc_html__('300', 'jobly'),
				  '400' => esc_html__('400', 'jobly'),
				  '500' => esc_html__('500', 'jobly'),
				  '600' => esc_html__('600', 'jobly'),
				  '700' => esc_html__('700', 'jobly'),
				  '800' => esc_html__('800', 'jobly'),
				  'bold' => esc_html__('Bold', 'jobly')
			   ],
			   'selectors' => [
					'{{WRAPPER}} .kode_canvas_text h4' => 'font-weight: {{VALUE}};',
				]
			]
   );
		
		
		
		
		$this->add_control(
			'noble_cause_title_color',
			[
				'label' => esc_html__( 'Title Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#282d33',
				'condition' => [
					'noble_cause_type' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .kode_doantion_amount h4,.kode_donation_row h4,.kode_payment_list form-submit h4 '=> 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'noble_cause_button_bg_color',
			[
				'label' => esc_html__( 'Button Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d2973b',
				'condition' => [
					'noble_cause_type' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .form-submit input' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'noble_cause_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'essential-addons-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'noble_cause_type' => 'style-2'
				],
				'selectors' => [
					'{{WRAPPER}} .kode_donate_des' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {		
		
		$settings = $this->get_settings();
		if(isset($settings['noble_cause_type']) && $settings['noble_cause_type'] == 'style-2'){ ?>
			<div class="make-cause-donation call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
				
					<?php echo $this->islamic_center_featured_campaign_donation($settings['noble_cause_amount_target_num'],$settings['noble_cause_post']);?>
				
			</div>
		<?php }else{ ?>
			<div class="call-to-action-wrapper call-to-action-<?php echo esc_attr( $this->get_id() ); ?>">
				
				
				<div class="kode_cause_text">
					<div class="kode_cause_canvas">
						<div class="kode_canvas_detail">
							<div class="progress-bar position" data-percent="<?php echo esc_attr($settings['noble_cause_amount_donated_num'])?>" data-duration="1000" data-color="#3d3d3d,#d2973b"></div>
						</div>
						<ul class="kode_canvas_text">
							<li>
								<h5><?php echo esc_html($settings['noble_cause_amount_received_txt'])?></h5>
								<h4><?php echo esc_html($settings['noble_cause_amount_received_num'])?></h4>
							</li>
							<li>
								<h5><?php echo esc_html($settings['noble_cause_amount_target_txt'])?></h5>
								<h4><?php echo esc_html($settings['noble_cause_amount_target_num'])?></h4>
							</li>
						</ul>
					</div>
				</div>
				
			</div>
		<?php 
		}
		
		
	}

	function islamic_center_featured_campaign_donation($goal,$post_id){
		global $islamic_center_theme_option,$post;
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
		
		$islamic_center_theme_option = get_option('islamic_center_admin_option', array());
		//$islamic_center_theme_option['paypal-recipient-email'];
		//$islamic_center_theme_option['paypal-action'];
		$user = empty($islamic_center_theme_option['paypal-recipient-email'])? '': $islamic_center_theme_option['paypal-recipient-email'];
		$action = 'https://www.' . ((!empty($islamic_center_theme_option['paypal-action']) && $islamic_center_theme_option['paypal-action'] == 'sandbox')? 'sandbox.': '') . 'paypal.com/cgi-bin/webscr';
		$currency_code = empty($islamic_center_theme_option['islamic-center-currency'])? 'USD': $islamic_center_theme_option['islamic-center-currency'];
		
		// $islamic_center_post_option = islamic_center_decode_stopbackslashes(get_post_meta($post_id, 'post-option', true ));
		// if( !empty($islamic_center_post_option) ){
			// $islamic_center_post_option = json_decode( $islamic_center_post_option, true );					
		// }
		//$islamic_center_post_content = islamic_center_decode_stopbackslashes(get_post_meta($post_id, 'post-content', true ));
		$islamic_center_post_content = get_post($post_id);
		$author_user =  wp_get_current_user();
		
		ob_start();?>
			<div class="kode_donate_des">
				<form class="kode-custom-pay-form kode_comment" method="post" data-ajax="<?php echo esc_url(ISLAMIC_CENTER_AJAX_URL); ?>" >					
					<div class="kode_doantion_amount">
						<h4><?php echo esc_attr__('Donate Now','wp-campaign'); ?></h4>
						<div class="kode_amount_list">
							<label for="select_price_one">
								<span><?php echo $this->islamic_center_price('50'); ?></span>
								<input id="select_price_one" name="select_price" value="50" type="radio">
							</label>
							<label for="select_price_two">
								<span><?php echo $this->islamic_center_price('100'); ?></span>
								<input id="select_price_two" name="select_price" value="100" type="radio">
							</label>
							<label for="select_price_three">
								<span><?php echo $this->islamic_center_price('150'); ?></span>
								<input id="select_price_three" name="select_price" value="150" type="radio">
							</label>
							<label for="select_price_four">
								<span><?php echo $this->islamic_center_price('200'); ?></span>
								<input id="select_price_four" name="select_price" value="200" type="radio">
							</label>
						</div>
						<div class="kf_commet_field">
							<input type="text" name="price" size="30" placeholder="<?php echo esc_attr__('Other Amount','wp-campaign'); ?>">
						</div>
					</div>
					<!--KODE DONATION ROW START-->
					<div class="kode_donation_row">
						<h4><?php echo esc_attr__('Billing Information','wp-campaign'); ?></h4>
						<!--kode AUTHOR WRAP COMMENTS FORM START -->							
							<div class="row">
								<div class="col-md-6">
									<div class="kf_commet_field">
										<input placeholder="Enter Name" type="text" value="" size="30">
									</div>
								</div>
								<div class="col-md-6">
									<div class="kf_commet_field">
										<input placeholder="Your Email" type="text" value="" size="30">
									</div>
								</div>
								<div class="col-md-12">
									<div class="kf_commet_field">
										<input placeholder="Your Address" type="text" value="" size="30">
									</div>
								</div>
								<div class="col-md-12">
									<div class="kode_payment_list form-submit">
										<h4><?php echo esc_attr__('Choose Your Payment Method','wp-campaign'); ?></h4>
										<ul class="radio_points">
											<?php if(isset($islamic_center_theme_option['enable-paypal-btn']) && $islamic_center_theme_option['enable-paypal-btn'] == 'enable' ){ ?>
											<li>
												<div class="checkbox_radio kode-radio-label-wrap">
													<input id="paypal-<?php echo esc_attr($post_id);?>" type="radio" class="radio_item" data-url="<?php echo esc_url(get_permalink($islamic_center_theme_option['paypal_page']));?>" name="payment_method" data-value="save_paypal_form" />
													<span></span>
													<label for="paypal-<?php echo esc_attr($post_id);?>"><?php echo esc_attr__('Pay Pal','wp-campaign'); ?></label>
												</div>
											</li>
											<?php } if(isset($islamic_center_theme_option['enable-stripe-btn']) && $islamic_center_theme_option['enable-stripe-btn'] == 'enable' ){ ?>	
											<li>
												<div class="checkbox_radio kode-radio-label-wrap">
													<input id="stripe-<?php echo esc_attr($post_id);?>" type="radio" class="radio_item" data-url="<?php echo esc_url(get_permalink($islamic_center_theme_option['stripe_page']));?>" name="payment_method" data-value="save_stripe_redirect" />
													<span></span>
													<label for="stripe-<?php echo esc_attr($post_id);?>"><?php echo esc_attr__('Stripe','wp-campaign'); ?></label>
												</div>
											</li>
											<?php } if(isset($islamic_center_theme_option['enable-paymill-btn']) && $islamic_center_theme_option['enable-paymill-btn'] == 'enable' ){ ?>	
											<li>
												<div class="checkbox_radio kode-radio-label-wrap">
													<input id="paymill-<?php echo esc_attr($post_id);?>" type="radio" class="radio_item" data-url="<?php echo esc_url(get_permalink($islamic_center_theme_option['paymill_page']));?>" name="payment_method" data-value="save_paymill_redirect" />
													<span></span>
													<label for="paymill-<?php echo esc_attr($post_id);?>"><?php echo esc_attr__('Paymill','wp-campaign'); ?></label>
												</div>
											</li>
											<?php } if(isset($islamic_center_theme_option['enable-authorize-btn']) && $islamic_center_theme_option['enable-authorize-btn'] == 'enable' ){ ?>
											<li>
												<div class="checkbox_radio kode-radio-label-wrap">
													<input id="authorize-<?php echo esc_attr($post_id);?>" type="radio" class="radio_item" data-url="<?php echo esc_url(get_permalink($islamic_center_theme_option['authorize_page']));?>" name="payment_method" data-value="authorize_redirect_save" />
													<span></span>
													<label for="authorize-<?php echo esc_attr($post_id);?>"><?php echo esc_attr__('Authorize','wp-campaign'); ?></label>
												</div>
											</li>
											<?php } if(isset($islamic_center_theme_option['enable-skrill-btn']) && $islamic_center_theme_option['enable-skrill-btn'] == 'enable' ){ ?>	
											<li>
												<div class="checkbox_radio kode-radio-label-wrap">
													<input id="skrill-<?php echo esc_attr($post_id);?>" type="radio" class="radio_item" data-url="<?php echo esc_url(get_permalink($islamic_center_theme_option['stripe_page']));?>" name="payment_method" data-value="save_skrill_form" />
													<span></span>
													<label for="skrill-<?php echo esc_attr($post_id);?>"><?php echo esc_attr__('Skrill','wp-campaign'); ?></label>
												</div>
											</li>
											<?php } ?>
										</ul>
										
										<input type="button" class="user-custom-pay-form medium_btn theme_color_bg btn_hover2 hvr-wobble-bottom" value="<?php esc_attr_e('Donate Now', 'wp-campaign'); ?>" />
										<input type="hidden" name="action" class="action" value="" />
										<input type="hidden" name="security" value="<?php echo wp_create_nonce('kode-paypal-custom-nonce'); ?>" />
										<input type="hidden" name="user_detail" class="user" value="<?php echo esc_attr($author_user->ID)?>" />
										<input type="hidden" name="invoice" class="invoice" value="<?php echo esc_attr($goal);?>" />
										<input type="hidden" name="business" class="business" value="<?php echo esc_attr($islamic_center_theme_option['paypal-recipient-email']);?>" />
										<input type="hidden" name="post_id" class="post_id" value="<?php echo esc_attr($post_id);?>" />
										<div class="kode-notice email-invalid" ><?php echo esc_attr__('Invalid Email Address ', 'wp-campaign'); ?></div>
										<div class="kode-notice require-field" ><?php echo esc_attr__('Please fill all required fields', 'wp-campaign'); ?></div>
										<div class="kode-notice alert-message" ></div>
										<div class="kode-paypal-loader" ></div>
									</div>
								</div>
							</div>
						
						<!--kode AUTHOR WRAP COMMENTS FORM END -->	
					</div>
				</form>
				<!--KODE DONATION ROW END-->
			</div>
<?php	
		$ret = ob_get_contents();
		ob_end_clean();
		
		return $ret;
	}	


	function islamic_center_get_currencies() {
		return array_unique(
			apply_filters( 'islamic_center_currencies',
				array(
					'AED' => __( 'United Arab Emirates dirham', 'wp-campaign' ),
					'AFN' => __( 'Afghan afghani', 'wp-campaign' ),
					'ALL' => __( 'Albanian lek', 'wp-campaign' ),
					'AMD' => __( 'Armenian dram', 'wp-campaign' ),
					'ANG' => __( 'Netherlands Antillean guilder', 'wp-campaign' ),
					'AOA' => __( 'Angolan kwanza', 'wp-campaign' ),
					'ARS' => __( 'Argentine peso', 'wp-campaign' ),
					'AUD' => __( 'Australian dollar', 'wp-campaign' ),
					'AWG' => __( 'Aruban florin', 'wp-campaign' ),
					'AZN' => __( 'Azerbaijani manat', 'wp-campaign' ),
					'BAM' => __( 'Bosnia and Herzegovina convertible mark', 'wp-campaign' ),
					'BBD' => __( 'Barbadian dollar', 'wp-campaign' ),
					'BDT' => __( 'Bangladeshi taka', 'wp-campaign' ),
					'BGN' => __( 'Bulgarian lev', 'wp-campaign' ),
					'BHD' => __( 'Bahraini dinar', 'wp-campaign' ),
					'BIF' => __( 'Burundian franc', 'wp-campaign' ),
					'BMD' => __( 'Bermudian dollar', 'wp-campaign' ),
					'BND' => __( 'Brunei dollar', 'wp-campaign' ),
					'BOB' => __( 'Bolivian boliviano', 'wp-campaign' ),
					'BRL' => __( 'Brazilian real', 'wp-campaign' ),
					'BSD' => __( 'Bahamian dollar', 'wp-campaign' ),
					'BTC' => __( 'Bitcoin', 'wp-campaign' ),
					'BTN' => __( 'Bhutanese ngultrum', 'wp-campaign' ),
					'BWP' => __( 'Botswana pula', 'wp-campaign' ),
					'BYR' => __( 'Belarusian ruble', 'wp-campaign' ),
					'BZD' => __( 'Belize dollar', 'wp-campaign' ),
					'CAD' => __( 'Canadian dollar', 'wp-campaign' ),
					'CDF' => __( 'Congolese franc', 'wp-campaign' ),
					'CHF' => __( 'Swiss franc', 'wp-campaign' ),
					'CLP' => __( 'Chilean peso', 'wp-campaign' ),
					'CNY' => __( 'Chinese yuan', 'wp-campaign' ),
					'COP' => __( 'Colombian peso', 'wp-campaign' ),
					'CRC' => __( 'Costa Rican col&oacute;n', 'wp-campaign' ),
					'CUC' => __( 'Cuban convertible peso', 'wp-campaign' ),
					'CUP' => __( 'Cuban peso', 'wp-campaign' ),
					'CVE' => __( 'Cape Verdean escudo', 'wp-campaign' ),
					'CZK' => __( 'Czech koruna', 'wp-campaign' ),
					'DJF' => __( 'Djiboutian franc', 'wp-campaign' ),
					'DKK' => __( 'Danish krone', 'wp-campaign' ),
					'DOP' => __( 'Dominican peso', 'wp-campaign' ),
					'DZD' => __( 'Algerian dinar', 'wp-campaign' ),
					'EGP' => __( 'Egyptian pound', 'wp-campaign' ),
					'ERN' => __( 'Eritrean nakfa', 'wp-campaign' ),
					'ETB' => __( 'Ethiopian birr', 'wp-campaign' ),
					'EUR' => __( 'Euro', 'wp-campaign' ),
					'FJD' => __( 'Fijian dollar', 'wp-campaign' ),
					'FKP' => __( 'Falkland Islands pound', 'wp-campaign' ),
					'GBP' => __( 'Pound sterling', 'wp-campaign' ),
					'GEL' => __( 'Georgian lari', 'wp-campaign' ),
					'GGP' => __( 'Guernsey pound', 'wp-campaign' ),
					'GHS' => __( 'Ghana cedi', 'wp-campaign' ),
					'GIP' => __( 'Gibraltar pound', 'wp-campaign' ),
					'GMD' => __( 'Gambian dalasi', 'wp-campaign' ),
					'GNF' => __( 'Guinean franc', 'wp-campaign' ),
					'GTQ' => __( 'Guatemalan quetzal', 'wp-campaign' ),
					'GYD' => __( 'Guyanese dollar', 'wp-campaign' ),
					'HKD' => __( 'Hong Kong dollar', 'wp-campaign' ),
					'HNL' => __( 'Honduran lempira', 'wp-campaign' ),
					'HRK' => __( 'Croatian kuna', 'wp-campaign' ),
					'HTG' => __( 'Haitian gourde', 'wp-campaign' ),
					'HUF' => __( 'Hungarian forint', 'wp-campaign' ),
					'IDR' => __( 'Indonesian rupiah', 'wp-campaign' ),
					'ILS' => __( 'Israeli new shekel', 'wp-campaign' ),
					'IMP' => __( 'Manx pound', 'wp-campaign' ),
					'INR' => __( 'Indian rupee', 'wp-campaign' ),
					'IQD' => __( 'Iraqi dinar', 'wp-campaign' ),
					'IRR' => __( 'Iranian rial', 'wp-campaign' ),
					'ISK' => __( 'Icelandic kr&oacute;na', 'wp-campaign' ),
					'JEP' => __( 'Jersey pound', 'wp-campaign' ),
					'JMD' => __( 'Jamaican dollar', 'wp-campaign' ),
					'JOD' => __( 'Jordanian dinar', 'wp-campaign' ),
					'JPY' => __( 'Japanese yen', 'wp-campaign' ),
					'KES' => __( 'Kenyan shilling', 'wp-campaign' ),
					'KGS' => __( 'Kyrgyzstani som', 'wp-campaign' ),
					'KHR' => __( 'Cambodian riel', 'wp-campaign' ),
					'KMF' => __( 'Comorian franc', 'wp-campaign' ),
					'KPW' => __( 'North Korean won', 'wp-campaign' ),
					'KRW' => __( 'South Korean won', 'wp-campaign' ),
					'KWD' => __( 'Kuwaiti dinar', 'wp-campaign' ),
					'KYD' => __( 'Cayman Islands dollar', 'wp-campaign' ),
					'KZT' => __( 'Kazakhstani tenge', 'wp-campaign' ),
					'LAK' => __( 'Lao kip', 'wp-campaign' ),
					'LBP' => __( 'Lebanese pound', 'wp-campaign' ),
					'LKR' => __( 'Sri Lankan rupee', 'wp-campaign' ),
					'LRD' => __( 'Liberian dollar', 'wp-campaign' ),
					'LSL' => __( 'Lesotho loti', 'wp-campaign' ),
					'LYD' => __( 'Libyan dinar', 'wp-campaign' ),
					'MAD' => __( 'Moroccan dirham', 'wp-campaign' ),
					'MDL' => __( 'Moldovan leu', 'wp-campaign' ),
					'MGA' => __( 'Malagasy ariary', 'wp-campaign' ),
					'MKD' => __( 'Macedonian denar', 'wp-campaign' ),
					'MMK' => __( 'Burmese kyat', 'wp-campaign' ),
					'MNT' => __( 'Mongolian t&ouml;gr&ouml;g', 'wp-campaign' ),
					'MOP' => __( 'Macanese pataca', 'wp-campaign' ),
					'MRO' => __( 'Mauritanian ouguiya', 'wp-campaign' ),
					'MUR' => __( 'Mauritian rupee', 'wp-campaign' ),
					'MVR' => __( 'Maldivian rufiyaa', 'wp-campaign' ),
					'MWK' => __( 'Malawian kwacha', 'wp-campaign' ),
					'MXN' => __( 'Mexican peso', 'wp-campaign' ),
					'MYR' => __( 'Malaysian ringgit', 'wp-campaign' ),
					'MZN' => __( 'Mozambican metical', 'wp-campaign' ),
					'NAD' => __( 'Namibian dollar', 'wp-campaign' ),
					'NGN' => __( 'Nigerian naira', 'wp-campaign' ),
					'NIO' => __( 'Nicaraguan c&oacute;rdoba', 'wp-campaign' ),
					'NOK' => __( 'Norwegian krone', 'wp-campaign' ),
					'NPR' => __( 'Nepalese rupee', 'wp-campaign' ),
					'NZD' => __( 'New Zealand dollar', 'wp-campaign' ),
					'OMR' => __( 'Omani rial', 'wp-campaign' ),
					'PAB' => __( 'Panamanian balboa', 'wp-campaign' ),
					'PEN' => __( 'Peruvian nuevo sol', 'wp-campaign' ),
					'PGK' => __( 'Papua New Guinean kina', 'wp-campaign' ),
					'PHP' => __( 'Philippine peso', 'wp-campaign' ),
					'PKR' => __( 'Pakistani rupee', 'wp-campaign' ),
					'PLN' => __( 'Polish z&#x142;oty', 'wp-campaign' ),
					'PRB' => __( 'Transnistrian ruble', 'wp-campaign' ),
					'PYG' => __( 'Paraguayan guaran&iacute;', 'wp-campaign' ),
					'QAR' => __( 'Qatari riyal', 'wp-campaign' ),
					'RON' => __( 'Romanian leu', 'wp-campaign' ),
					'RSD' => __( 'Serbian dinar', 'wp-campaign' ),
					'RUB' => __( 'Russian ruble', 'wp-campaign' ),
					'RWF' => __( 'Rwandan franc', 'wp-campaign' ),
					'SAR' => __( 'Saudi riyal', 'wp-campaign' ),
					'SBD' => __( 'Solomon Islands dollar', 'wp-campaign' ),
					'SCR' => __( 'Seychellois rupee', 'wp-campaign' ),
					'SDG' => __( 'Sudanese pound', 'wp-campaign' ),
					'SEK' => __( 'Swedish krona', 'wp-campaign' ),
					'SGD' => __( 'Singapore dollar', 'wp-campaign' ),
					'SHP' => __( 'Saint Helena pound', 'wp-campaign' ),
					'SLL' => __( 'Sierra Leonean leone', 'wp-campaign' ),
					'SOS' => __( 'Somali shilling', 'wp-campaign' ),
					'SRD' => __( 'Surinamese dollar', 'wp-campaign' ),
					'SSP' => __( 'South Sudanese pound', 'wp-campaign' ),
					'STD' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra', 'wp-campaign' ),
					'SYP' => __( 'Syrian pound', 'wp-campaign' ),
					'SZL' => __( 'Swazi lilangeni', 'wp-campaign' ),
					'THB' => __( 'Thai baht', 'wp-campaign' ),
					'TJS' => __( 'Tajikistani somoni', 'wp-campaign' ),
					'TMT' => __( 'Turkmenistan manat', 'wp-campaign' ),
					'TND' => __( 'Tunisian dinar', 'wp-campaign' ),
					'TOP' => __( 'Tongan pa&#x2bb;anga', 'wp-campaign' ),
					'TRY' => __( 'Turkish lira', 'wp-campaign' ),
					'TTD' => __( 'Trinidad and Tobago dollar', 'wp-campaign' ),
					'TWD' => __( 'New Taiwan dollar', 'wp-campaign' ),
					'TZS' => __( 'Tanzanian shilling', 'wp-campaign' ),
					'UAH' => __( 'Ukrainian hryvnia', 'wp-campaign' ),
					'UGX' => __( 'Ugandan shilling', 'wp-campaign' ),
					'USD' => __( 'United States dollar', 'wp-campaign' ),
					'UYU' => __( 'Uruguayan peso', 'wp-campaign' ),
					'UZS' => __( 'Uzbekistani som', 'wp-campaign' ),
					'VEF' => __( 'Venezuelan bol&iacute;var', 'wp-campaign' ),
					'VND' => __( 'Vietnamese &#x111;&#x1ed3;ng', 'wp-campaign' ),
					'VUV' => __( 'Vanuatu vatu', 'wp-campaign' ),
					'WST' => __( 'Samoan t&#x101;l&#x101;', 'wp-campaign' ),
					'XAF' => __( 'Central African CFA franc', 'wp-campaign' ),
					'XCD' => __( 'East Caribbean dollar', 'wp-campaign' ),
					'XOF' => __( 'West African CFA franc', 'wp-campaign' ),
					'XPF' => __( 'CFP franc', 'wp-campaign' ),
					'YER' => __( 'Yemeni rial', 'wp-campaign' ),
					'ZAR' => __( 'South African rand', 'wp-campaign' ),
					'ZMW' => __( 'Zambian kwacha', 'wp-campaign' ),
				)
			)
		);
	}

	function islamic_center_currency_symbol( $currency = '' ) {
		if ( ! $currency ) {
			$islamic_center_theme_option = get_option('islamic_center_admin_option', array());
			$currency =  empty($islamic_center_theme_option['islamic-center-currency']) ? '' : $islamic_center_theme_option['islamic-center-currency'];
		}

		$symbols = apply_filters( 'islamic_center_currency_symbols', array(
			'AED' => '&#x62f;.&#x625;',
			'AFN' => '&#x60b;',
			'ALL' => 'L',
			'AMD' => 'AMD',
			'ANG' => '&fnof;',
			'AOA' => 'Kz',
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&fnof;',
			'AZN' => 'AZN',
			'BAM' => 'KM',
			'BBD' => '&#36;',
			'BDT' => '&#2547;&nbsp;',
			'BGN' => '&#1083;&#1074;.',
			'BHD' => '.&#x62f;.&#x628;',
			'BIF' => 'Fr',
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => 'Bs.',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTC' => '&#3647;',
			'BTN' => 'Nu.',
			'BWP' => 'P',
			'BYR' => 'Br',
			'BZD' => '&#36;',
			'CAD' => '&#36;',
			'CDF' => 'Fr',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&yen;',
			'COP' => '&#36;',
			'CRC' => '&#x20a1;',
			'CUC' => '&#36;',
			'CUP' => '&#36;',
			'CVE' => '&#36;',
			'CZK' => '&#75;&#269;',
			'DJF' => 'Fr',
			'DKK' => 'DKK',
			'DOP' => 'RD&#36;',
			'DZD' => '&#x62f;.&#x62c;',
			'EGP' => 'EGP',
			'ERN' => 'Nfk',
			'ETB' => 'Br',
			'EUR' => '&euro;',
			'FJD' => '&#36;',
			'FKP' => '&pound;',
			'GBP' => '&pound;',
			'GEL' => '&#x10da;',
			'GGP' => '&pound;',
			'GHS' => '&#x20b5;',
			'GIP' => '&pound;',
			'GMD' => 'D',
			'GNF' => 'Fr',
			'GTQ' => 'Q',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => 'L',
			'HRK' => 'Kn',
			'HTG' => 'G',
			'HUF' => '&#70;&#116;',
			'IDR' => 'Rp',
			'ILS' => '&#8362;',
			'IMP' => '&pound;',
			'INR' => '&#8377;',
			'IQD' => '&#x639;.&#x62f;',
			'IRR' => '&#xfdfc;',
			'ISK' => 'kr.',
			'JEP' => '&pound;',
			'JMD' => '&#36;',
			'JOD' => '&#x62f;.&#x627;',
			'JPY' => '&yen;',
			'KES' => 'KSh',
			'KGS' => '&#x441;&#x43e;&#x43c;',
			'KHR' => '&#x17db;',
			'KMF' => 'Fr',
			'KPW' => '&#x20a9;',
			'KRW' => '&#8361;',
			'KWD' => '&#x62f;.&#x643;',
			'KYD' => '&#36;',
			'KZT' => 'KZT',
			'LAK' => '&#8365;',
			'LBP' => '&#x644;.&#x644;',
			'LKR' => '&#xdbb;&#xdd4;',
			'LRD' => '&#36;',
			'LSL' => 'L',
			'LYD' => '&#x644;.&#x62f;',
			'MAD' => '&#x62f;. &#x645;.',
			'MAD' => '&#x62f;.&#x645;.',
			'MDL' => 'L',
			'MGA' => 'Ar',
			'MKD' => '&#x434;&#x435;&#x43d;',
			'MMK' => 'Ks',
			'MNT' => '&#x20ae;',
			'MOP' => 'P',
			'MRO' => 'UM',
			'MUR' => '&#x20a8;',
			'MVR' => '.&#x783;',
			'MWK' => 'MK',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => 'MT',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => 'C&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#x631;.&#x639;.',
			'PAB' => 'B/.',
			'PEN' => 'S/.',
			'PGK' => 'K',
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PRB' => '&#x440;.',
			'PYG' => '&#8370;',
			'QAR' => '&#x631;.&#x642;',
			'RMB' => '&yen;',
			'RON' => 'lei',
			'RSD' => '&#x434;&#x438;&#x43d;.',
			'RUB' => '&#8381;',
			'RWF' => 'Fr',
			'SAR' => '&#x631;.&#x633;',
			'SBD' => '&#36;',
			'SCR' => '&#x20a8;',
			'SDG' => '&#x62c;.&#x633;.',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&pound;',
			'SLL' => 'Le',
			'SOS' => 'Sh',
			'SRD' => '&#36;',
			'SSP' => '&pound;',
			'STD' => 'Db',
			'SYP' => '&#x644;.&#x633;',
			'SZL' => 'L',
			'THB' => '&#3647;',
			'TJS' => '&#x405;&#x41c;',
			'TMT' => 'm',
			'TND' => '&#x62f;.&#x62a;',
			'TOP' => 'T&#36;',
			'TRY' => '&#8378;',
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => 'Sh',
			'UAH' => '&#8372;',
			'UGX' => 'UGX',
			'USD' => '&#36;',
			'UYU' => '&#36;',
			'UZS' => 'UZS',
			'VEF' => 'Bs F',
			'VND' => '&#8363;',
			'VUV' => 'Vt',
			'WST' => 'T',
			'XAF' => 'Fr',
			'XCD' => '&#36;',
			'XOF' => 'Fr',
			'XPF' => 'Fr',
			'YER' => '&#xfdfc;',
			'ZAR' => '&#82;',
			'ZMW' => 'ZK',
		) );

		$currency_symbol = isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';

		return apply_filters( 'islamic_center_currency_symbol', $currency_symbol, $currency );
	}
	
	
	function islamic_center_get_islamic_center_price_format() {
		$islamic_center_theme_option = get_option('islamic_center_admin_option',array());
		$currency_pos =  empty($islamic_center_theme_option['islamic-center-currency-pos'])? 'left':$islamic_center_theme_option['islamic-center-currency-pos'];
		$format = '%1$s%2$s';

		switch ( $currency_pos ) {
			case 'left' :
				$format = '%1$s%2$s';
			break;
			case 'right' :
				$format = '%2$s%1$s';
			break;
			case 'left_space' :
				$format = '%1$s&nbsp;%2$s';
			break;
			case 'right_space' :
				$format = '%2$s&nbsp;%1$s';
			break;
		}

		return apply_filters( 'islamic_price_format', $format, $currency_pos );
	}

	
	function islamic_center_get_price_thousand_separator() {
		$islamic_center_theme_option = get_option('islamic_center_admin_option',array());
		$currency_pos = empty($islamic_center_theme_option['islamic-center-separator']) ? '' : $islamic_center_theme_option['islamic-center-separator'];
		$separator = stripslashes( $currency_pos );
		return $separator;
	}

	
	function islamic_center_get_price_decimal_separator() {
		$islamic_center_theme_option = get_option('islamic_center_admin_option',array());
		$currency_pos =empty($islamic_center_theme_option['islamic-center-decimal'])? '' : $islamic_center_theme_option['islamic-center-decimal'];
		$separator = stripslashes( $currency_pos );
		return $separator ? $separator : '.';
	}

	
	function islamic_center_get_price_decimals() {
		$islamic_center_theme_option = get_option('islamic_center_admin_option',array());
		$currency_pos = empty($islamic_center_theme_option['islamic-center-nof-decimal']) ? '' : $islamic_center_theme_option['islamic-center-nof-decimal'];
		return absint( $currency_pos );
	}

	
	function islamic_center_price( $price, $args = array() ) {
		
		extract( apply_filters( 'islamic_center_price_args', wp_parse_args( $args, array(
			'ex_tax_label'       => false,
			'currency'           => '',
			'decimal_separator'  => $this->islamic_center_get_price_decimal_separator(),
			'thousand_separator' => $this->islamic_center_get_price_thousand_separator(),
			'decimals'           => $this->islamic_center_get_price_decimals(),
			'price_format'       => $this->islamic_center_get_islamic_center_price_format()
		) ) ) );
		
		$negative        = $price < 0;
		$price           = apply_filters( 'raw_islamic_center_price', floatval( $negative ? $price * -1 : $price ) );
		$price           = apply_filters( 'formatted_islamic_center_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );

		if ( apply_filters( 'islamic_center_price_trim_zeros', false ) && $decimals > 0 ) {
			$price = $this->islamic_center_trim_zeros( $price );
		}

		$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, '' . $this->islamic_center_currency_symbol( $currency ) . '', $price );
		$return          = '' . $formatted_price . '';

		return apply_filters( 'islamic_center_price', $return, $price, $args );
	}
	
	function islamic_center_trim_zeros( $price ) {
		return preg_replace( '/' . preg_quote( $this->islamic_center_get_price_decimal_separator(), '/' ) . '0++$/', '', $price );
	}
	

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}

	
	
}
