<?php

/**
 * Elementor Hello Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Hello_Widget extends \Elementor\Widget_Base
{

  /**
   * Get widget name.
   *
   * Retrieve oEmbed widget name.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget name.
   */
  public function get_name()
  {
    return 'helloworld';
  }

  /**
   * Get widget title.
   *
   * Retrieve oEmbed widget title.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget title.
   */
  public function get_title()
  {
    return __('Hello World', 'elementor-bedev-extension');
  }

  /**
   * Get widget icon.
   *
   * Retrieve oEmbed widget icon.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget icon.
   */
  public function get_icon()
  {
    return 'fa fa-globe';
  }

  /**
   * Get widget categories.
   *
   * Retrieve the list of categories the oEmbed widget belongs to.
   *
   * @since 1.0.0
   * @access public
   *
   * @return array Widget categories.
   */
  public function get_categories()
  {
    return ['bedevcategogy'];
  }

  /**
   * Register oEmbed widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function _register_controls()
  {

    $this->start_controls_section(
      'content_section',
      [
        'label' => __('Content', 'elementor-bedev-extension'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => __('Title', 'elementor-bedev-extension'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Enter your title', 'elementor-bedev-extension'),
      ]
    );

    $this->add_control(
      'text_color',
      [
        'label' => __('Text Color', 'elementor-bedev-extension'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#fefefe',
      ]
    );

    $this->add_control(
      'url',
      [
        'label' => __('URL to embed', 'elementor-bedev-extension'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'input_type' => 'url',
        'placeholder' => __('https://your-link.com', 'elementor-bedev-extension'),
      ]
    );

  

    $this->end_controls_section();

    $this->start_controls_section(
      'content2_section',
      [
        'label' => __('Content', 'elementor-bedev-extension'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'popover-toggle',
      [
        'label' => __('Box', 'elementor-bedev-extension'),
        'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
        'label_off' => __('Default', 'your-plugin'),
        'label_on' => __('Custom', 'your-plugin'),
        'return_value' => 'yes',
      ]
    );

    $this->start_popover();

    $this->add_control(
      'custom_dimension',
      [
        'label' => __('Image Dimension', 'elementor-bedev-extension'),
        'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
        'description' => __('Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name'),
        'default' => [
          'width' => '',
          'height' => '',
        ],
      ]
    );

    $this->add_control(
      'custom_html',
      [
        'label' => __('Custom HTML', 'elementor-bedev-extension'),
        'type' => \Elementor\Controls_Manager::CODE,
        'language' => 'html',
        'rows' => 20,
      ]
    );

    $this->end_popover();

    $this->end_controls_section();

   }

  /**
   * Render oEmbed widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   * @access protected
   */
  protected function render()
  {

    $settings = $this->get_settings_for_display();

    echo '<h1  style="color:'. $settings['text_color'] .';  text-align:center;">'. $settings['title'].'</h1>';

    $html = wp_oembed_get($settings['url']);

    echo '<div class="oembed-elementor-widget">';

    echo '<div>'.$settings['custom_html'].'</div>';

    echo ($html) ? $html : $settings['url'];

    echo '</div>';

  }

}
