<?php

namespace LemonElementor\Includes\Settings;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Settings_Footer extends Tab_Base {

	public function get_id() {
		return 'lemon-settings-footer';
	}

	public function get_title() {
		return __( 'Footer', 'lemon-main' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {

		$this->start_controls_section(
			'lemon_footer_section',
			[
				'tab' => 'lemon-settings-footer',
				'label' => __( 'Footer', 'lemon-main' ),
			]
		);

		$this->add_control(
			'lemon_footer_logo_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'lemon-main' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'lemon-main' ),
				'label_off' => __( 'Hide', 'lemon-main' ),
				'selector' => '.site-footer .site-branding',
			]
		);

		$this->add_control(
			'lemon_footer_tagline_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'lemon-main' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'lemon-main' ),
				'label_off' => __( 'Hide', 'lemon-main' ),
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'lemon_footer_menu_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'lemon-main' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'lemon-main' ),
				'label_off' => __( 'Hide', 'lemon-main' ),
				'selector' => '.site-footer .site-navigation',
			]
		);

		$this->add_control(
			'lemon_footer_copyright_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Copyright', 'lemon-main' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'lemon-main' ),
				'label_off' => __( 'Hide', 'lemon-main' ),
				'selector' => '.site-footer .copyright',
			]
		);

		$this->add_control(
			'lemon_footer_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Layout', 'lemon-main' ),
				'options' => [
					'default' => __( 'Default', 'lemon-main' ),
					'inverted' => __( 'Inverted', 'lemon-main' ),
					'stacked' => __( 'Centered', 'lemon-main' ),
				],
				'selector' => '.site-footer',
				'default' => 'default',
			]
		);

		$this->add_control(
			'lemon_footer_width',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Width', 'lemon-main' ),
				'options' => [
					'boxed' => __( 'Boxed', 'lemon-main' ),
					'full-width' => __( 'Full Width', 'lemon-main' ),
				],
				'selector' => '.site-footer',
				'default' => 'boxed',
			]
		);

		$this->add_responsive_control(
			'lemon_footer_custom_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Content Width', 'lemon-main' ),
				'size_units' => [
					'%',
					'px',
				],
				'range' => [
					'px' => [
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'lemon_footer_width' => 'boxed',
				],
				'selectors' => [
					'.site-footer .footer-inner' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				],
			]
		);

		$this->add_responsive_control(
			'lemon_footer_gap',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Gap', 'lemon-main' ),
				'size_units' => [
					'%',
					'px',
				],
				'range' => [
					'px' => [
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'.site-footer' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'lemon_footer_layout!' => 'stacked',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'lemon_footer_background',
				'label' => __( 'Background', 'lemon-main' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.site-footer',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'lemon_footer_logo_section',
			[
				'tab' => 'lemon-settings-footer',
				'label' => __( 'Site Logo', 'lemon-main' ),
				'condition' => [
					'lemon_footer_logo_display!' => '',
				],
			]
		);

		$this->add_control(
			'lemon_footer_logo_type',
			[
				'label' => __( 'Type', 'lemon-main' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'logo',
				'options' => [
					'logo' => __( 'Logo', 'lemon-main' ),
					'title' => __( 'Title', 'lemon-main' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'lemon_footer_logo_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'lemon-main' ),
				'description' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'lemon-main' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'size_units' => [
					'%',
					'px',
					'vh',
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'lemon_footer_logo_display' => 'yes',
					'lemon_footer_logo_type' => 'logo',
				],
				'selectors' => [
					'.site-footer .site-branding .site-logo img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'lemon_footer_title_color',
			[
				'label' => __( 'Text Color', 'lemon-main' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'lemon_footer_logo_display' => 'yes',
					'lemon_footer_logo_type' => 'title',
				],
				'selectors' => [
					'.site-footer h4.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'lemon_footer_title_typography',
				'label' => __( 'Typography', 'lemon-main' ),
				'condition' => [
					'lemon_footer_logo_display' => 'yes',
					'lemon_footer_logo_type' => 'title',
				],
				'selector' => '.site-footer h4.site-title',

			]
		);

		$this->add_control(
			'lemon_footer_title_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'lemon-main' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'elementor-control-field-description',
				'condition' => [
					'lemon_footer_logo_display' => 'yes',
					'lemon_footer_logo_type' => 'title',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'lemon_footer_tagline',
			[
				'tab' => 'lemon-settings-footer',
				'label' => __( 'Tagline', 'lemon-main' ),
				'condition' => [
					'lemon_footer_tagline_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'lemon_footer_tagline_color',
			[
				'label' => __( 'Text Color', 'lemon-main' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'lemon_footer_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'lemon_footer_tagline_typography',
				'label' => __( 'Typography', 'lemon-main' ),
				'condition' => [
					'lemon_footer_tagline_display' => 'yes',
				],
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'lemon_footer_tagline_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'lemon-main' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'elementor-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'lemon_footer_menu_tab',
			[
				'tab' => 'lemon-settings-footer',
				'label' => __( 'Menu', 'lemon-main' ),
				'condition' => [
					'lemon_footer_menu_display' => 'yes',
				],
			]
		);

		$available_menus = wp_get_nav_menus();

		$menus = [ '0' => __( '— Select a Menu —', 'lemon-main' ) ];
		foreach ( $available_menus as $available_menu ) {
			$menus[ $available_menu->term_id ] = $available_menu->name;
		}

		if ( 1 === count( $menus ) ) {
			$this->add_control(
				'lemon_footer_menu_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'lemon-main' ) . '</strong><br>' . sprintf( __( 'Go to <a href="%s" target="_blank">Menus screen</a> to create one.', 'lemon-main' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		} else {
			$this->add_control(
				'lemon_footer_menu',
				[
					'label' => __( 'Menu', 'lemon-main' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'lemon-main' ), admin_url( 'nav-menus.php' ) ),
				]
			);

			$this->add_control(
				'lemon_footer_menu_warning',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( 'Changes will be reflected in the preview only after the page reloads.', 'lemon-main' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_control(
				'lemon_footer_menu_color',
				[
					'label' => __( 'Color', 'lemon-main' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'footer .footer-inner .site-navigation a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'lemon_footer_menu_typography',
					'label' => __( 'Typography', 'lemon-main' ),
					'selector' => 'footer .footer-inner .site-navigation a',
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'lemon_footer_copyright_section',
			[
				'tab' => 'lemon-settings-footer',
				'label' => __( 'Copyright', 'lemon-main' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'lemon_footer_copyright_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'lemon_footer_copyright_text',
			[
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'All rights reserved', 'lemon-main' ),
			]
		);

		$this->add_control(
			'lemon_footer_copyright_color',
			[
				'label' => __( 'Text Color', 'lemon-main' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'lemon_footer_copyright_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'lemon_footer_copyright_typography',
				'label' => __( 'Typography', 'lemon-main' ),
				'condition' => [
					'lemon_footer_copyright_display' => 'yes',
				],
				'selector' => '.site-footer .copyright p',
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		// Save chosen footer menu to the WP settings.
		if ( isset( $data['settings']['lemon_footer_menu'] ) ) {
			$menu_id = $data['settings']['lemon_footer_menu'];
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-2'] = (int) $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	public function get_additional_tab_content() {
		if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			return sprintf( '
				<div class="lemon-elementor elementor-nerd-box">
					<img src="%4$s" class="elementor-nerd-box-icon">
					<div class="elementor-nerd-box-message">
						<p class="elementor-panel-heading-title elementor-nerd-box-title">%1$s</p>
						<p>%2$s</p>
					</div>
					<a class="elementor-button elementor-button-default elementor-nerd-box-link" target="_blank" href="https://go.elementor.com/lemon-theme-footer/">%3$s</a>
				</div>
				',
				__( 'Create a custom footer with multiple options', 'lemon-main' ),
				__( 'Upgrade to Elementor Pro and enjoy free design and many more features', 'lemon-main' ),
				__( 'Upgrade', 'lemon-main' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		} else {
			return sprintf( '
				<div class="lemon-elementor elementor-nerd-box">
					<img src="%4$s" class="elementor-nerd-box-icon">
					<div class="elementor-nerd-box-message">
						<p class="elementor-panel-heading-title elementor-nerd-box-title">%1$s</p>
						<p class="elementor-nerd-box-message">%2$s</p>
					</div>
					<a class="elementor-button elementor-button-success elementor-nerd-box-link" target="_blank" href="%5$s">%3$s</a>
				</div>
				',
				__( 'Create a custom footer with the new Theme Builder', 'lemon-main' ),
				__( 'With the new Theme Builder you can jump directly into each part of your site', 'lemon-main' ),
				__( 'Create Footer', 'lemon-main' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg',
				get_admin_url( null, 'admin.php?page=elementor-app#/site-editor/templates/footer' )
			);
		}
	}
}
