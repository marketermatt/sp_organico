<?php

// Register "New" admin menu bar menu
add_action('admin_bar_menu', 'ls_admin_bar', 999 );
function ls_admin_bar($wp_admin_bar) {
	$wp_admin_bar->add_node(array(
		'parent' => 'new-content',
		'id'    => 'ab-ls-add-new',
		'title' => 'LayerSlider',
		'href'  => admin_url('admin.php?page=layerslider')
	));
}

// Register sidebar menu
add_action('admin_menu', 'layerslider_settings_menu');
function layerslider_settings_menu() {

	// Menu hook
	global $layerslider_hook;

	$capability = get_option('layerslider_custom_capability', 'manage_options');
	$icon = version_compare(get_bloginfo('version'), '3.8', '>=') ? 'dashicons-images-alt2' : LS_ROOT_URL.'/static/img/icon_16x16.png'; 

	// Add main page
	$layerslider_hook = add_menu_page(
		'LayerSlider WP', 'LayerSlider WP',
		$capability, 'layerslider', 'layerslider_router',
		$icon,
		57.777
	);

	// Add "All Sliders" submenu
	add_submenu_page(
		'layerslider', 'LayerSlider WP', __('All Sliders', 'LayerSlider'),
		$capability, 'layerslider', 'layerslider_router'
	);

	// Add "Skin Editor" submenu
	add_submenu_page(
		'layerslider', 'LayerSlider WP Skin Editor', __('Skin Editor', 'LayerSlider'),
		$capability, 'ls-skin-editor', 'layerslider_router'
	);

	// Add "CSS Editor submenu"
	add_submenu_page(
		'layerslider', 'LayerSlider WP CSS Editor', __('CSS Editor', 'LayerSlider'),
		$capability, 'ls-style-editor', 'layerslider_router');

	// Add "Transition Builder" submenu
	add_submenu_page(
		'layerslider', 'LayerSlider WP Transition Builder', __('Transition Builder', 'LayerSlider'),
		$capability, 'ls-transition-builder', 'layerslider_router');

}

function layerslider_router() {

	// Get current screen details
	$screen = get_current_screen();

	if(strpos($screen->base, 'ls-skin-editor') !== false) {
		include(LS_ROOT_PATH.'/views/skin_editor.php');

	} elseif(strpos($screen->base, 'ls-transition-builder') !== false) {
		include(LS_ROOT_PATH.'/views/transition_builder.php');

	} elseif(strpos($screen->base, 'ls-style-editor') !== false) {
		include(LS_ROOT_PATH.'/views/style_editor.php');

	} elseif(isset($_GET['action']) && $_GET['action'] == 'edit') {
		include(LS_ROOT_PATH.'/views/slider_edit.php');

	} else {
		include(LS_ROOT_PATH.'/views/slider_list.php');
	}
}



?>
