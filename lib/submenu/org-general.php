<?php
/**
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoOrgSubmenuOrgGeneral' ) && class_exists( 'WpssoAdmin' ) ) {

	class WpssoOrgSubmenuOrgGeneral extends WpssoAdmin {

		public function __construct( &$plugin, $id, $name, $lib, $ext ) {

			$this->p =& $plugin;

			if ( $this->p->debug->enabled ) {
				$this->p->debug->mark();
			}

			$this->menu_id   = $id;
			$this->menu_name = $name;
			$this->menu_lib  = $lib;
			$this->menu_ext  = $ext;
		}

		/**
		 * Called by the extended WpssoAdmin class.
		 */
		protected function add_meta_boxes() {

			$this->maybe_show_language_notice();

			$metabox_id      = 'general';
			$metabox_title   = _x( 'Organizations and Knowledge Graph', 'metabox title', 'wpsso-organization' );
			$metabox_screen  = $this->pagehook;
			$metabox_context = 'normal';
			$metabox_prio    = 'default';
			$callback_args   = array(	// Second argument passed to the callback function / method.
			);

			add_meta_box( $this->pagehook . '_' . $metabox_id, $metabox_title,
				array( $this, 'show_metabox_general' ), $metabox_screen,
					$metabox_context, $metabox_prio, $callback_args );
		}

		public function show_metabox_general() {

			$metabox_id = 'organization';

			$tabs = apply_filters( $this->p->lca . '_' . $metabox_id . '_tabs', array( 
				'site'                => _x( 'WebSite (Front Page)', 'metabox tab', 'wpsso-organization' ),
				'other_organizations' => _x( 'Other Organizations', 'metabox tab', 'wpsso-organization' ),
			) );

			$table_rows = array();

			foreach ( $tabs as $tab_key => $title ) {

				$filter_name = $this->p->lca . '_' . $metabox_id . '_' . $tab_key . '_rows';

				$table_rows[ $tab_key ] = apply_filters( $filter_name, $this->get_table_rows( $metabox_id, $tab_key ), $this->form );
			}

			$this->p->util->do_metabox_tabbed( $metabox_id, $tabs, $table_rows );
		}

		protected function get_table_rows( $metabox_id, $tab_key ) {

			$table_rows = array();

			switch ( $metabox_id . '-' . $tab_key ) {

				case 'organization-site':

					$atts_locale = array( 'is_locale' => true );

					$def_site_name = get_bloginfo( 'name' );
					$def_site_desc = get_bloginfo( 'description' );
					$def_site_url  = get_bloginfo( 'url' );

					$site_name_key     = SucomUtil::get_key_locale( 'site_name', $this->form->options );
					$site_name_alt_key = SucomUtil::get_key_locale( 'site_name_alt', $this->form->options );
					$site_desc_key     = SucomUtil::get_key_locale( 'site_desc', $this->form->options );
					$site_url_key      = SucomUtil::get_key_locale( 'site_url', $this->form->options );

					$plm_req_msg     = $this->p->msgs->maybe_ext_required( 'wpssoplm' );
					$plm_disable     = empty( $plm_req_msg ) ? false : true;
					$plm_place_names = $this->p->util->get_form_cache( 'place_names', true );

					$org_types_select = $this->p->util->get_form_cache( 'org_types_select' );

					$org_social = '<a href="https://developers.google.com/search/docs/guides/enhance-site#add-your-sites-name-logo-and-social-links">' .
						// translators: Please ignore - translation uses a different text domain.
						__( 'Organization Social Profile', 'wpsso' ) . '</a>';

					$table_rows[ 'schema_knowledge_graph' ] = '' . 
					// translators: Please ignore - translation uses a different text domain.
					$this->form->get_th_html( _x( 'Knowledge Graph for Home Page', 'option label', 'wpsso' ), '', 'schema_knowledge_graph' ) . 
					'<td>' .
					'<p>' .
						$this->form->get_checkbox( 'schema_add_home_organization' ) . 
						// translators: Please ignore - translation uses a different text domain.
						sprintf( __( 'Include %s for a Business Website', 'wpsso' ), $org_social ) .
					'</p>' .
					'</td>';

					$table_rows[ 'site_name' ] = '' .
					$this->form->get_th_html( _x( 'WebSite Name', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_name', $atts_locale ) . 
					'<td>' . $this->form->get_input( $site_name_key, 'long_name', '', 0, $def_site_name ) . '</td>';

					$table_rows[ 'site_name_alt' ] = '' .
					$this->form->get_th_html( _x( 'WebSite Alternate Name', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_name_alt', $atts_locale ) . 
					'<td>' . $this->form->get_input( $site_name_alt_key, 'long_name' ) . '</td>';

					$table_rows[ 'site_desc' ] = '' . 
					$this->form->get_th_html( _x( 'WebSite Description', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_desc', $atts_locale ) . 
					'<td>' . $this->form->get_textarea( $site_desc_key, '', '', 0, $def_site_desc ) . '</td>';

					$table_rows[ 'site_url' ] = $this->form->get_tr_hide( 'basic', $site_url_key ) . 
					$this->form->get_th_html( _x( 'WebSite URL', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_url', $atts_locale ) . 
					'<td>' . $this->form->get_input( $site_url_key, 'wide', '', 0, $def_site_url ) . '</td>';

					$table_rows[ 'schema_logo_url' ] = '' .
					$this->form->get_th_html( '<a href="https://developers.google.com/structured-data/customize/logos">' .
					_x( 'Organization Logo URL', 'option label', 'wpsso-organization' ) . '</a>',
						$css_class = '', $css_id = 'schema_logo_url', $atts_locale ) . 
					'<td>' . $this->form->get_input( SucomUtil::get_key_locale( 'schema_logo_url', $this->p->options ),
						'wide is_required' ) . '</td>';

					$table_rows[ 'schema_banner_url' ] = '' .
					$this->form->get_th_html( _x( 'Organization Banner URL', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'schema_banner_url', $atts_locale ) . 
					'<td>' . $this->form->get_input( SucomUtil::get_key_locale( 'schema_banner_url', $this->p->options ),
						'wide is_required' ) . '</td>';

					$table_rows[ 'site_org_schema_type' ] = '' .
					$this->form->get_th_html( _x( 'Organization Schema Type', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_org_schema_type' ) . 
					'<td>' .
					$this->form->get_select( 'site_org_schema_type', $org_types_select,
						$css_class = 'schema_type', $css_id = '', $is_assoc = true, $is_disabled = false,
							$selected = false, $event_names = array( 'on_focus_load_json' ), $event_args = 'schema_org_types' ) .
					'</td>';

					$table_rows[ 'site_place_id' ] = '' .
					$this->form->get_th_html( _x( 'Organization Location', 'option label', 'wpsso-organization' ),
						$css_class = '', $css_id = 'site_place_id' ) . 
					'<td>' . $this->form->get_select( 'site_place_id', $plm_place_names,
						$css_class = 'long_name', $css_id = '', $is_assoc = true, $plm_disable ) . $plm_req_msg . '</td>';

					$table_rows[ 'subsection_google_knowledgegraph' ] = '<td colspan="2" class="subsection"><h4>' . 
						_x( 'Google\'s Knowledge Graph', 'metabox title', 'wpsso-organization' ) . '</h4></td>';

					$social_accounts = apply_filters( $this->p->lca . '_social_accounts', $this->p->cf[ 'form' ][ 'social_accounts' ] );

					asort( $social_accounts );	// Sort by label and maintain key association.

					foreach ( $social_accounts as $opt_key => $opt_label ) {

						$table_rows[ $opt_key ] = '' .
						$this->form->get_th_html( _x( $opt_label, 'option value', 'wpsso-organization' ),
							'nowrap', $opt_key, $atts_locale ) . 
						'<td>' . $this->form->get_input( SucomUtil::get_key_locale( $opt_key, $this->p->options ),
							( strpos( $opt_key, '_url' ) ? 'wide' : '' ) ) . '</td>';
					}

					break;
			}

			return $table_rows;
		}
	}
}
