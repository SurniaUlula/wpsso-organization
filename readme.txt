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
Tested Up To: 5.4
Stable Tag: 3.0.0

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

* [Install the WPSSO ORG Add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/install-the-plugin/)
* [Uninstall the WPSSO ORG Add-on](https://wpsso.com/docs/plugins/wpsso-organization/installation/uninstall-the-plugin/)

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

**Version 2.4.0 (2020/03/27)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Minor improvements to code style.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.0.
	* WPSSO Core v6.27.1.

**Version 2.3.0 (2020/03/11)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Added support for a new WPSSO_SCHEMA_MARKUP_DISABLE constant.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.0.
	* WPSSO Core v6.24.0.

== Upgrade Notice ==

= 3.0.0 =

(2020/04/06) Updated "Requires At Least" to WordPress v4.2. The WebSite Organization Schema Type option is now fixed to "Organization" (see changelog for details).

= 2.4.0 =

(2020/03/27) Minor improvements to code style.

= 2.3.0 =

(2020/03/11) Added support for a new WPSSO_SCHEMA_MARKUP_DISABLE constant.

