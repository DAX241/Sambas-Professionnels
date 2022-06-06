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
class Our_Participate extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'purehearts_our_participate';
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
		return esc_html__( 'Our Participate', 'purehearts' );
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
			'our_participate',
			[
				'label' => esc_html__( 'Our Participate', 'purehearts' ),
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
				'default'     => __( 'Welcome to Pure Hearts', 'purehearts' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'purehearts' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Title', 'purehearts' ),
			]
		);
		$this->add_control(
			'text',
			[
				'label'       => __( 'Text', 'purehearts' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Text', 'purehearts' ),
			]
		);
		$this->add_control(
              'member', 
			  	[
            		'type' => Controls_Manager::REPEATER,
            		'separator' => 'before',
            		'default' => 
						[
                			['block_title' => esc_html__('Partner', 'purehearts')],
                			['block_title' => esc_html__('Member', 'purehearts')],
							['block_title' => esc_html__('Mission', 'purehearts')],
							['block_title' => esc_html__('Vision', 'purehearts')]
            			],
            		'fields' => 
						[
                			[
                    			'name' => 'feature_img',
                    			'label' => __( 'Feature Image', 'purehearts' ),
								'type' => Controls_Manager::MEDIA,
								'default' => ['url' => Utils::get_placeholder_image_src(),],
                			],
							[
                    			'name' => 'pattern',
                    			'label' => __( 'Enable/Disable Pattern Image', 'purehearts' ),
								'type'     => Controls_Manager::SWITCHER,
								'dynamic'     => [
									'active' => true,
								],
								'placeholder' => __( 'Enable/Disable Pattern Image', 'purehearts' ),
                			],
							[
                    			'name' => 'block_subtitle',
                    			'label' => esc_html__('Sub Title', 'purehearts'),
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
                    			'label' => esc_html__('Button', 'purehearts'),
								'label_block' => true,
								'type' => Controls_Manager::TEXT,
                    			'default' => esc_html__('Read More', 'purehearts')
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
        
        <!-- welcome-section -->
        <section class="welcome-section sec-pad">
            <div class="auto-container">
                <?php if($settings['subtitle'] || $settings['title'] || $settings['text']){ ?>
                <div class="sec-title style-two centred">
                    <?php if($settings['subtitle']){ ?><span class="top-text"><?php echo wp_kses($settings['subtitle'], true);?></span><?php } ?>
                    <?php if($settings['title']){ ?><h2><?php echo wp_kses($settings['title'], true);?></h2><?php } ?>
                    <?php if($settings['text']){ ?><p><?php echo wp_kses($settings['text'], true);?></p><?php } ?>
                </div>
                <?php } ?>
                <div class="row clearfix">
                    <?php foreach($settings['member'] as $key => $item): ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 welcome-block">
                        <div class="welcome-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><img src="<?php echo esc_url(wp_get_attachment_url($item['feature_img']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'purehearts'); ?>"></figure>
                                <div class="content-box">
                                    <?php if($item['pattern']){ ?><div class="shape" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-32.png);"></div><?php } ?>
                                    <div class="text">
                                        <span><?php echo wp_kses($item['block_subtitle'], true); ?></span>
                                        <h2><?php echo wp_kses($item['block_title'], true); ?></h2>
                                    </div>
                                </div>
                                <?php if($item['btn_link']['url'] || $item['btn_title']){ ?>
                                <div class="btn-box">
                                    <a href="<?php echo esc_url($item['btn_link']['url']); ?>" class="links"><i class="icon-right-arrow"></i></a>
                                    <a href="<?php echo esc_url($item['btn_link']['url']); ?>" class="links-btn"><i class="icon-right-arrow"></i><?php echo wp_kses($item['btn_title'], true); ?></a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- welcome-section end -->
        
		<?php 
	}

}
