<?php

/*
 Plugin Name: merch.systems Storefront
 Version: 1.0.0
 Description: Fully integrates your merch.systems online store into your Wordpress website
 Plugin URI: https://merch.systems
 Author: anti-design.com GmbH & Co. KG
 Author URI: http://anti-design.com
 
 @package merchsys
 @subpackage merchsys/admin
 */
class MerchSysStore_Admin extends MerchSys_Admin {
	
	private $plugin_name;
	private $version;
	
	public function __construct() {
		$this->plugin_name = MerchSysStore_Settings::PLUGIN_NAME;
		$this->version = MerchSysStore_Settings::PLUGIN_VERSION;
	}
	
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name.'-admin', plugin_dir_url( __FILE__ ) . 'css/'.$this->plugin_name.'-admin.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_register_script( $this->plugin_name.'-admin', plugin_dir_url( __FILE__ ) . 'js/'.$this->plugin_name.'-admin.js', array( 'jquery'), $this->version, false);
		wp_enqueue_script( $this->plugin_name.'-admin');
	}

	public function add_merchsys_admin_page() {
		add_submenu_page(
			'merchsys_admin_menu',
			__('Merch Systems Store Admin', $this->plugin_name),
			__('Store Admin', $this->plugin_name),
			'manage_options',
			$this->plugin_name.'_admin_menu',
			array( $this, 'merchsys_settings_page' )
		);
	}
	
	public function merchsys_settings_page() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		$pages = get_pages();
		$menus = get_registered_nav_menus();
		require_once plugin_dir_path( __FILE__ ). 'partials/merchsys_settings_page.php';
	}
	
	public function register_merchsys_settings() {
		register_setting('merchsys_cart_group', 'merchsys_addmenu');
		register_setting('merchsys_cart_group', 'merchsys_showshopcarousel');
		//register_setting('merchsys_cart_group', 'merchsys_navigationname');
		register_setting('merchsys_cart_group', 'merchsys_showloginmenu');
		register_setting('merchsys_cart_group', 'merchsys_loginmenuwrapper');
		register_setting('merchsys_cart_group', 'merchsys_basketmenuwrapper');
		register_setting('merchsys_cart_group', 'merchsys_maxamount');
		register_setting('merchsys_cart_group', 'merchsys_gobasket');
	}
	
	public function map_vc_shortcodes()  {
		if (function_exists('vc_map')) {
			$all_pages = get_pages(array(
				'hierarchical' => 0,
				'post_type' => 'page',
				'post_status' => 'publish'
			));
			
			$pages = array();
			$pages['Select'] = '';
			if (!empty($all_pages)){
				foreach ($all_pages as $page) {
					$pages[$page->post_title] = str_replace(get_site_url(), '', esc_url(get_permalink($page->ID)));
				}
			}
			
			vc_map(array(
				'name' => $this->plugin_name.' Shop Shortcode',
				'base' => MerchSysStore_Settings::SHOP_SHORTCODE,
				'description' => __('Add this shortcode if you want to show a Merchsys shop in this page', $this->plugin_name),
				'group' => $this->plugin_name,
				'holder' => "div",
				'class' => $this->plugin_name,
				"params" => array(
					array(
					  "type" => "dropdown",
					  "heading" => __( "Terms page", $this->plugin_name),
					  "param_name" => "terms_page",
					  "value" => $pages
					),
					array(
					  "type" => "dropdown",
					  "heading" => __( "Privacy page", $this->plugin_name),
					  "param_name" => "privacy_page",
					  "value" => $pages
					),
					array(
					  "type" => "textfield",
					  "heading" => __( "Language locale", $this->plugin_name),
					  "param_name" => "locale",
					  "value" => "",
					),
				)
			));
			
		}
	}
}
