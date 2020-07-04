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
Stable Tag: 3.4.1

Customize the Schema Organization Markup for your WebSite and Manage Additional Organizations (Publisher, Organizer, etc.).

== Description ==

<p style="margin:0;"><img class="readme-icon" src="https://surniaulula.github.io/wpsso-organization/assets/icon-256x256.png"></p>

**Customize the Schema Organization markup for your home page:**

Customize your Schema Organization name, alternate name, description, WebSite URL, banner, logo, and social page URLs for each installed WordPress language / locale.

Select an optional physical location (ie. place or address) for your WebSite Organization and/or each additional Organization you create.

<h3>WPSSO ORG Standard Features</h3>

* Extends the features of the WPSSO Core plugin.

* Customize your Schema Organization properties for Google's Knowledge Graph, including different values for each installed WordPress language / locale:

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
		* Wikipedia Organization Page URL (localized)
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

**Version 3.5.0-b.1 (2020/07/04)**

* **New Features**
	* None.
* **Improvements**
	* Removed the "Knowledge Graph for Home Page" option.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Renamed setting option keys for WPSSO Core v7.12.0:
		* 'schema_logo_url' to 'site_org_logo_url'
		* 'schema_banner_url' to 'site_org_banner_url'
		* 'site_place_id' to 'site_org_place_id'
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.10.1.

**Version 3.4.1 (2020/06/23)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Replaced the 'wpsso_save_options' filter with 'wpsso_save_setting_options' (new in WPSSO Core v7.10.1).
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v7.10.1.

== Upgrade Notice ==

= 3.5.0-b.1 =

(2020/07/04) Removed the "Knowledge Graph for Home Page" option.

= 3.4.1 =

(2020/06/23) Replaced the 'wpsso_save_options' filter with 'wpsso_save_setting_options'.

