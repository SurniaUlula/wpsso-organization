<?php
/**
 * Plugin Name: WPSSO Organization Markup
 * Plugin Slug: wpsso-organization
 * Text Domain: wpsso-organization
 * Domain Path: /languages
 * Plugin URI: https://wpsso.com/extend/plugins/wpsso-organization/
 * Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
 * Author: JS Morisset
 * Author URI: https://wpsso.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Customize the Schema Organization markup for your website and create additional Schema Organizations (publisher, organizer, etc.).
 * Requires PHP: 5.6
 * Requires At Least: 4.4
 * Tested Up To: 5.5.1
 * Version: 3.8.0-b.2
 * 
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *      {major}         Major structural code changes / re-writes or incompatible API changes.
 *      {minor}         New functionality was added or improved in a backwards-compatible manner.
 *      {bugfix}        Backwards-compatible bug fixes or small improvements.
 *      {stage}.{level} Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 * 
 * Copyright 2014-2020 Jean-Sebastien Morisset (https://wpsso.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {

	die( 'These aren\'t the droids you\'re looking for.' );
}

if ( ! class_exists( 'WpssoAddOn' ) ) {

	require_once dirname( __FILE__ ) . '/lib/abstracts/add-on.php';	// WpssoAddOn class.
}

if ( ! class_exists( 'WpssoOrg' ) ) {

	class WpssoOrg extends WpssoAddOn {

		public $filters;	// WpssoOrgFilters class.

		protected $p;

		private static $instance = null;

		public function __construct() {

			parent::__construct( __FILE__, __CLASS__ );
		}

		public static function &get_instance() {

			if ( null === self::$instance ) {

				self::$instance = new self;
			}

			return self::$instance;
		}

		public function init_textdomain() {

			load_plugin_textdomain( 'wpsso-organization', false, 'wpsso-organization/languages/' );
		}

		public function init_objects( $is_admin, $doing_ajax, $doing_cron ) {

			$this->p =& Wpsso::get_instance();

			if ( $this->p->debug->enabled ) {

				$this->p->debug->mark();
			}

			if ( $this->get_missing_requirements() ) {	// Returns false or an array of missing requirements.

				return;	// Stop here.
			}

			$this->filters = new WpssoOrgFilters( $this->p );
		}
	}

        global $wpssoorg;

	$wpssoorg =& WpssoOrg::get_instance();
}
