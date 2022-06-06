<?php

namespace PUREHEARTSPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Our_Contribution extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'purehearts_our_contribution';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Our Contribution', 'purehearts' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-briefcase';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'purehearts' ];
	}
	
	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'our_contribution',
			[
				'label' => esc_html__( 'Our Contribution', 'purehearts' ),
			]
		);
		$this->add_control(
			'bg_img',
			[
				'label' => __( 'BG Image', 'purehearts' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label'       => __( 'Sub Title', 'purehearts' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Sub Title', 'purehearts' ),
				'default'     => __( 'Our Contribution', 'purehearts' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'purehearts' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Title', 'purehearts' ),
			]
		);
		$this->add_control(
              'features', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
            		'default' => 
						[
                			['block_title' => esc_html__('United States', 'purehearts')],
                			['block_title' => esc_html__('United Kingdom', 'purehearts')],
							['block_title' => esc_html__('Australia', 'purehearts')],
							['block_title' => esc_html__('India', 'purehearts')]
            			],
            		'fields' => 
						[
                			[
                    			'name' => 'icons',
                    			'label' => esc_html__('Enter The icons', 'purehearts'),
								'label_block' => true,
								'type' => Controls_Manager::SELECT2,
								'options'  => get_fontawesome_icons(),
                			],
							[
                    			'name' => 'circle_value',
                    			'label' => esc_html__('Contribution Value', 'purehearts'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                    			'default' => esc_html__('', 'purehearts')
                			],
							[
                    			'name' => 'block_title',
                    			'label' => esc_html__('Title', 'purehearts'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                    			'default' => esc_html__('', 'purehearts')
                			],
							[
                    			'name' => 'btn_title',
                    			'label' => esc_html__('Button Title', 'purehearts'),
								'label_block' => true,
                    			'type' => Controls_Manager::TEXT,
                    			'default' => esc_html__('', 'purehearts')
                			],
							[
                    			'name' => 'btn_link',
								'label' => __( 'External Url', 'purehearts' ),
							    'type' => Controls_Manager::URL,
							    'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
							    'show_external' => true,
							    'default' => ['url' => '','is_external' => true,'nofollow' => true,],
                			],
						],
            	    'title_field' => '{{block_title}}',
                 ]
        );
		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        
        <!-- contribution-section -->
        <section class="contribution-section centred">
            <div class="auto-container">
                <div class="inner-container">
                    <?php if($settings['bg_img']['id']){ ?>
                    <div class="pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['bg_img']['id'])); ?>);"></div>
                    <?php } ?>
                    <?php if($settings['subtitle'] || $settings['title']){ ?>
                    <div class="sec-title light centred">
                        <?php if($settings['subtitle']){ ?><span class="top-text"><?php echo wp_kses($settings['subtitle'], true);?></span><?php } ?>
                    	<?php if($settings['title']){ ?><h2><?php echo wp_kses($settings['title'], true);?></h2><?php } ?>
                    </div>
                    <?php } ?>
                    <div class="four-item-carousel owl-carousel owl-theme owl-nav-none">
                        <?php foreach($settings['features'] as $key => $item): ?>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5><?php echo wp_kses($item['circle_value'], true); ?></h5>
                                    <i class="<?php echo wp_kses(str_replace( "icon ",  "",  $item['icons']), true); ?>"></i>
                                </div>
                                <h3><?php echo wp_kses($item['block_title'], true); ?></h3>
                                <?php if($item['btn_link']['url'] || $item['btn_title']) { ?>
                                <a href="<?php echo esc_url($item['btn_link']['url']); ?>"><i class="fa fa-angle-right"></i><?php echo wp_kses($item['btn_title'], true); ?></a>
                            	<?php } ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- contribution-section end -->
                        
		<?php 
	}

}
