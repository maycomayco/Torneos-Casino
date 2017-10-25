<?php
/*
Plugin Name: Promociones - KNX
Text Domain: knx-promociones
Plugin URI: http://kinexo.com
Description: Administrar promociones nunca fue tan sencillo!
Version: 0.2
Author: Mayco
Author URI: https://www.linkedin.com/in/mayco-barale-2563815a/
License: GPLv2 o posterior
*/

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/*
	Registro Custom Post
*/

if ( ! function_exists('knx_promociones') ) {
	// Register Custom Post Type
	function knx_promociones() {

		$labels = array(
			'name'                  => _x( 'Promociones', 'Post Type General Name', 'knx-promociones' ),
			'singular_name'         => _x( 'Promocion', 'Post Type Singular Name', 'knx-promociones' ),
			'menu_name'             => __( 'Promociones', 'knx-promociones' ),
			'name_admin_bar'        => __( 'Promocion', 'knx-promociones' ),
			'archives'              => __( 'Archivos de promocion', 'knx-promociones' ),
			'attributes'            => __( 'Item Attributes', 'knx-promociones' ),
			'parent_item_colon'     => __( 'Parent Item:', 'knx-promociones' ),
			'all_items'             => __( 'Todos las promociones', 'knx-promociones' ),
			'add_new_item'          => __( 'Agregar nueva promocion', 'knx-promociones' ),
			'add_new'               => __( 'Agregar nueva', 'knx-promociones' ),
			'new_item'              => __( 'Nueva promocion', 'knx-promociones' ),
			'edit_item'             => __( 'Editar promocion', 'knx-promociones' ),
			'update_item'           => __( 'Actualizar promocion', 'knx-promociones' ),
			'view_item'             => __( 'Ver promocion', 'knx-promociones' ),
			'view_items'            => __( 'Ver promociones', 'knx-promociones' ),
			'search_items'          => __( 'Buscar promocion', 'knx-promociones' ),
			'not_found'             => __( 'No encontrado', 'knx-promociones' ),
			'not_found_in_trash'    => __( 'No encontrado en la papelera', 'knx-promociones' ),
			'featured_image'        => __( 'Imagen destacada', 'knx-promociones' ),
			'set_featured_image'    => __( 'Agregar imagen destacada', 'knx-promociones' ),
			'remove_featured_image' => __( 'Remover imagen destacada', 'knx-promociones' ),
			'use_featured_image'    => __( 'Usar como imagen destacada', 'knx-promociones' ),
			'insert_into_item'      => __( 'Insertar en promocion', 'knx-promociones' ),
			'uploaded_to_this_item' => __( 'Cargado a esta promocion', 'knx-promociones' ),
			'items_list'            => __( 'Promociones lista', 'knx-promociones' ),
			'items_list_navigation' => __( 'Promociones lista de navegacion', 'knx-promociones' ),
			'filter_items_list'     => __( 'Filtrar promociones', 'knx-promociones' ),
		);
		$args = array(
			'label'                 => __( 'Promocion', 'knx-promociones' ),
			'description'           => __( 'Para administrar promociones', 'knx-promociones' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-controls-repeat',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'promocion', $args );
	}
	add_action( 'init', 'knx_promociones', 0 );
}

/**
 * Incluimos cada custom field con el plugin CMB2
 * 
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
add_action( 'cmb2_admin_init', 'promocion_register_demo_metabox' );

function promocion_register_demo_metabox() {
	$prefix = 'knx_';
	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'promocion' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb_demo->add_field( array(
		'name' => esc_html__( 'Test Date Picker (UNIX timestamp)', 'cmb2' ),
		'desc' => esc_html__( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textdate_timestamp',
		'type' => 'text_date_timestamp',
		// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
	) );
}

/*
	Registramos modulo a Visual Composer
*/
if( function_exists( 'vc_manager' ) ) {
	// require_once( plugin_dir_path( __FILE__ ) . 'templates/custom-templates.php' );
	// require_once( plugin_dir_path( __FILE__ ) . 'promocion-shortcode.php' );

	// Before VC Init
	add_action( 'vc_before_init', 'knx_promociones' );
	function knx_promociones() {
    // Require new custom Element
    require_once( plugin_dir_path( __FILE__ ) . 'vc_elements/promocion-shortcode.php' );
	}

}
