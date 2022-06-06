<?php namespace PUREHEARTSPLUGIN\Element;

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
class Latest_News_V2 extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'purehearts_latest_news_v2';
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
        return esc_html__( 'Latest News V2', 'purehearts' );
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
            'latest_news_v2',
            [
                'label' => esc_html__( 'General', 'purehearts' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
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
				'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your Sub Title', 'purehearts' ),
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
                'placeholder' => __( 'Enter your title', 'purehearts' ),
            ]
        );
        $this->end_controls_section();
		
		//Blog List Image
		$this->start_controls_section(
            'list_view',
            [
                'label' => esc_html__( 'Post List View', 'purehearts' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
        $this->add_control(
            'query_number',
            [
                'label'   => esc_html__( 'Number of post', 'purehearts' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_orderby',
            [
                'label'   => esc_html__( 'Order By', 'purehearts' ),
				'label_block' => true,
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date'       => esc_html__( 'Date', 'purehearts' ),
                    'title'      => esc_html__( 'Title', 'purehearts' ),
                    'menu_order' => esc_html__( 'Menu Order', 'purehearts' ),
                    'rand'       => esc_html__( 'Random', 'purehearts' ),
                ),
            ]
        );
        $this->add_control(
            'query_order',
            [
                'label'   => esc_html__( 'Order', 'purehearts' ),
				'label_block' => true,
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__( 'DESC', 'purehearts' ),
                    'ASC'  => esc_html__( 'ASC', 'purehearts' ),
                ),
            ]
        );
        $this->add_control(
            'query_category',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'purehearts'),
				'label_block' => true,
                'options' => get_blog_categories()
            ]
        );
        $this->end_controls_section();
		
		//Blog Grid Image
		$this->start_controls_section(
            'grid_view',
            [
                'label' => esc_html__( 'Post Grid View', 'purehearts' ),
				'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );
		$this->add_control(
			'text_limit',
			[
				'label'   => esc_html__( 'Text Limit', 'purehearts' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
        $this->add_control(
            'query_numbers',
            [
                'label'   => esc_html__( 'Number of post', 'purehearts' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 100,
                'step'    => 1,
            ]
        );
        $this->add_control(
            'query_orderbys',
            [
                'label'   => esc_html__( 'Order By', 'purehearts' ),
				'label_block' => true,
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'date'       => esc_html__( 'Date', 'purehearts' ),
                    'title'      => esc_html__( 'Title', 'purehearts' ),
                    'menu_order' => esc_html__( 'Menu Order', 'purehearts' ),
                    'rand'       => esc_html__( 'Random', 'purehearts' ),
                ),
            ]
        );
        $this->add_control(
            'query_orders',
            [
                'label'   => esc_html__( 'Order', 'purehearts' ),
				'label_block' => true,
                'type'    => Controls_Manager::SELECT,
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__( 'DESC', 'purehearts' ),
                    'ASC'  => esc_html__( 'ASC', 'purehearts' ),
                ),
            ]
        );
        $this->add_control(
            'query_categorys',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'purehearts'),
				'label_block' => true,
                'options' => get_blog_categories()
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
        $allowed_tags = wp_kses_allowed_html('post');

        $paged = get_query_var('paged');
		$paged = purehearts_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;

        $this->add_render_attribute( 'wrapper', 'class', 'templatepath-purehearts' );
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => purehearts_set( $settings, 'query_number' ),
            'orderby'        => purehearts_set( $settings, 'query_orderby' ),
            'order'          => purehearts_set( $settings, 'query_order' ),
            'paged'         => $paged
        );

        if( purehearts_set( $settings, 'query_category' ) ) $args['category_name'] = purehearts_set( $settings, 'query_category' );
        $query = new \WP_Query( $args );
		
		//Second Query
		$args2 = array(
            'post_type'      => 'post',
            'posts_per_page' => purehearts_set( $settings, 'query_numbers' ),
            'orderby'        => purehearts_set( $settings, 'query_orderbys' ),
            'order'          => purehearts_set( $settings, 'query_orders' ),
            'paged'         => $paged
        );

        if( purehearts_set( $settings, 'query_categorys' ) ) $args2['category_name'] = purehearts_set( $settings, 'query_categorys' );
        $query2 = new \WP_Query( $args2 );
		
        if ( $query->have_posts() ) { ?>

        <!-- news-style-two -->
        <section class="news-style-two" <?php if($settings['bg_img']['id']){ ?>style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['bg_img']['id'])); ?>);"><?php } ?>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 title-column">
                        <div class="title-block">
                            <?php if($settings['subtitle'] || $settings['title']){ ?>
                            <div class="sec-title style-two">
                                <?php if($settings['subtitle']){ ?><span class="top-text"><?php echo wp_kses($settings['subtitle'], true);?></span><?php } ?>
                    			<?php if($settings['title']){ ?><h2><?php echo wp_kses($settings['title'], true);?></h2><?php } ?>
                            </div>
                            <?php } ?>
                            <div class="blog-post">
                                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                <div class="post">
                                    <figure class="post-thumb"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('purehearts_74x74'); ?></a></figure>
                                    <h5><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"> <?php the_title(); ?></a></h5>
                                    <span class="post-date"><?php echo esc_attr(get_the_date()); ?></span>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                    <?php while ( $query2->have_posts() ) : $query2->the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('purehearts_370x500'); ?></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date"><?php echo esc_attr(get_the_date()); ?></span>
                                        <div class="category"><?php the_category(' , '); ?></div>
                                        <h3><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a></h3>
                                        <p><?php echo wp_kses(wp_trim_words(get_the_content(), $settings['text_limit']), true); ?></p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php esc_html_e('Read More', 'purehearts'); ?></a></div>
                                        <div class="comment-box pull-right"><a href="<?php echo esc_url(get_permalink(get_the_id()).'#comments'); ?>"><i class="fa fa-comments"></i><?php comments_number( wp_kses(__('0 Comments' , 'purehearts'), true), wp_kses(__('1 Comment' , 'purehearts'), true), wp_kses(__('% Comments' , 'purehearts'), true)); ?></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <!-- news-style-two end -->
        
        <?php }

        wp_reset_postdata();
    }
}
