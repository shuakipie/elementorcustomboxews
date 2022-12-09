<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Theratio Image Category
 */
class Theratio_Image_Box_2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iimagebox';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Image Box 2', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-image-rollover';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image Box', 'theratio' ),
			]
		);

		$this->add_control(
	       'icon_image',
	        [
	            'label' => esc_html__( 'Photo', 'theratio' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
			  	],
		    ]
	    );
	    $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'icon_image_size', 
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);
	   
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Office Spaces', 'theratio' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'We will help you to get the result you dreamed of.', 'theratio' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'theratio' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theratio' ),
				'default'	=> [
					'url'	=> '#'
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Button Text', 'theratio' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',				
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'style_image_content',
			[
				'label' => __( 'Style', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_image',
			[
				'label' => __( 'Image', 'theratio' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'image_space',
			[
				'label' => __( 'Spacing Image', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-imagebox .octf-imagebox_image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing Title', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-imagebox .octf-imagebox_content h2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .octf-imagebox .octf-imagebox_content h2',
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-imagebox .octf-imagebox_content h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		//Description
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'desc_space',
			[
				'label' => __( 'Spacing Description', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .octf-imagebox .octf-imagebox_content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .octf-imagebox .octf-imagebox_content p',
			]
		);

		//Button
		$this->add_control(
			'heading_btn',
			[
				'label' => __( 'Button Text', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .octf-imagebox .octf-imagebox_btn',
			]
		);
		$this->add_control(
			'btn_color_hover',
			[
				'label' => __( 'Title Color Hover', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .octf-imagebox .octf-imagebox_btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}
		$link_attributes = $this->get_render_attribute_string( 'link' );
		?>
		<div class="octf-imagebox">
			<div class="octf-imagebox_image">
				<?php if( $settings['icon_image']['url'] ) { echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'icon_image_size', 'icon_image' ); } ?>
				<?php if( ! empty( $settings['link']['url'] ) ){ ?><a class="octf-imagebox_overlay" <?php echo $link_attributes; ?>><?php } ?>
				<i class="ot-flaticon-searching"></i>
				<?php if( ! empty( $settings['link']['url'] ) ){ ?></a><?php } ?>
			</div>
	        <div class="octf-imagebox_content">		        
		        <h2>
		        	<?php if( ! empty( $settings['link']['url'] ) ){ ?><a <?php echo $link_attributes; ?>><?php } ?><?php echo $settings['title']; ?><?php if( ! empty( $settings['link']['url'] ) ){ ?></a><?php } ?>
		        </h2>		        
		        <p><?php echo $settings['desc']; ?></p>
		        <?php if ( $settings['btn_text'] != '' ){ ?>
		        <a class="octf-imagebox_btn" <?php echo $link_attributes; ?>><?php echo $settings['btn_text']; ?></a>
		        <?php } ?>
			</div>
	    </div>
	    <?php
	}

}
// After the Theratio_Image_Box_2 class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Theratio_Image_Box_2() );