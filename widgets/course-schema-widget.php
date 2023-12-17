<?php
class Elementor_Course_Schema_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'course-schema-widget';
	}

	public function get_title() {
		return esc_html__( 'Course Schema Widget', 'elementor-course-schema' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'schema', 'course' ];
	}

    protected function register_controls() {
		// Content Tab Start

		$this->start_controls_section(
			'Course Schema Settings',
			[
				'label' => esc_html__( 'Title', 'elementor-course-schema' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Course Title', 'elementor-course-schema' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => get_the_title(),
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'elementor-course-schema' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => "0",
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'excerpt',
			[
				'label' => esc_html__( 'Excerpt', 'elementor-course-schema' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'A short description of the course.',
				'dynamic' => [
					'active' => true
				]
			]
		);

        $this->add_control(
			'workload',
			[
				'label' => esc_html__( 'Workload', 'elementor-course-schema' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'P100H',
				'dynamic' => [
					'active' => true
				]
			]
		);

		$this->add_control(
			'orgName',
			[
				'label' => esc_html__( 'Organisation Name', 'elementor-course-schema' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Company Name'
			]
		);

		$this->add_control(
			'orgURL',
			[
				'label' => esc_html__( 'Organisation URL', 'elementor-course-schema' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'https://example.com'
			]
			);



		$this->end_controls_section();
		// Content Tab End
	}


	protected function render() {
        $settings = $this->get_settings_for_display();
		?>

		<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Course",
			"name": "<?php echo $settings['title'] ?>",
			"description": "<?php echo $settings['excerpt'] ?>",
			"provider": {
				"@type": "Organization",
				"name": "<?php echo $settings['orgName'] ?>",
				"sameAs": "<?php echo $settings['orgURL'] ?>"
			},
			"hasCourseInstance": {
				"@type": "CourseInstance",
				"courseMode": "online",
				"courseWorkload": "<?php echo $settings['workload'] ?>"
			},
			"offers": [{
				"@type": "Offer",
				"category": "Full Payment",
				"price": "<?php echo wp_strip_all_tags( $settings['price'] ) ?>"
			}]
		}
		</script>
        <?php
    }
}
