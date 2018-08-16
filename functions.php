<?php
wp_enqueue_style( 'general-css', get_stylesheet_directory_uri() . '/css/general.css' );
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}
$args = array(
	/* (string) The title displayed on the options page. Required. */
	'page_title' => 'BYU Header and Footer Options',

	/* (string) The title displayed in the wp-admin sidebar. Defaults to page_title */
	'menu_title' => 'BYU Options',

	/* (string) The slug name to refer to this menu by (should be unique for this menu).
	Defaults to a url friendly version of menu_slug */
	'menu_slug' => 'byu_options',

	/* (string) The capability required for this menu to be displayed to the user. Defaults to edit_posts.
	Read more about capability here: http://codex.wordpress.org/Roles_and_Capabilities */
	'capability' => 'edit_posts',

	/* (int|string) The position in the menu order this menu should appear.
	WARNING: if two menu items use the same position attribute, one of the items may be overwritten so that only one item displays!
	Risk of conflict can be reduced by using decimal instead of integer values, e.g. '63.3' instead of 63 (must use quotes).
	Defaults to bottom of utility menu items */
	'position' => false,

	/* (string) The slug of another WP admin page. if set, this will become a child page. */
	'parent_slug' => '',

	/* (string) The icon class for this menu. Defaults to default WordPress gear.
	Read more about dash icons here: https://developer.wordpress.org/resource/dashicons/ */
	'icon_url' => false,

	/* (boolean) If set to true, this options page will redirect to the first child page (if a child page exists).
	If set to false, this parent page will appear alongside any child pages. Defaults to true */
	'redirect' => true,

	/* (int|string) The '$post_id' to save/load data to/from. Can be set to a numeric post ID (123), or a string ('user_2').
	Defaults to 'options'. Added in v5.2.7 */
	'post_id' => 'options',

	/* (boolean)  Whether to load the option (values saved from this options page) when WordPress starts up.
	Defaults to false. Added in v5.2.8. */
	'autoload' => false,
);
acf_add_options_page( $args );

// registers and add supports to Speaker post type
add_action( 'init', 'add_people' );
function add_people() {
	flush_rewrite_rules();
	$singleUppercase = "Person";
	$pluralUppercase = "People";

	$pluralLowercase = "people";

	$labels = array(
		'add_new_item'       => 'Add New ' . $singleUppercase,
		'new_item'           => 'New ' . $singleUppercase,
		'edit_item'          => 'Edit ' . $singleUppercase,
		'view_item'          => 'View ' . $singleUppercase,
		'all_items'          => 'All ' . $pluralUppercase,
		'search_items'       => 'Search ' . $pluralUppercase,
		'parent_item_colon'  => 'Parent ' . $pluralUppercase . ':',
		'not_found'          => 'No ' . $pluralLowercase . ' found.',
		'not_found_in_trash' => 'No ' . $pluralLowercase . ' found in Trash.'
	);

	$args = array(
		'label' => $pluralUppercase,
		'labels' => $labels,
		'public' => true,
		'supports' => array('thumbnail', 'title', 'editor'),
		'taxonomies' => array(),
		'menu_icon' => 'dashicons-businessman',
		'hierarchical' => false,
		'menu_position' => 5,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'people'),
	);
	register_post_type( 'people', $args );
}

/* START
Managing the columns and the filtering of the main dashboard menus of the CPT "Speech"
*/

/* NEW
* Registers new admin columns
*/
add_filter('manage_speaker_posts_columns', 'manage_speaker_table_head');
function manage_speaker_table_head( $defaults ) {
	$defaults['portrait'] = 'portrait';
	return $defaults;
}

/* NEW
* Registers Method for finding the data for the new admin columns
*/
add_action( 'manage_speaker_posts_custom_column', 'manage_speaker_table_content', 10, 2 );
function manage_speaker_table_content( $column_name, $post_id ) {
	if ($column_name == 'portrait') {
		$image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		if($image) { ?>
			<img width="100" src="<?php echo $image; ?>">
			<?php
		}
	}

}

add_action( 'init', 'add_project' );
function add_project() {

	$singleUppercase = "Project";
	$pluralUppercase = "Projects";

	$pluralLowercase = "projects";

	$labels = array(
		'add_new_item'       => 'Add New ' . $singleUppercase,
		'new_item'           => 'New ' . $singleUppercase,
		'edit_item'          => 'Edit ' . $singleUppercase,
		'view_item'          => 'View ' . $singleUppercase,
		'all_items'          => 'All ' . $pluralUppercase,
		'search_items'       => 'Search ' . $pluralUppercase,
		'parent_item_colon'  => 'Parent ' . $pluralUppercase . ':',
		'not_found'          => 'No ' . $pluralLowercase . ' found.',
		'not_found_in_trash' => 'No ' . $pluralLowercase . ' found in Trash.'
	);

	$args = array(
		'label' => $pluralUppercase,
		'labels' => $labels,
		'public' => true,
		'supports' => array('thumbnail', 'title', 'editor'),
		'taxonomies' => array(),
		'menu_icon' => 'dashicons-businessman',
		'hierarchical' => false,
		'menu_position' => 5,
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'projects'),
	);
	register_post_type( 'projects', $args );
}

add_action( 'init', 'add_type_taxonomy', 0 );
function add_type_taxonomy() {

	$singleUppercase = 'Type';
	$pluralUppercase = 'Types';

	$singleLowercase = 'type';
	$pluralLowercase = 'types';

	$labels = array(
		'name'                       => _x( $singleUppercase, 'taxonomy general name' ),
		'singular_name'              => _x( $singleLowercase, 'taxonomy singular name' ),
		'search_items'               => __( 'Search ' . $pluralUppercase ),
		'popular_items'              => __( 'Popular ' . $pluralUppercase ),
		'all_items'                  => __( 'All ' . $pluralUppercase ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit ' . $singleUppercase ),
		'update_item'                => __( 'Update ' . $singleUppercase ),
		'add_new_item'               => __( 'Add New ' . $singleUppercase ),
		'new_item_name'              => __( 'New ' . $singleUppercase . ' Name' ),
		'separate_items_with_commas' => __( 'Separate ' . $pluralUppercase . ' with commas' ),
		'add_or_remove_items'        => __( 'Add or remove ' . $singleLowercase ),
		'choose_from_most_used'      => __( 'Choose from the most used ' . $pluralLowercase ),
		'not_found'                  => __( 'No ' . $pluralLowercase . ' found.' ),
		'menu_name'                  => __( $singleUppercase ),
	);
	$args = array(
		'hierarchical'          => true, // This being true makes this taxonomy behave like a category, with a heirarchy, false is a like a tag
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'type' ),
	);
	$types = array('people'); // A list of the CPT's that are to use this taxonomy
	register_taxonomy( 'type', $types, $args );
}