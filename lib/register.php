<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgRegister' ) ) {

	class WpssoOrgRegister {

		public function __construct() {

			register_activation_hook( WPSSOORG_FILEPATH, array( $this, 'network_activate' ) );

			register_deactivation_hook( WPSSOORG_FILEPATH, array( $this, 'network_deactivate' ) );

			if ( is_multisite() ) {

				add_action( 'wpmu_new_blog', array( $this, 'wpmu_new_blog' ), 10, 6 );

				add_action( 'wpmu_activate_blog', array( $this, 'wpmu_activate_blog' ), 10, 5 );
			}

			/**
			 * Priorities:
			 *
			 * 	FAQs = 10
			 * 	Organizations = 20
			 * 	Places = 30
			 */
			add_action( 'wpsso_init_options', array( $this, 'register_taxonomy_org_category' ), 20 );

			add_action( 'wpsso_init_options', array( $this, 'register_post_type_organization' ), 20 );
		}

		/**
		 * Fires immediately after a new site is created.
		 */
		public function wpmu_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

			switch_to_blog( $blog_id );

			$this->activate_plugin();

			restore_current_blog();
		}

		/**
		 * Fires immediately after a site is activated (not called when users and sites are created by a Super Admin).
		 */
		public function wpmu_activate_blog( $blog_id, $user_id, $password, $signup_title, $meta ) {

			switch_to_blog( $blog_id );

			$this->activate_plugin();

			restore_current_blog();
		}

		public function network_activate( $sitewide ) {

			self::do_multisite( $sitewide, array( $this, 'activate_plugin' ) );
		}

		public function network_deactivate( $sitewide ) {

			self::do_multisite( $sitewide, array( $this, 'deactivate_plugin' ) );
		}

		/**
		 * uninstall.php defines constants before calling network_uninstall().
		 */
		public static function network_uninstall() {

			$sitewide = true;

			/**
			 * Uninstall from the individual blogs first.
			 */
			self::do_multisite( $sitewide, array( __CLASS__, 'uninstall_plugin' ) );
		}

		private static function do_multisite( $sitewide, $method, $args = array() ) {

			if ( is_multisite() && $sitewide ) {

				global $wpdb;

				$db_query = 'SELECT blog_id FROM '.$wpdb->blogs;
				$blog_ids = $wpdb->get_col( $db_query );

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );

					call_user_func_array( $method, array( $args ) );
				}

				restore_current_blog();

			} else {
				call_user_func_array( $method, array( $args ) );
			}
		}

		private function activate_plugin() {

			if ( class_exists( 'Wpsso' ) ) {

				/**
				 * Register plugin install, activation, update times.
				 */
				if ( class_exists( 'WpssoUtilReg' ) ) {	// Since WPSSO v6.13.1.

					$version = WpssoOrgConfig::$cf[ 'plugin' ][ 'wpssoorg' ][ 'version' ];

					WpssoUtilReg::update_ext_version( 'wpssoorg', $version );
				}

				$this->register_taxonomy_org_category();

				$this->register_post_type_organization();

				flush_rewrite_rules();
			}
		}

		private function deactivate_plugin() {

			unregister_taxonomy( WPSSOORG_CATEGORY_TAXONOMY );

			unregister_post_type( WPSSOORG_ORGANIZATION_POST_TYPE );

			flush_rewrite_rules();
		}

		private static function uninstall_plugin() {
		}

		public function register_taxonomy_org_category() {

			$labels = array(
				'name'                       => __( 'Categories', 'wpsso-organization' ),
				'singular_name'              => __( 'Category', 'wpsso-organization' ),
				'menu_name'                  => _x( 'Categories', 'Admin menu name', 'wpsso-organization' ),
				'all_items'                  => __( 'All Categories', 'wpsso-organization' ),
				'edit_item'                  => __( 'Edit Category', 'wpsso-organization' ),
				'view_item'                  => __( 'View Category', 'wpsso-organization' ),
				'update_item'                => __( 'Update Category', 'wpsso-organization' ),
				'add_new_item'               => __( 'Add New Category', 'wpsso-organization' ),
				'new_item_name'              => __( 'New Category Name', 'wpsso-organization' ),
				'parent_item'                => __( 'Parent Category', 'wpsso-organization' ),
				'parent_item_colon'          => __( 'Parent Category:', 'wpsso-organization' ),
				'search_items'               => __( 'Search Categories', 'wpsso-organization' ),
				'popular_items'              => __( 'Popular Categories', 'wpsso-organization' ),
				'separate_items_with_commas' => __( 'Separate categories with commas', 'wpsso-organization' ),
				'add_or_remove_items'        => __( 'Add or remove categories', 'wpsso-organization' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'wpsso-organization' ),
				'not_found'                  => __( 'Not categories found.', 'wpsso-organization' ),
				'back_to_items'              => __( '← Back to categories', 'wpsso-organization' ),
			);

			$args = array(
				'label'              => _x( 'Categories', 'Taxonomy label', 'wpsso-organization' ),
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => true,
				'show_in_rest'       => true,
				'show_tagcloud'      => false,
				'show_in_quick_edit' => true,
				'show_admin_column'  => true,
				'description'        => _x( 'Categories for Organizations', 'Taxonomy description', 'wpsso-organization' ),
				'hierarchical'       => true,
			);

			register_taxonomy( WPSSOORG_CATEGORY_TAXONOMY, array( WPSSOORG_ORGANIZATION_POST_TYPE ), $args );
		
		}

		public function register_post_type_organization() {

			$labels = array(
				'name'                     => __( 'Organizations', 'Post type general name', 'wpsso-organization' ),
				'singular_name'            => __( 'Organization', 'Post type singular name', 'wpsso-organization' ),
				'add_new'                  => __( 'Add New', 'wpsso-organization' ),
				'add_new_item'             => __( 'Add New Organization', 'wpsso-organization' ),
				'edit_item'                => __( 'Edit Organization', 'wpsso-organization' ),
				'new_item'                 => __( 'New Organization', 'wpsso-organization' ),
				'view_item'                => __( 'View Organization', 'wpsso-organization' ),
				'view_items'               => __( 'View Organizations', 'wpsso-organization' ),
				'search_items'             => __( 'Search Organizations', 'wpsso-organization' ),
				'not_found'                => __( 'No organizations found', 'wpsso-organization' ),
				'not_found_in_trash'       => __( 'No organizations found in Trash', 'wpsso-organization' ),
				'parent_item_colon'        => __( 'Parent Organization:', 'wpsso-organization' ),
				'all_items'                => __( 'All Organizations', 'wpsso-organization' ),
				'archives'                 => __( 'Organization Archives', 'wpsso-organization' ),
				'attributes'               => __( 'Organization Attributes', 'wpsso-organization' ),
				'insert_into_item'         => __( 'Insert into answer', 'wpsso-organization' ),
				'uploaded_to_this_item'    => __( 'Uploaded to this organization', 'wpsso-organization' ),
				'featured_image'           => __( 'Organization Image', 'wpsso-organization' ),
				'set_featured_image'       => __( 'Set organization image', 'wpsso-organization' ),
				'remove_featured_image'    => __( 'Remove organization image', 'wpsso-organization' ),
				'use_featured_image'       => __( 'Use as organization image', 'wpsso-organization' ),
				'menu_name'                => _x( 'Organizations', 'Admin menu name', 'wpsso-organization' ),
				'filter_items_list'        => __( 'Filter organizations', 'wpsso-organization' ),
				'items_list_navigation'    => __( 'Organizations list navigation', 'wpsso-organization' ),
				'items_list'               => __( 'Organizations list', 'wpsso-organization' ),
				'name_admin_bar'           => _x( 'Organization', 'Admin bar name', 'wpsso-organization' ),
				'item_published'	   => __( 'Organization published.', 'wpsso-organization' ),
				'item_published_privately' => __( 'Organization published privately.', 'wpsso-organization' ),
				'item_reverted_to_draft'   => __( 'Organization reverted to draft.', 'wpsso-organization' ),
				'item_scheduled'           => __( 'Organization scheduled.', 'wpsso-organization' ),
				'item_updated'             => __( 'Organization updated.', 'wpsso-organization' ),
			);

			$args = array(
				'label'                 => _x( 'Organization', 'Post type label', 'wpsso-organization' ),
				'labels'                => $labels,
				'description'           => _x( 'Organization', 'Post type description', 'wpsso-organization' ),
				'public'                => true,
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'show_ui'               => true,
				'show_in_nav_menus'     => true,
				'show_in_menu'          => true,
				'show_in_admin_bar'     => true,
				'menu_position'         => 20,
				'menu_icon'             => 'dashicons-groups',
				'capability_type'       => 'page',
				'hierarchical'          => false,
				'supports'              => array(
					'title',
					'editor',
					'author',
					'thumbnail',
					'excerpt',
					'trackbacks',
					'comments',
					'revisions',
					'page-attributes',
				),
				'taxonomies'            => array( WPSSOORG_CATEGORY_TAXONOMY ),
				'has_archive'           => 'orgs',
				'can_export'            => true,
				'show_in_rest'          => true,
			);

			register_post_type( WPSSOORG_ORGANIZATION_POST_TYPE, $args );
		}
	}
}
