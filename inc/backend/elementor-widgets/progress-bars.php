<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Progress Bars 
 */
class Theratio_Progress_Bars extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iprogress';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Theratio Progress Bars', 'theratio' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_theratio' ];
	}

	protected function register_controls() {

		//Content Progress Bars
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'theratio' ),
			]
		);

		$this->add_control(
			'bar_style',
			[
				'label' 	=> __( 'Bar Style', 'theratio' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 'line',
				'options' 	=> [
					'line'    => __( 'Style 1: Line', 'theratio' ),
					'circle'  => __( 'Style 2: Circle', 'theratio' ),
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Keyword Research', 'theratio' ),
			]
		);
		$this->add_control(
			'percent',
			[
				'label' => 'Percentage',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'percent_text',
			[
				'label'   => esc_html__( 'Show Percentage', 'theratio' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'right_text',
			[
				'label'   => esc_html__( 'Title On Right', 'theratio' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'theratio' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'theratio' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theratio' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'theratio' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'right_text!' => 'yes',
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'bar_style_section',
			[
				'label' => __( 'Progress Bar', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bar_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#939393',
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_responsive_control(
			'bar_height',
			[
				'label' => __( 'Height', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_responsive_control(
			'bar_size',
			[
				'label' => __( 'Circle Width', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'size' => 165,
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Line Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .inner-bar:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .progress-bar' => 'background: {{VALUE}};',
					'{{WRAPPER}} .progress-bar:after' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'line_height_line',
			[
				'label' => __( 'Line Height', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iprogress' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .progress-bar:after' => 'width: {{SIZE}}{{UNIT}}; height: calc({{SIZE}}{{UNIT}}*5);',
				],
				'condition' => [
					'bar_style' => 'line',
				]
			]
		);

		$this->add_responsive_control(
			'line_height_circle',
			[
				'label' => __( 'Line Height', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .inner-bar:after' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_text_section',
			[
				'label' => __( 'Text', 'theratio' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'theratio' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'theratio' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pname' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .flex-middle h4' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tbottom h4' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress .pname, {{WRAPPER}} .circle-progress h4' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-progress .pname, {{WRAPPER}} .circle-progress h4',
			]
		);

		//Percentage
		$this->add_control(
			'heading_percent',
			[
				'label' => __( 'Percentage', 'theratio' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'per_color',
			[
				'label' => __( 'Color', 'theratio' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ppercent, {{WRAPPER}} .circle-progress span' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'per_typography',
				'selector' => '{{WRAPPER}} .ppercent, {{WRAPPER}} .circle-progress span',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php if( $settings['bar_style'] == 'line' ) { ?>
		<div class="ot-progress" data-percent="<?php echo esc_attr( $settings['percent']['size'] ); ?>">
			<div class="overflow">
	        	<?php if( $settings['title'] ) echo '<span class="pname f-left">' . $settings['title'] . '</span>'; ?>
	        </div>
	        <div class="iprogress">
				<div class="progress-bar">
					<?php if( $settings['percent_text'] ) echo '<span class="ppercent"></span>'; ?>
				</div>
			</div>
	    </div>
		<?php }else{ ?>
		<div class="circle-progress <?php if( $settings['right_text'] ) echo 'flex-middle'; else echo 'tbottom'; ?>" data-color="<?php echo esc_attr( $settings['bar_color'] ); ?>" data-height="<?php echo esc_attr( $settings['bar_height']['size'] ); ?>" data-size="<?php echo esc_attr( $settings['bar_size']['size'] ); ?>">
			<div class="inner-bar" data-percent="<?php echo esc_attr( $settings['percent']['size'] ); ?>">
				<span>
					<?php if( $settings['percent_text'] ) echo '<span class="percent">' . $settings['percent']['size'] . '</span>'; ?>
				</span>
			</div>
			<?php if( $settings['title'] ) echo '<h4>' . $settings['title'] . '</h4>'; ?>
		</div>
		
	    <?php }
	}

}
// After the Theratio_Progress_Bars class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Theratio_Progress_Bars() );