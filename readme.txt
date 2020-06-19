=== Organization Markup | WPSSO Add-on ===
Plugin Name: WPSSO Organization Markup
Plugin Slug: wpsso-organization
Text Domain: wpsso-organization
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-organization/assets/
Tags: publisher, organization, local seo, local business, schema, schema.org, markup, article, event, location, knowledge graph, seo
Contributors: jsmoriss
Requires PHP: 5.6
Requires At Least: 4.2
Tested Up To: 5.4.2
Stable Tag: 3.3.0

Customize the Home Page Schema Organization Markup and Manage Additional Organizations (Publisher, Organizer, etc.).

== Description ==

<p style="margin:0;"><img class="readme-icon" src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png"></p>

**Customize the Schema Organization markup for your home page:**

Edit your Schema Organization name, alternate name, description, WebSite URL, banner and logo for each WordPress locale / language / region.

Select an optional location (ie. place or address) for your home page Organization and/or each additional Organization you create.

<h3>WPSSO ORG Standard Features</h3>

* Extends the features of the WPSSO Core plugin.

* Customize Schema Organization properies for Google's Knowledge Graph, including different values for each WordPress locale / language / region:

	* WebSite Name (localized)
	* WebSite Alternate Name (localized)
	* WebSite Description (localized)
	* WebSite URL (localized)
	* Organization Logo Image URL (localized)
	* Organization Banner (600x60) URL (localized)
	* Organization Schema Type
	* Organization Location
	* Google's Knowledge Graph Social Profile URLs:
		* Facebook Business Page URL (localized)
		* Instagram Business Page URL (localized)
		* LinkedIn Company Page URL (localized)
		* Myspace Business Page URL (localized)
		* Pinterest Company Page URL (localized)
		* Soundcloud Business Page URL (localized)
		* Tumblr Business Page URL (localized)
		* Twitter Business @username (localized)
		* YouTube Business Channel URL (localized)
	
<h3>WPSSO ORG Premium Features</h3>

The Standard version is designed to satisfy the requirements of most standard WordPress sites / blogs. If your site requires the management of multiple organizations, then you may want the Premium version for those additional features.

* Provides an Organization selector for the [WPSSO Schema JSON-LD Markup Premium](https://wpsso.com/extend/plugins/wpsso-schema-json-ld/) add-on (to select an alternate publisher, service provider, event organizer, event performer, hiring organization, and more).

<h3>WPSSO Core Plugin Required</h3>

WPSSO Organization Markup (aka WPSSO ORG) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/).

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO Organization Markup add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/install-the-plugin/).
* [Uninstall the WPSSO Organization Markup add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/uninstall-the-plugin/).

== Frequently Asked Questions ==

== Screenshots ==

01. The WPSSO ORG settings page includes options for the WebSite name, alternate name, description, URL, logo image, banner image (for Articles), the Organization type, an optional location, and social page URLs for Google's Knowledge Graph.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Standard Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-organization/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-organization/)

<h3>Changelog / Release Notes</h3>

**Version 3.4.0 (2020/06/20)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Replaced the 'wpsso_save_options' filter with 'wpsso_save_setting_options' (new in WPSSO Core v7.10.0).
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.10.0.

**Version 3.3.0 (2020/06/12)**

* **New Features**
	* None.
* **Improvements**
	* Updated the Organization banner and logo URL option type from 'url' to 'img_url' (new in WPSSO Core v7.9.0).
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.9.0.

**Version 3.2.0 (2020/05/09)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored the required plugin check to (optionally) check the class name and a version constant.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.5.0.

**Version 3.1.0 (2020/04/25)**

* **New Features**
	* None.
* **Improvements**
	* Updated the "Knowledge Graph for Home Page" option label to match the WPSSO Core option label.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Changed `get_input()` for multilingual options to `get_input_locale()` (available since WPSSO Core v7.1.0).
	* Changed `get_textarea()` for multilingual options to `get_textarea_locale()` (available since WPSSO Core v7.1.0).
	* Changed `get_th_html()` for multilingual options to `get_th_html_locale()` (available since WPSSO Core v7.1.0).
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.3.0.

**Version 3.0.0 (2020/04/06)**

* **New Features**
	* The WebSite Organization Schema Type option is now fixed to "Organization" since Google does not recognize all Schema Organization sub-types as valid organization and publisher types. The WebSite organization type ID should be "organization" unless you are confident that Google will recognize your preferred Schema Organization sub-type as a valid organization. To select a different organization type ID for your WebSite, define the `WPSSO_SCHEMA_ORGANIZATION_TYPE_ID` constant with your preferred type ID (the type ID, not the Schema type URL).
* **Improvements**
	* Updated "Requires At Least" to WordPress v4.2.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored WPSSO Core active and minimum version dependency checks.
	* Removed the 'wpsso_json_array_schema_page_type_ids' filter (no longer required).
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.0.1.

== Upgrade Notice ==

= 3.4.0 =

(2020/06/20) Replaced the 'wpsso_save_options' filter with 'wpsso_save_setting_options'.

= 3.3.0 =

(2020/06/12) Updated the Organization banner and logo URL option type from 'url' to 'img_url'.

